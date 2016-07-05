<?php
/**
 * The base class for popularPages.
 */
class popularPages {
	
	public $modx;
	public $config = array();
	public $authorized = false;

	/**
	 * @param modX $modx
	 * @param array $config
	 */
	function __construct(modX &$modx, array $config = array()) {
		$this->modx =& $modx;

		$corePath = $this->modx->getOption('popularpages_core_path', $config, $this->modx->getOption('core_path') . 'components/popularpages/');
		$assetsUrl = $this->modx->getOption('popularpages_assets_url', $config, $this->modx->getOption('assets_url') . 'components/popularpages/');
		$connectorUrl = $assetsUrl . 'connector.php';

		$this->config = array_merge(array(
			'assetsUrl' => $assetsUrl,
			'cssUrl' => $assetsUrl . 'css/',
			'jsUrl' => $assetsUrl . 'js/',
			'imagesUrl' => $assetsUrl . 'images/',
			'connectorUrl' => $connectorUrl,

			'corePath' => $corePath,
			'modelPath' => $corePath . 'model/',
			'chunksPath' => $corePath . 'elements/chunks/',
			'templatesPath' => $corePath . 'elements/templates/',
			'chunkSuffix' => '.chunk.tpl',
			'snippetsPath' => $corePath . 'elements/snippets/',
			'processorsPath' => $corePath . 'processors/'
		), $config);

		$this->modx->addPackage('popularpages', $this->config['modelPath']);
		$this->modx->lexicon->load('popularpages:default');
		$this->authorized = $this->modx->user->isAuthenticated($this->modx->context->get('key'));
	}
	
	
	public function getChunk($name, $properties = array()) {
                $chunk = NULL;
                
                if (!isset($this->chunks[$name])) {
                        $chunk = $this->modx->getObject('modChunk', array('name' => $name));
                        
                        if (empty($chunk) || !is_object($chunk)) {
                                $chunk = $this->_getTplChunk($name);
                                
                                if ($chunk == FALSE)  return FALSE;
                        }
                        
                    $this->chunks[$name] = $chunk->getContent();
                }
                else {
                        $o = $this->chunks[$name];
                        $chunk = $this->modx->newObject('modChunk');
                        $chunk->setContent($o);
                }
                $chunk->setCacheable(FALSE);

                return $chunk->process($properties);
        }
	
	
	private function _getTplChunk($name) {
                $chunk = FALSE;
		$postfix = 'chunk.'. strtolower($name). '.tpl';
                
                $f = $this->config['chunksPath'] . $postfix;
                
                if (file_exists($f)) {
                        $o = file_get_contents($f);
                        $chunk = $this->modx->newObject('modChunk');
                        $chunk->set('name', $name);
                        $chunk->setContent($o);
                }
                
                return $chunk;
        }
	
	
	public function process(array $scriptProperties) {
		
		$name = $scriptProperties['snippet'];
		//$set = '';
		$scriptProperties['resources'] = $this->getPopularIds($scriptProperties['sortdir'], $scriptProperties['limit']);
		
		if ($snippet = $this->modx->getObject('modSnippet', array('name' => $name))) {
			$properties = $snippet->getProperties();
			$scriptProperties = array_merge($properties, $scriptProperties);
			
			$response = $snippet->process($scriptProperties);
			
		}
		
		return $response;
	}
	
	
	public function getPopularIds($sortDir, $limit) {
	
		$q = $this->modx->newQuery('popularPagesRecord');
		$q->select('id', 'count_view');
		$q->sortby('count_view', $sortDir);
		$q->limit($limit);
		if ($q->prepare() && $q->stmt->execute()) {
			while ($row = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
				$res .= ','. $row['id'];
			}
		}

		$output = mb_substr($res, 1);
		
		if (!empty($output)) {
			return $output;
		}
		else {
			return false;
		}
	}


	public function prepare($scriptProperties, $resId, $userId, $userIp, $objSettings) {
		
		if ($objSettings) {
			$time = time();
			$del = strtotime($objSettings->get('deletedon'));
			
			if ($del && $time > $del) {
				$period = $objSettings->get('period');
				$this->setPeriod($objSettings, $period);
				$q = $this->modx->newQuery('popularPagesRecord');
				$q->command('DELETE');
				$q->prepare()->execute();
			}
		}
		$obj = $this->modx->getObject('popularPagesRecord', array('id' => $resId));
		if ($obj) {
			$recordIp = $obj->get('ip_anonim');
			$recordId = $obj->get('user_id');
			if (!is_array($recordIp))
				$recordIp = array();
			if (!is_array($recordId))
				$recordId = array();
			if (in_array($userIp, $recordIp) || in_array($userId, $recordId)) {
				return;
			}
			else {
				if (!empty($userId))
					$recordId[] = $userId;
				if (!empty($userIp))
					$recordIp[] = $userIp;
				
				$this->_setPopular($obj, $recordId, $recordIp);
			}
		}
		else {
			$this->_createPopular($resId, $userId, $userIp);
		}
		
		return;
	}
	
	
	private function _setPopular($obj, array $recordId, array $recordIp) {
		
		$obj->set('count_view', $obj->get('count_view') + 1);
		$obj->set('user_id', $recordId);
		$obj->set('ip_anonim', $recordIp);
		$obj->save();
		
		
		return;
	}
	
	
	private function _createPopular($resId, $userId, $userIp) {
		
		$newObj = $this->modx->newObject('popularPagesRecord');
		$newObj->fromArray(array(
			'id' => $resId,
			'count_view' => 1,
			'user_id' => !empty($userId) ? array($userId) : '',
			'ip_anonim' => !empty($userIp) ? array($userIp) : '',

		));
		$newObj->save();
		
		return;
	}
	
	
	public function searchBot(&$botname = '') {
		
		$bots = explode(',', $this->modx->getOption('popularpages_bots_list'));
		
		foreach($bots as $bot) {
			if(stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false){
				$botname = $bot;
				return true;
			}
		}
		
		return false;
	}


	public function setPeriod($setting, $period) {
		
		switch ($period) {
			case '':
				$setting->set('createdon', 0);
				$setting->set('deletedon', 0);
				$setting->save();

				break;
			case 'day':
				$setting->set('createdon', mktime(0, 0, 0));
				$setting->set('deletedon', mktime(23, 59, 59));
				$setting->save();

				break;
			case 'week' :
				$setting->set('createdon', strtotime("last Monday"));
				$setting->set('deletedon', strtotime("Next Monday - 1 sec"));
				$setting->save();

				break;
			case 'month':
				$setting->set('createdon', mktime(0, 0, 0, date('m'), 1, date('Y')));
				$setting->set('deletedon', mktime(23, 59, 59, date('m'), date('t'), date('Y')));
				$setting->save();

				break;
			case 'quarter':
				$quarter = intval((date('n') + 2 ) / 3);
				if ($quarter == 1) {
					$firstM = 1;
					$lastM = 3;
				}
				elseif ($quarter == 2) {
					$firstM = 4;
					$lastM = 6;
				}
				elseif ($quarter == 3) {
					$firstM = 7;
					$lastM = 9;
				}
				else {
					$firstM = 10;
					$lastM = 12;
				}
				$setting->set('createdon', mktime(0, 0, 0, $firstM, 1, date('Y')));
				$setting->set('deletedon', mktime(23, 59, 59, $lastM, cal_days_in_month(CAL_GREGORIAN, $lastM, date('Y')), date('Y')));
				$setting->save();

				break;
			case 'year':
				$setting->set('createdon', mktime(0, 0, 0, 1, 1, date('Y')));
				$setting->set('deletedon', mktime(23, 59, 59, 12, 31, date('Y')));
				$setting->save();

				break;
		}
	}
	
}
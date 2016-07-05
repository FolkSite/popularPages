<?php

/**
 * Class popularPagesMainController
 */
abstract class popularPagesMainController extends modExtraManagerController {
	/** @var popularPages $popularPages */
	public $popularPages;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('popularpages_core_path', null, $this->modx->getOption('core_path') . 'components/popularpages/');
		require_once $corePath . 'model/popularpages/popularpages.class.php';

		$this->popularPages = new popularPages($this->modx);
		//$this->addCss($this->popularPages->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->popularPages->config['jsUrl'] . 'mgr/popularpages.js');
		$this->addHtml('
		<script type="text/javascript">
			popularPages.config = ' . $this->modx->toJSON($this->popularPages->config) . ';
			popularPages.config.connector_url = "' . $this->popularPages->config['connectorUrl'] . '";
		</script>
		');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('popularpages:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends popularPagesMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}
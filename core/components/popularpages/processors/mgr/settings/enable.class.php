<?php

/**
 * Enable an Item
 */
class popularPagesSettingEnableProcessor extends modObjectProcessor {
	public $objectType = 'popularPagesSetting';
	public $classKey = 'popularPagesSetting';
	public $languageTopics = array('popularpages');
	//public $permission = 'save';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('popularpages_settings_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var popularPagesItem $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('popularpages_settings_err_nf'));
			}

			$object->set('active', true);
			$object->save();
		}

		return $this->success();
	}

}

return 'popularPagesSettingEnableProcessor';

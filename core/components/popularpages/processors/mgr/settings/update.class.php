<?php

/**
 * Update an Item
 */
class popularPagesSettingUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'popularPagesSetting';
	public $classKey = 'popularPagesSetting';
	public $languageTopics = array('popularpages');
	public $permission = 'save';

	/**
	 * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return bool|string
	 */
	public function beforeSave() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}

		return true;
	}

		/**
	 * @return bool
	 */
	public function beforeSet() {
		global $popularPages;
		
		$id = (int)$this->getProperty('id');
		$period = trim($this->getProperty('period'));
		//$createdon = (int)$this->getProperty('createdon');
		if (empty($id)) {
			return $this->modx->lexicon('popularpages_settings_err_ns');
		}
		
		$setting = $this->modx->getObject('popularPagesSetting', array('id' => $id));
		if ($setting) {
			
			$popularPages->setPeriod($setting, $period);
		}
		
		return parent::beforeSet();
	}
}

return 'popularPagesSettingUpdateProcessor';

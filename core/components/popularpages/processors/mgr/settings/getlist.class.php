<?php

/**
 * Get a list of Items
 */
class popularPagesSettingGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'popularPagesSetting';
	public $classKey = 'popularPagesSetting';
	public $defaultSortField = 'id';
	//public $defaultSortDirection = 'DESC';
	//public $permission = 'list';


	/**
	 * * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return boolean|string
	 */
	public function beforeQuery() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}

		return true;
	}

	/**
	 * @param xPDOObject $object
	 *
	 * @return array
	 */
	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		$array['actions'] = array();
		//$array['period'] 

		if (!$array['active']) {
			$array['actions'][] = array(
				'cls' => '',
				'icon' => 'icon icon-power-off action-green',
				'title' => $this->modx->lexicon('popularpages_settings_enable'),
				'action' => 'enableSettings',
				'button' => true,
				'menu' => true,
			);
		}
		else {
			$array['actions'][] = array(
				'cls' => '',
				'icon' => 'icon icon-power-off action-gray',
				'title' => $this->modx->lexicon('popularpages_settings_disable'),
				'action' => 'disableSettings',
				'button' => true,
				'menu' => true,
			);
		}
		
		//if ()

		return $array;
	}
}

return 'popularPagesSettingGetListProcessor';
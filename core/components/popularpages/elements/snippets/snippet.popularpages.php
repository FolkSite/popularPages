<?php

$popularPages = $modx->getService('popularpages', 'popularPages', $modx->getOption('popularpages_core_path', null, $modx->getOption('core_path') . 'components/popularpages/') . 'model/popularpages/', $scriptProperties);
if (!($popularPages instanceof popularPages))
		return;

$userId = '';
$userIp = '';

$objSettings = $modx->getObject('popularPagesSetting', 1);
if ($objSettings) {
	$active = $objSettings->get('active');
	$isAuth = $objSettings->get('is_auth');
	
	// Если не включен, выходим
	if (!$active)
				return;
	// учитывать только авторизованных и не авторизован
	if ($isAuth == true && !$modx->user->isAuthenticated($modx->context->key)) {
		return;
	}
	elseif ($isAuth == true || $modx->user->isAuthenticated($modx->context->key)) {
		$userId = $modx->user->get('id');
		$userIp = $_SERVER['REMOTE_ADDR'];
	}
	else {
		$userIp = $_SERVER['REMOTE_ADDR'];
	}
}

// Отсекаем ботов
if ($popularPages->searchBot())
		return;

// Если пользователь входит в группу
if ($group = $modx->getOption('popularpages_ignore_group')) {
	$arrGroup = explode(',', $group);
	if (!empty($arrGroup[0]) && in_array($modx->user->get('primary_group'), $arrGroup))
		return;
}

$popularPages->prepare($scriptProperties, $modx->resource->get('id'), $userId, $userIp, $objSettings);

return;

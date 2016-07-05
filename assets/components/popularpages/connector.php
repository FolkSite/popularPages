<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var popularPages $popularPages */
$popularPages = $modx->getService('popularpages', 'popularPages', $modx->getOption('popularpages_core_path', null, $modx->getOption('core_path') . 'components/popularpages/') . 'model/popularpages/');
$modx->lexicon->load('popularpages:default');

// handle request
$corePath = $modx->getOption('popularpages_core_path', null, $modx->getOption('core_path') . 'components/popularpages/');
$path = $modx->getOption('processorsPath', $popularPages->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));
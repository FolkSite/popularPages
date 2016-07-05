<?php

$popularPages = $modx->getService('popularpages', 'popularPages', $modx->getOption('popularpages_core_path', null, $modx->getOption('core_path') . 'components/popularpages/') . 'model/popularpages/', $scriptProperties);
if (!($popularPages instanceof popularPages))	return;

$popularPages = new popularPages($modx, $scriptProperties);

$tpl = $modx->getOption('tpl', $scriptProperties, 'popularPageTpl', true);
$tplOuter = $modx->getOption('tplOuter', $scriptProperties, 'popularPageOuterTpl', true);
$ids = $modx->getOption('ids', $scriptProperties, false, true);
$snippet = $modx->getOption('snippet', $scriptProperties, 'msProducts', true);
$sortBy = $modx->getOption('sortby', $scriptProperties, 'RAND()', true);
$sortDir = $modx->getOption('sortdir', $scriptProperties, 'DESC', true);
$limit = $modx->getOption('limit', $scriptProperties, 4, true);
$res = $modx->getOption('resources', $scriptProperties, '', true);

if ($ids == true) {
	$output = $popularPages->getPopularIds();
}
else {
	$out = $popularPages->process($scriptProperties);
	$output = $popularPages->getChunk($tplOuter, array('output' => $out));
	
	$modx->regClientCSS($popularPages->config['cssUrl']. 'web/style.css');
}

return $output;

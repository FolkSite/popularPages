<?php

$properties = array();

$tmp = array(
	'tpl' => array(
		'type' => 'textfield',
		'value' => 'popularPageTpl',
	),
	'tplOuter' => array(
		'type' => 'textfield',
		'value' => 'popularPageOuterTpl',
	),
	'snippet' => array(
		'type' => 'textfield',
		'value' => 'msProducts',
	),
	'sortdir' => array(
		'type' => 'list',
		'options' => array(
			array('text' => 'DESC', 'value' => 'DESC'),
			array('text' => 'ASC', 'value' => 'ASC'),
		),
		'value' => 'DESC'
	),
	'limit' => array(
		'type' => 'numberfield',
		'value' => 4,
	),
	'sortby' => array(
		'type' => 'textfield',
		'value' => 'RAND()',
	),
	'ids' => array(
		'type' => 'combo-boolean',
		'value' => false,
	),
	'resources' => array(
		'type' => 'textfield',
		'value' => '',
	),
);

foreach ($tmp as $k => $v) {
	$properties[] = array_merge(
		array(
			'name' => $k,
			'desc' => PKG_NAME_LOWER . '_prop_' . $k,
			'lexicon' => PKG_NAME_LOWER . ':properties',
		), $v
	);
}

return $properties;


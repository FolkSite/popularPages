<?php
$xpdo_meta_map['popularPagesSetting']= array (
  'package' => 'popularpages',
  'version' => '1.1',
  'table' => 'popularpages_setting',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'createdon' => 0,
    'deletedon' => 0,
    'period' => '',
    'active' => 1,
  ),
  'fieldMeta' => 
  array (
    'createdon' => 
    array (
      'dbtype' => 'int',
      'precision' => '20',
      'phptype' => 'timestamp',
      'null' => false,
      'default' => 0,
    ),
    'deletedon' => 
    array (
      'dbtype' => 'int',
      'precision' => '20',
      'phptype' => 'timestamp',
      'null' => false,
      'default' => 0,
    ),
    'period' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'active' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'boolean',
      'null' => true,
      'default' => 1,
    ),
  ),
);

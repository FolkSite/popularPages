<?php
$xpdo_meta_map['popularPages']= array (
  'package' => 'popularpages',
  'version' => '1.1',
  'table' => 'popularpages',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'id' => 0,
    'count_view' => 0,
    'user_id' => NULL,
    'ip_anonim' => NULL,
  ),
  'fieldMeta' => 
  array (
    'id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'count_view' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'user_id' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'array',
      'null' => true,
    ),
    'ip_anonim' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'array',
      'null' => true,
    ),
  ),
  'indexes' => 
  array (
    'id' => 
    array (
      'alias' => 'id',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
    'count_view' => 
    array (
      'alias' => 'count_view',
      'primary' => false,
      'unique' => false,
      'type' => 'BTREE',
      'columns' => 
      array (
        'count_view' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'Id' => 
    array (
      'class' => 'modResource',
      'local' => 'id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);

<?php
/**
 * Department Fixture
 */
class DepartmentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'department_no' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'primary', 'comment' => '部署番号'),
		'department_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'key' => 'index', 'collate' => 'utf8_bin', 'comment' => '部署名', 'charset' => 'utf8'),
		'location' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'key' => 'index', 'collate' => 'utf8_bin', 'comment' => '所在地', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => '登録日時'),
		'creator' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'comment' => '登録者'),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
		'updater' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => 4, 'unsigned' => true, 'comment' => '更新者'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'department_no', 'unique' => 1),
			'department_no' => array('column' => 'department_no', 'unique' => 1),
			'departments_IX1' => array('column' => 'department_name', 'unique' => 0),
			'departments_IX2' => array('column' => 'location', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'InnoDB', 'comment' => '部署')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'department_no' => '',
			'department_name' => 'Lorem ipsum dolor sit amet',
			'location' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-01-05 14:25:54',
			'creator' => '',
			'updated' => '2016-01-05 14:25:54',
			'updater' => ''
		),
	);

}

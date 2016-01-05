<?php
/**
 * Employee Fixture
 */
class EmployeeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'employee_no' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'primary', 'comment' => '従業員番号'),
		'employyee_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'key' => 'index', 'collate' => 'utf8_bin', 'comment' => '従業員名', 'charset' => 'utf8'),
		'job' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'key' => 'index', 'collate' => 'utf8_bin', 'comment' => '職種', 'charset' => 'utf8'),
		'manager' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'index', 'comment' => '上司の従業員番号'),
		'hiring_date' => array('type' => 'date', 'null' => false, 'default' => null, 'key' => 'index', 'comment' => '雇用日'),
		'salary' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '15,2', 'unsigned' => false, 'key' => 'index', 'comment' => '給与'),
		'commission' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '15,2', 'unsigned' => false, 'key' => 'index', 'comment' => '委託料'),
		'department_no' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'key' => 'index', 'comment' => '所属部署'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => '登録日時'),
		'creator' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => true, 'comment' => '登録者'),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
		'updater' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => 4, 'unsigned' => true, 'comment' => '更新者'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'employee_no', 'unique' => 1),
			'employee_no' => array('column' => 'employee_no', 'unique' => 1),
			'employees_IX1' => array('column' => 'department_no', 'unique' => 0),
			'employees_IX2' => array('column' => 'hiring_date', 'unique' => 0),
			'employees_IX3' => array('column' => 'manager', 'unique' => 0),
			'employees_IX4' => array('column' => 'salary', 'unique' => 0),
			'employees_IX5' => array('column' => 'commission', 'unique' => 0),
			'employees_IX6' => array('column' => 'job', 'unique' => 0),
			'employees_IX7' => array('column' => 'employyee_name', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'InnoDB', 'comment' => '従業員')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'employee_no' => '',
			'employyee_name' => 'Lorem ipsum dolor sit amet',
			'job' => 'Lorem ipsum dolor ',
			'manager' => '',
			'hiring_date' => '2016-01-05',
			'salary' => '',
			'commission' => '',
			'department_no' => '',
			'created' => '2016-01-05 14:26:07',
			'creator' => '',
			'updated' => '2016-01-05 14:26:07',
			'updater' => ''
		),
	);

}

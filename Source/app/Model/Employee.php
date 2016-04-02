<?php
App::uses('AppModel', 'Model');
/**
 * Employee Model
 *
 */
class Employee extends AppModel {

/**
 * Primary key
 *
 * @var string
 */
	public $primaryKey = 'employee_no';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'employee_no' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'employyee_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'hiring_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'department_no' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'creator' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
			'Employee' => array(
					'className' => 'Employee',
					'foreignKey' => 'manager',
//					'conditions' => array(),
					'order' => 'Employee.department_no ASC',
//					'limit' => '',
//					'offset' => '',
//					'dependent' => false,
//					'exclusive' => false,
//					'finderQuery' => '',
			),
	);

/**
 * belongsTo  associations
 *
 * @var array
 */
	public $belongsTo = array(
			'Department' => array(
					'className' => 'Department',
					'foreignKey' => 'department_no',
//					'conditions' => '',
//					'type' => 'INNER',
//					'fields' => array(),
//					'order' => array(),
//					'counterCache' => false,
//					'counterScope' => '',
			),
			'Manager' => array(
					'className' => 'Employee',
					'foreignKey' => 'manager',
//					'conditions' => '',
//					'type' => 'INNER',
//					'fields' => array(),
//					'order' => array(),
//					'counterCache' => false,
//					'counterScope' => '',
			),
	);
}

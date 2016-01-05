<?php
App::uses('AppModel', 'Model');
/**
 * Department Model
 *
 */
class Department extends AppModel {

/**
 * Primary key
 *
 * @var string
 */
	public $primaryKey = 'department_no';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'department_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
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
					'foreignKey' => 'department_no',
//					'conditions' => array('Employee.department_no' => 'Employee.department_no'),
					'order' => 'Employee.department_no ASC',
//					'limit' => '',
//					'offset' => '',
//					'dependent' => false,
//					'exclusive' => false,
//					'finderQuery' => '',
			),
	);
}

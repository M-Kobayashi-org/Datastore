<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * Copyright (c) Masato Kobayashi
 *
 * Licensed under The GPL v3 License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Masato Kobayashi
 * @license       http://www.gnu.org/licenses/gpl-3.0.html "GNU GENERAL PUBLIC LICENSE Version 3"
 */

App::uses('DataColumn', 'Model');

class DataRecord extends Object {
/****** マジックメソッド ******/
	public function __call($name, $arguments) {
		$message = sprintf(__('Calling object method. : $s(%s)', $name, implode(', ', $arguments)));
		$this->log($message, LOG_ERR);
		throw new Exception($message);
	}

/****** プロパティ ******/

/**
 * List of field
 *
 * @var array
 */
	private $columns = array();

/**
 * Record of change status
 *
 * @var boolean $isModifyed
 */
	private $isModifyed = false;
/**
 * Returns whether the record has been changed
 *
 * @return boolean  true :  It has been changed
 *                  fales : It has not changed
 */
	public function isModifyed() {
		$isModifyed = false;
		foreach ($this->columns as $column) {
			$isModifyed |= $this->{$column}->isModifyed();
		}
		$this->isModifyed = $isModifyed;
		return $this->isModifyed;
	}

/**
 * Status of the new record
 *
 * @var boolean $isNew
 */
	private $isNew = false;
/**
 * It returns the status of the new record
 *
 * @return boolean  true :  It has been new record
 *                  false : Records obtained from the DB
 */
	public function isNew() {
		return $this->isNew;
	}

/**
 * Delete status of the record
 *
 * @var boolean $isDelete
 */
	private $isDelete = false;
/**
 * It returns the Delete status of the record
 *
 * @return boolean  true :  It has been deleted
 *                  false : Record is valid
 */
	public function isDelete() {
		return $this->isDelete;
	}



/****** メソッド ******/

/**
 * Constructor
 *
 * @param Model $model      Model instance
 * @param array $record     Initial data
 * @throws Exception
 */
	public function __construct($model = null, $record = null) {
		parent::__construct();

		if (is_null($model)) {
			$message = sprintf(__('The %s parameter is not set.'), '1st')."\n".__METHOD__.'('.__LINE__.')';
			$this->log($message, LOG_ERR);
			throw new Exception($message);
		}

		if (is_null($record)) {
			$record = array();
			$this->isNew = true;
		}
		foreach ($model->_schema as $columnName => $dataType) {
			$this->columns[] = $columnName;
			$this->{$columnName} = new DataColumn(
					isset($record[$columnName]) ? $record[$columnName] : null
			);
		}
	}

/**
 * emove the record
 *
 * @return void
 */
	public function delete() {
		$this->isDelete = true;
	}

/**
 *
 * @param mixed $fields     List of fields to get
 * @param string $target    Object of value to get
 *                          - old : Before the change of value
 *                          - new : default Value after the change
 * @throws Exception
 * @return array
 */
	public function getValue($fields = null, $target = null) {
		if (is_null($target)) {
			$target = 'new';
		}
		if (!in_array($target, array('new', 'old'))) {
			$message = sprintf(__('Value of the %s parameter is invalid.'), '2nd')."\n".__METHOD__.'('.__LINE__.')';
			$this->log($message, LOG_ERR);
			throw new Exception($message);
		}

		if ($is_null($fields) || $fields === 'all') {
			$fields = $this->columns;
		}

		$result = array();
		foreach ($fields as $column) {
			if ($target === 'new') {
				$result[$column] = $this->{$column}->newValue();
			}
			else {
				$result[$column] = $this->{$column}->oldValue();
			}
		}

		return $result;
	}

}

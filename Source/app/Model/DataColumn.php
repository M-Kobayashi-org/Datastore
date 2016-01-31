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


class DataColumn extends Object {
/****** マジックメソッド ******/
	public function __call($name, $arguments) {
		$message = sprintf(__('Calling object method. : $s(%s)', $name, implode(', ', $arguments)));
		$this->log($message, LOG_ERR);
		throw new Exception($message);
	}

/****** プロパティ ******/

/**
 * Field of data
 *
 *      isModifyed : Change status
 *                   - true :  It has been changed
 *                   - fales : It has not changed
 *      old :        Before the change of value
 *      new :        Value after the change
 *
 * @var Structure
 */
	private $value = array(
			'isModifyed' => false,
			'old' => null,
			'new' => null,
	);
/**
 * Returns whether the field has been changed
 *
 * @return boolean  true :  It has been changed
 *                  fales : It has not changed
 */
	public function isModifyed() {
		return $this->value['isModifyed'];
	}
/**
 * It returns the value before the change
 *
 * @return mixed
 */
	public function oldValue() {
		return $this->value['old'];
	}
/**
 * Set the value of the post-change or returns,
 *      If the value is specified, then set the specified value
 *      If the value is not specified, it returns a value that is held
 *
 * @param null|mixed $value
 * @return mixed
 */
	public function newValue($value = null) {
		if (!is_null($value)) {
			$this->value['new'] = $value;
			$this->value['isModifyed'] = ($this->value['old'] === $value);
		}
		return $this->value['new'];
	}
/**
 * Set the value in the field
 *      Set the post and before the change to the same value
 *      Change state will put in the unchanged
 *
 * @param string $value
 */
	public function defaultValue($value = null) {
		$this->value['isModifyed'] = false;
		$this->value['old'] = $this->value['new'] = $value;
		return $this->value;
	}



/****** メソッド ******/

/**
 * Constructor
 *
 * @param mixed $value      Field of data
 *                          It is set as the initial value
 */
	public function __construct($value = null) {
		parent::__construct();

		$this->defaultValue($value);
	}



}

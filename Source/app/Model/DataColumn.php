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

	private $value = array(
			'isModifyed' => false,
			'old' => null,
			'new' => null,
	);
	public function isModifyed() {
		return $this->value['isModifyed'];
	}
	public function oldValue() {
		return $this->value['old'];
	}
	public function newValue(string $value = null) {
		if (!is_null($value)) {
			$this->value['new'] = $value;
			$this->value['isModifyed'] = ($this->value['old'] === $value);
		}
		return $this->value['new'];
	}
	public function defaultValue(string $value = null) {
		$this->value['isModifyed'] = false;
		$this->value['old'] = $this->value['new'] = $value;
	}










/****** メソッド ******/

	public function __construct(string $value = null) {
		parent::__construct();

		$this->defaultValue($value);
	}










}

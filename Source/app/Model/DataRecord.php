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

	private $dataRecord = null;
	public function dataRecord(DataRecord $dataRecord = null) {
		if (!empty($dataRecord)) {
			$this->dataRecord = $dataRecord;
		}
		return $this->dataRecord;
	}

	private $columns = array();

	private $isModifyed = false;
	public function isModifyed() {
		$isModifyed = false;
		foreach ($this->columns as $column) {
			$isModifyed |= $this->{$column}->isModifyed();
		}
		$this->isModifyed = $isModifyed;
		return $this->isModifyed;
	}

	private $isNew = false;
	public function isNew() {
		return $this->isNew;
	}

	private $isDelete = false;
	public function isDelete() {
		return $this->isDelete;
	}








/****** メソッド ******/

	public function __construct(Model $model = null, array $record = null) {
		if (is_null($model)) {
			$message = sprintf(__('The %s parameter is not set.'), '1st')."\n".__METHOD__.'('.__LINE__.')';
			$this->log($message, LOG_ERR);
			throw new Exception($message);
		}

		parent::__construct();

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


	public function delete() {
		$this->isDelete = true;
	}




}

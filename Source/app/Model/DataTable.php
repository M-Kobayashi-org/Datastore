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

App::uses('DataRecord', 'Model');

class DataTable extends Object {
/****** マジックメソッド ******/
	public function __call($name, $arguments) {
		$message = sprintf(__('Calling object method. : $s(%s)', $name, implode(', ', $arguments)));
		$this->log($message, LOG_ERR);
		throw new Exception($message);
	}

/****** プロパティ ******/

	private $dataStore = null;
	public function dataStore(DataStore $dataStore = null) {
		if (!empty($dataStore)) {
			$this->dataStore = $dataStore;
		}
		return $this->dataStore;
	}

	private $model = null;
	public function model(string $modelName = null) {
		if (!empty($modelName)) {
			$this->model = $modelName;
		}
		return $this->model;
	}

	private $records = array();

	private $recordIndex = -1;







/****** メソッド ******/

/**
 * Constructor
 */
	public function __construct(DataStore $dataStore, string $model) {
		parent::__construct();

		$this->dataStore($dataStore);
		$this->model($model);

		$this->{$model} = ClassRegistry::init($model);
	}

	public function insertRow(array $record = null) {
		$this->records[] = new DataRecord($this->{$this->model});
		$this->recordIndex = count($this->records) - 1;
		if (0 > $this->recordIndex) {
			return null;
		}
		return $this->records[$this->recordIndex];
	}

	public function deleteRow(integer $index = null) {
		if (is_null($index)) {
			$message = sprintf(__('The %s parameter is not set.'), '1st')."\n".__METHOD__.'('.__LINE__.')';
			$this->log($message, LOG_ERR);
			throw new Exception($message);
		}
		if (0 > $index || $index > count($this->records)) {
			$message = sprintf(__('Value of the %s parameter is invalid.'), '1st')."\n".__METHOD__.'('.__LINE__.')';
			$this->log($message, LOG_ERR);
			throw new Exception($message);
		}

		$this->record[$index]->delete();
	}


}

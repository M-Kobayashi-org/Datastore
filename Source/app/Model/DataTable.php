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

/**
 * "DataStore" instance to manage this object
 *
 * @var DataStore $dataStore
 */
	private $dataStore = null;
/**
 * To manage this object "DataStore" setting an instance, or returns
 *
 * @param DataStore|null $dataStore
 * @return DataStore
 */
	public function dataStore(DataStore $dataStore = null) {
		if (!empty($dataStore)) {
			$this->dataStore = $dataStore;
		}
		return $this->dataStore;
	}

/**
 * Model name of the table to which this object is to manage
 *
 * @var string $model
 */
	private $modelName = null;
/**
 * Set the model name of the table to which this object is to manage, or returns
 *
 * @param string|null $modelName
 * @return string
 */
	public function modelName($modelName = null) {
		if (!empty($modelName)) {
			$this->modelName = $modelName;
		}
		return $this->modelName;
	}

/**
 * Set the model name of the table to which this object is to manage, or returns
 *
 * @param string|null $modelName
 * @return string
 */
	public function model() {
		return $this->{$this->modelName};
	}

/**
 * Alias of the table to which this object is to manage
 *
 * @var string $alias
 */
	private $alias = null;
/**
 * Set up an alias for the table to which this object is to manage, or returns
 *
 * @param string|null $alias
 * @return string
 */
	public function alias($alias = null) {
		if (!empty($alias)) {
			$this->alias = $alias;
		}
		return $this->alias;
	}

/**
 * List of "DataRecord"
 *
 * @var array
 */
	private $records = array();

/**
 * Index of the record of interest
 *
 * @var integer
 */
	private $recordIndex = -1;
/**
 * It sets the index of the record of interest, or returns
 *
 * @param integer|null $index
 * @throws Exception
 * @return integer
 */
	public function recordIndex($index = null) {
		if (!is_null($index)) {
			if (-1 > $index) {
				$message = sprintf(__('Value of the %s parameter is invalid.'), '1st')."\n".__METHOD__.'('.__LINE__.')';
				$this->log($message, LOG_ERR);
				throw new Exception($message);
			}
			$this->recordIndex = $index;
		}
		return $this->recordIndex;
	}

/**
 *
 *
 * @var integer $queryStatus
 */
//	private $queryStatus = QueryStatus::Unextracted;
/**
 *
 * @param integer $status
 * @throws UnexpectedValueException
 */
/*
	public function queryStatus($status = null) {
		try {
			if (!empty($status)) {
				new QueryStatus($status);
				$this->queryStatus = $status;
			}
		} catch (UnexpectedValueException $e) {
			$message = $e->getMessage()."\n".__METHOD__.'('.__LINE__.')';
			$this->log($message, LOG_ERR);
			throw $e;;
		}
		return $this->queryStatus;
	}
*/
/**
 * List of the executed query
 *
 * @var array $querys
 */
	private $querys = array();

/**
 * List of the extracted as the executed query record
 *
 * @var array $querys
 */
	private $caches = array();






/****** メソッド ******/

/**
 * Constructor
 *
 * @param DataStore $dataStore  "DataStore" instance to manage this object
 * @param string $model         Model name of the table to which this object is to manage
 * @param string $alias         Alias of the table to which this object is to manage
 */
	public function __construct($dataStore, $model, $alias) {
		parent::__construct();

		$this->dataStore($dataStore);
		$this->modelName($model);
		$this->alias($alias);

		$this->{$model} = ClassRegistry::init($model);
	}

/**
 * Add Record
 *
 * @param array|null $record
 * @return DataRecord|null
 */
	public function insertRow($record = null) {
		$this->records[] = new DataRecord($this->{$this->modelName()}, $record);
		$this->recordIndex = count($this->records) - 1;
		if (0 > $this->recordIndex) {
			return null;
		}
		return $this->records[$this->recordIndex];
	}

/**
 * Changes to the deleted records
 *
 * @param integer $index
 * @throws Exception
 */
	public function deleteRow($index = null) {
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

/**
 * Get the data
 *
 * @param string $type
 * @param array $options
 * @param integer $recursive
 * @param boolean $root
 * @throws Exception
 * @return array
 */
	public function retreave($type = null, $options = null, &$recursive = null, $root = false) {
		if (is_null($type)) {
			$message = sprintf(__('The %s parameter is not set.'), '1st')."\n".__METHOD__.'('.__LINE__.')';
			$this->log($message, LOG_ERR);
			throw new Exception($message);
		}
		if (is_null($options)) {
			$message = sprintf(__('The %s parameter is not set.'), '2nd')."\n".__METHOD__.'('.__LINE__.')';
			$this->log($message, LOG_ERR);
			throw new Exception($message);
		}
		if (is_null($recursive)) {
			$message = sprintf(__('The %s parameter is not set.'), '3th')."\n".__METHOD__.'('.__LINE__.')';
			$this->log($message, LOG_ERR);
			throw new Exception($message);
		}

		// クエリー条件をシリアライズ
		$serialize = serialize($options);
		if ($this->isExtracted($serialize) === QueryStatus::Extracted()) {
			// キャッシュバッファから取得
			$results = array();
			foreach ($this->caches[$serialize] as $index) {
				$dataRecord = $this->records[$index];
				$record[$this->alias] = $dataRecord->getValue();
				$results[] = $record;
			}
		}
		else {
			// DBから取得
			$Model = $this->{$this->modelName()};
			$options['recursive'] = -1;
			$results = $Model->find($type, $options);
			if (!is_null($results) && is_array($results) && count($results)) {
				switch ($type) {
					case 'all':
						foreach ($results as $row) {
							$this->setCache($serialize, $row);
						}
						break;

					case 'first':
						$this->setCache($serialize, $results);
						break;

					default:
						break;
				}
			}
			else {
				$results = array();
				$this->setCache($serialize, null);
			}
		}

		// アソシエーションを解析してデータを取得する
		if ($recursive >= 0) {
			$recursive--;
			if (!empty($results)) {
				// Determine whether multiple records are extracted
				$isMulti = false;
				$keys = array_keys($results);
				if (is_numeric($keys[0])) {
					$isMulti = true;
				}

				$dataStore = $this->dataStore();
				$Model = $this->model();

				if ($isMulti) {
					foreach ($results as $index => &$records) {
						$aliases = array_keys($records);
						foreach ($aliases as $alias) {
							$records += $this->rtreaveBelongsTos($Model, $dataStore, $records[$alias]);
							$result = $this->rtreaveHasManyos($Model, $dataStore, $results[$alias]);
							if (!empty($result)) {
								$results[$alias] += $result;
							}
						}
					}			// foreach ($results as $index => $records)
					unset($records);
				} else {		// if ($isAll)
					$aliases = array_keys($results);
					foreach ($aliases as $alias) {
						$results += $this->rtreaveBelongsTos($Model, $dataStore, $results[$alias]);
						$result = $this->rtreaveHasManyos($Model, $dataStore, $results[$alias]);
						if (!empty($result)) {
							$results[$alias] += $result;
						}
					}
				}				// if ($isAll)
			}					// if (!empty($results))
		}						// if ($recursive >= 0)

		return $results;
	}

	private function rtreaveBelongsTos($Model, $dataStore, $record) {
		$results = array();
		foreach (($Model->belongsTo + $Model->hasAndBelongsToMany) as $alias => $association) {
			if (!isset($dataStore->{$alias})) {
				$dataStore->loadModel($association['className'], $alias);
			}
			$options = array('recursive' => -1);
			// Set find method parameters from association
			if (isset($association['fields']))
				$options += array('fields' => $association['fields']);
			if (isset($association['order']))
				$options += array('order' => $association['order']);

			if (isset($association['foreignKey'])) {
				if (!is_array($association['foreignKey'])) {
					$association['foreignKey'] = array($association['foreignKey'],);
				}				// if (!is_array($association['foreignKey']))

				$this->nextBelongsTo($association, $options, $record, $alias);
				$result = $dataStore->{$alias}->retreave('first', $options, $options['recursive'], false);
				if (empty($result)) {
					$schemas = array();
					foreach (array_keys($dataStore->{$alias}->{$association['className']}->_schema) as $fieldName) {
						$schemas[$fieldName] = null;
					}
					$results[$alias] = $schemas;
				} else {
					$results[$alias] = $result[$association['className']];
				}
			}					// if (!empty($results) && isset($association['foreignKey']))
		}						// foreach (($ds->{$this->alias()}->belongsTo + $ds->{$this->alias()}->hasAndBelongsToMany) as $alias => $association)
		return $results;
	}

	private function nextBelongsTo($association, &$options, $record, $alias) {
		$Model = $this->dataStore()->{$alias}->model();

		// Set conditions parameter
		if (isset($association['conditions']))
			$options['conditions'] = $association['conditions'];
		else		// if (isset($association['conditions']))
			$options['conditions'] = array();

		$primaryKey = $Model->primaryKey;
		if (!is_array($primaryKey))
			$primaryKey = array($primaryKey);
		$keys = array();
		foreach ($primaryKey as $key) {
			$keys[] = $association['className'].'.'.$key;
		}

		$vals = array();
		foreach ($association['foreignKey'] as $key) {
			$vals[] = $record[$key];
		}

		for ($i = 0; $i < count($keys); $i++) {
			$options['conditions'][] = array( $keys[$i] => $vals[$i],);
		}
	}

	private function rtreaveHasManyos($Model, $dataStore, $record) {
		$results = array();
		foreach (($Model->hasMany + $Model->hasAndBelongsToMany) as $alias => $association) {
			if (!isset($dataStore->{$alias})) {
				$dataStore->loadModel($association['className'], $alias);
			}
			$options = array('recursive' => -1);
			// Set find method parameters from association
			if (isset($association['fields']))
				$options += array('fields' => $association['fields']);
			if (isset($association['order']))
				$options += array('order' => $association['order']);

			if (isset($association['foreignKey'])) {
				if (!is_array($association['foreignKey'])) {
					$association['foreignKey'] = array($association['foreignKey'],);
				}				// if (!is_array($association['foreignKey']))

				$this->nextHasManyo($association, $options, $record, $alias);
				$result = $dataStore->{$alias}->retreave('all', $options, $options['recursive'], false);
				if (!empty($result)) {
					foreach ($result as $row) {
						$results[] = $row[$association['className']];
					}
				}
			}					// if (!empty($results) && isset($association['foreignKey']))
		}						// foreach (($ds->{$this->alias()}->belongsTo + $ds->{$this->alias()}->hasAndBelongsToMany) as $alias => $association)
		return $results;
	}

	private function nextHasManyo($association, &$options, $record, $alias) {
		$Model = $this->dataStore()->{$alias}->model();

		// Set conditions parameter
		if (isset($association['conditions']))
			$options['conditions'] = $association['conditions'];
		else		// if (isset($association['conditions']))
			$options['conditions'] = array();

		$primaryKey = $Model->primaryKey;
		if (!is_array($primaryKey))
			$primaryKey = array($primaryKey);
		$keys = array();
		foreach ($association['foreignKey'] as $key) {
			$keys[] = $association['className'].'.'.$key;
		}

		$vals = array();
		foreach ($primaryKey as $key) {
			$vals[] = $record[$key];
		}

		for ($i = 0; $i < count($keys); $i++) {
			$options['conditions'][] = array( $keys[$i] => $vals[$i],);
		}
	}

/**
 * Query to determine whether it is cash
 *
 * @param mixed $serialize
 * @return interger
 */
	private function isExtracted($serialize = null) {
		if (is_null($serialize) || is_array($serialize)) {
			$serialize = serialize($serialize);
		}
		if (in_array($serialize, $this->querys)) {
			// 既にキャッシュされている
			return QueryStatus::Extracted();
		}
		// クエリー条件を保存
		$this->querys[] = $serialize;
		return QueryStatus::Unextracted();
	}

/**
 * It caches the results of a query
 *
 * @param sting $serialize
 * @param array $data
 */
	public function setCache($serialize, $data = null) {
		if (is_null($data))
			$data = array('' => null);

		foreach ($data as $alias => $record) {
			if ($alias === '' || $alias === $this->alias()) {
				$this->insertRow($record);
				$this->caches[$serialize][] = $this->recordIndex();
			}
			else {
				$ds = $this->dataStore();
				$ds->{$alias}->setCache($serialize, array($alias => $record));
			}
		}
	}














}


App::uses('Enum', 'Lib');


class QueryStatus extends Enum {
	const Unextracted =  0;
	const Extracted =    1;
	const Necessary =    2;
}

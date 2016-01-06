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
 * @package       app.Model
 * @license       http://www.gnu.org/licenses/gpl-3.0.html "GNU GENERAL PUBLIC LICENSE Version 3"
 */

App::uses('Model', 'Model');

/**
 * Model that performs processing through its own buffer in CakePHP.
 *
 * @package       app.Model
 */
class DataObject extends Model {

/**
 * Buffer to cache the extracted records.
 *
 * @var array
 */
	private $dataCache = array();

/**
 * Method to initialize the cache.
 *
 * @return void
 */
	public function clearCache() {
		$this->dataCache = array();
	}

/**
 * Method to get the class object than alias.
 *
 * @param string $alias
 * @return Model object
 */
	private function getModel($alias) {
		$associations = array_replace_recursive($this->hasOne, $this->hasMany, $this->belongsTo, $this->hasAndBelongsToMany);
		$class = null;
		foreach ($associations as $key => $value) {
			if ($alias == $key) {
				$class = $value['className'];
				break;
			}
		}
		if (is_null($class)) {
			return null;
		}
		return ClassRegistry::init($class);
	}

/**
 * Method to cache the extracted data.
 *
 * @param array $data
 * @return void
 */
	private function setCache($data) {
		foreach ($data as $alias => $record) {
			$Model = $this->getModel($alias);
			$model = get_class($Model);
			$pKeyVal = array();
			if (is_array($Model->primaryKey)) {
				foreach ($Model->primaryKey as $col) {
					$pKeyVal[] = $record[$col]?$record[$col]:'';
				}
			}
			else {
				$pKeyVal[] = $record[$Model->primaryKey]?$record[$Model->primaryKey]:'';
			}
			$primaryKey = join('-', $pKeyVal);
			if (str_replace('-', '', $primaryKey) !== '') {
				foreach ($record as $column => $value) {
					if (is_array($value) && is_numeric($column)) {
						$pKeyVal = array();
						if (is_array($Model->primaryKey)) {
							foreach ($Model->primaryKey as $col) {
								$pKeyVal[] = $value[$col]?$value[$col]:'';
							}
						}
						else {
							$pKeyVal[] = $value[$Model->primaryKey]?$value[$Model->primaryKey]:'';
						}
						$primaryKey = join('-', $pKeyVal);
						if (str_replace('-', '', $primaryKey) !== '') {
							foreach ($value as $col => $val) {
								$this->dataCache[$model][$primaryKey][$col] = $val;
							}
						}
					}
					else {
						$this->dataCache[$model][$primaryKey][$column] = $value;
					}
				}
			}
		}
//		$this->log(array('method' => __FILE__.':'.__LINE__.' '.__METHOD__, '$dataCache' => $this->dataCache), LOG_DEBUG);
	}

/**
 * Queries the datasource and returns a result set array.
 *
 * Override than Model class.
 * For more information referring to the inherited methods
 *
 * @param string $type Type of find operation (all / first / count / neighbors / list / threaded)
 * @param array $query Option fields (conditions / fields / joins / limit / offset / order / page / group / callbacks)
 * @return array|null Array of records, or Null on failure.
 */
	public function find($type = 'first', $query = array()) {

		$result = parent::find($type, $query);

		switch ($type) {
			case 'all' :
				foreach ($result as $row) {
					$this->setCache($row);
				}
				break;

			case 'first' :
				$this->setCache($result);
				break;

			default:
				;
				break;
		}

		return $result;
	}

/**
 * Methods for converting the cached data into a string of JSON format.
 *
 * @return string
 */
	public function serialize() {
		$result = json_encode($this->dataCache);
		if ($result === false) {
			$this->log(array('method' => __FILE__.':'.__LINE__.' '.__METHOD__, 'Error message' => json_last_error()), LOG_ERR);
		}
		return $result;
	}

/**
 * Method to capture the JSON format of cache data.
 *
 * @param string $data
 * @return array
 */
	public function unserialize($data = '') {
		$result = json_decode($data);
		if (is_null($result)) {
			$this->log(array('method' => __FILE__.':'.__LINE__.' '.__METHOD__, 'Error message' => json_last_error()), LOG_ERR);
			$result = false;
		}
		else {
			$this->dataCache = $result;
			$result = true;
		}
		return $result;
	}




}

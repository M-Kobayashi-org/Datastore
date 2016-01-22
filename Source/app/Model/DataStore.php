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

App::uses('DataTable', 'Model');

class DataStore extends Object {
/****** マジックメソッド ******/
	public function __call($name, $arguments) {
		$message = sprintf(__('Calling object method. : $s(%s)', $name, implode(', ', $arguments)));
		$this->log($message, LOG_ERR);
		throw new Exception($message);
	}

/****** プロパティ ******/

/**
 * The class name of the primary and become model
 *
 * @param string|null $className    Class name to be registered.
 *                                  The class name that is registered in the case of null.
 *
 * @return string               Class names that have been registered.
 */
	private $className = null;
	public function className(string $className = null) {
		if (!is_null($className))
			$this->className = $className;

		return $this->className;
	}

/**
 * Alias of the class to use.
 *
 * @var array $uses
 */
	public $uses = array();

/**
 * Options for the query
 *
 * @var array $retreaveOption
 */
	public $retreaveOption = array(
			'type' =>    'first',
			'options' => array(),
	);

/**
 * The timing of the inquiry
 *      - true  Run a query immediately after initialization
 *      - false Run at the time of query processing
 *
 * @var boolean $laterRetreave
 */
	public $laterRetreave = true;






/****** メソッド ******/

/**
 * Constructor
 */
	public function __construct() {
		parent::__construct();
		$this->initialize();
	}

/**
 * Initialization
 *
 * @return void
 */
	public function initialize() {
		// Check propertys
		if (empty($this->className)) {
			$message = sprintf(__('"%s" property has not been set.'), 'className')."\n".__METHOD__.'('.__LINE__.')';
			$this->log($message, LOG_ERR);
			throw new Exception($message);
		}
		if (!in_array($this->className(), $this->uses)) {
			$message = sprintf(__('There is no "%s" to the list of models to be used.'), $this->className())."\n".__METHOD__.'('.__LINE__.')';
			$this->log($message, LOG_WARNING);
		}
		// Register the use model class
		if (empty($this->uses)) {
			$this->uses = array($this->className());
		}
		$this->loadModel($this->uses);

		// Extracted from the database
		if (!$this->laterRetreave)
			$result = $this->retreave($this->className(), $this->$retreaveOption['type'], $this->$retreaveOption['options']);

//		$this->log(array('method' => __FILE__.':'.__LINE__.' '.__METHOD__, '$this->datas' => $this->datas), LOG_DEBUG);
	}

/**
 * Register the use class
 *
 * @param array|string $modelNames  List of model name(s)
 * @param array|string $aliases  List of alias name(s)
 * @throws Exception
 */
	public function loadModel($modelNames = null, $aliases = null) {
//		$this->log(array('method' => __FILE__.':'.__LINE__.' '.__METHOD__, '$modelNames' => $modelNames), LOG_DEBUG);

		if (is_null($modelNames)) {
			$message = sprintf(__('The %s parameter is not set.'), '1st')."\n".__METHOD__.'('.__LINE__.')';
			$this->log($message, LOG_ERR);
			throw new Exception($message);
		}

		if (!is_array($modelNames)) {
			$modelNames = array($modelNames);
		}
		if (!count($modelNames))
			return;

		if (is_null($aliases))
			$aliases = $modelNames;

		for ($i = 0; $i < count($modelNames); $i++) {
			$class = $modelNames[$i];
			if (!in_array($class, $this->uses)) {
				$this->uses[] = $class;
				if (isset($aliases[$i])) {
					$this->{$aliases[$i]} = new DataTable($this, $class);
				}
				else {
					$this->{$class} = new DataTable($this, $class);
				}
			}
		}
	}


	public function retreave(string $alias = null, $type = null, $options = null) {
		$root = ($this->className() === $alias);

	}









}

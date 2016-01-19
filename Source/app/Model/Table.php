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


class Table extends Object {
/****** プロパティ ******/

	private $dataStore = null;





/****** メソッド ******/

/**
 * Constructor
 */
	public function __construct(DataStore $dataStore, string $model) {
		parent::__construct();

		$this->dataStore = $dataStore;
		$this->{$model} = ClassRegistry::init($model);
	}

}

<?php
/** Convenient API for asynchronous queries in PHP 5.3+
* @link http://github.com/vrana/mysqli-async
* @author Jakub Vrana, http://www.vrana.cz/
* @copyright 2010 Jakub Vrana
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
*/
class MysqliAsync {
	protected $credentials = array();
	protected $connections = array();
	
	/** Specify connection credentials
	* @param ... used for mysqli_connect()
	*/
	function __construct() {
		$this->credentials = func_get_args();
	}
	
	/** Execute query or get its data
	* @param string query identifier
	* @param array array(string $query, [array $credentials]) for executing query, array() for getting data
	* @return bool|mysqli_result
	*/
	function __call($name, $args) {
		if ($args) { // execute query
			list($query, $credentials) = $args;
			$connection = call_user_func_array('mysqli_connect', (array) $credentials + $this->credentials);
			$this->connections[$name] = $connection;
			return $connection->query($query, MYSQLI_ASYNC);
		}
		
		// get data
		//! handle second call with the same $name
		$connection = $this->connections[$name];
		do {
			$links = $errors = $reject = $this->connections;
			mysqli_poll($links, $errors, $reject, 10);
		} while (!in_array($connection, $links, true) && !in_array($connection, $errors, true) && !in_array($connection, $reject, true));
		
		return $connection->reap_async_query();
	}
}

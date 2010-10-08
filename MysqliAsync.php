<?php
/** Convenient API for asynchronous queries in PHP 5.3+
* @link http://github.com/vrana/mysqli-async
* @author Jakub Vrana, http://www.vrana.cz/
* @copyright 2010 Jakub Vrana
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
*/
class MysqliAsync {
	/** @var int number of seconds to wait in retrieving data */
	public $timeout = 10;
	protected $credentials = array();
	protected $connections = array();
	
	/** Specify connection credentials
	* @param ... used for mysqli_connect()
	*/
	function __construct() {
		$this->credentials = func_get_args();
	}
	
	/** Close all opened connections
	*/
	function __destruct() {
		foreach ($this->connections as $connection) {
			$connection->close();
		}
	}
	
	/** Execute query or get its data
	* @param string query identifier
	* @param array array(string $query, [array $credentials]) for executing query, array() for getting data
	* @return bool|mysqli_result
	*/
	function __call($name, array $args) {
		if ($args) { // execute query
			$query = $args[0];
			$credentials = $this->credentials;
			if (isset($args[1])) {
				$credentials = $args[1] + $credentials;
			}
			$connection = call_user_func_array('mysqli_connect', $credentials);
			$this->connections[$name] = $connection;
			return $connection->query($query, MYSQLI_ASYNC);
		}
		
		// get data
		//! handle second call with the same $name
		$connection = $this->connections[$name];
		do {
			$links = $errors = $reject = $this->connections;
			mysqli_poll($links, $errors, $reject, $this->timeout);
		} while (!in_array($connection, $links, true) && !in_array($connection, $errors, true) && !in_array($connection, $reject, true));
		
		return $connection->reap_async_query();
	}
	
}

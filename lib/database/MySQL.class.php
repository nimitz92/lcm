<?php 

// Acknowledgements : Codefest 2011

class MySQL {

	// MySQL Connection resource
	protected $mysql;
	
	// Constructor
	public function __construct() {
		$this->mysql = mysql_connect('localhost', 'root', 'shivang') or die('Error connecting to database');
		if( $this->mysql==false )
			die('Error connecting to database');
		mysql_select_db('test', $this->mysql) or die('Error selecting the database');
	}
	
	// Executes a  query
	public function executeQuery($q) {
		return mysql_query($q, $this->mysql);
	}
	
	// Escapes a string to prevent SQL injection
	public function escapeString($f) {
		return mysql_real_escape_string($f, $this->mysql);
	}
	
	// Number of rows affected by last update
	public function getRowsAffectedCount() {
		return mysql_affected_rows($this->mysql);
	}
	
	// Returns the result set as two dimentional array
	public function getResultAsArray($result, $how=MYSQL_NUM) {
		$arr = array();
		while( $row = mysql_fetch_array($result, $how) ) {
			array_push( $arr, $row );
		}
		return $arr;
	}
	
	// Gets the next row in the result set
	public function getNextRow($result, $how=MYSQL_NUM) {
		return mysql_fetch_array($result, $how);
	}
	
	// Gets number of rows in the result set
	public function getRowsCount($result) {
		return mysql_num_rows($result);
	}

	// Gets the assigned auto-increment id for last insert
	public function getLastInsertId() {
		return mysql_insert_id($this->mysql);
	}
	
	// Gets the error string
	public function getLastError() {
		return mysql_error($this->mysql);
	}
	
}

?>

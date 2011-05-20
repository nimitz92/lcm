 <?php 

// Acknowledgements : Codefest 2011

class Session {

	// Constants for this class
	const
		SELECT_SUCCESS = 0,
		INSERT_SUCCESS = 1,
		UPDATE_SUCCESS = 2,
		DELETE_SUCCESS = 3,
		INVALID_DATA = -1,
		DATABASE_ERROR=-15;	
	// Fields for this class - analogous to session table columns
	protected $sid,$uid,$time,$expiry;
	
	// Sets the fields with new values
	public function read($uid,$time, $expiry) {
		$thid->uid=$$uid;
		$this->time = $time;
		$this->expiry = $expiry;
	}
	
	// Selects the session from database into the fields
	public function select($sid, $mysql) {
		if( !is_numeric($sid) ) 
			return self::INVALID_DATA;
		
		
			
		$res = $mysql->executeQuery("select sid, time, expiry from session where sid=$sid;");
		if( $res === false ) 
			return self::DATABASE_ERROR;
		else if( $mysql->getRowsCount($res) != 1 ) 
			return self::INVALID_DATA;

		$row = $mysql->getNextRow($res);
		$this->sid = $sid;
		$this->time= $row[1];
		$this->expiry = $row[2];

		return self::SELECT_SUCCESS;
	}
	
	// Inserts new row into session table using values from the fields
	public function insert($mysql){

				$query = sprintf("insert into session ( time, expiry) values( '%d', '%d');",
				$this->time,
				$this->expiry
				);
		
				$res = $mysql->executeQuery($query);
		
				if( $res === false ) 
				return self::DATABASE_ERROR;
	
				return self::INSERT_SUCCESS;
			
			
	}
	
	// Updates a session in database from values in the fields
	public function update($mysql){
		if( !is_numeric($this->sid) ) 
			return self::INVALID_DATA;

		$query = sprintf("update contacts set expiry='%d' where sid=%d;",
				$this->expiry,
				$this->sid
		);
		
		$res = $mysql->executeQuery($query);
		
		if( $res === false ) 
			return self::DATABASE_ERROR;
			
		return self::UPDATE_SUCCESS;
	}
	
	// Deletes a session using its sid of correct owner
	public function delete($sid, $mysql) {
		if( !is_numeric($sid) ) 
			return self::INVALID_DATA;
		
		
		$res = $mysql->executeQuery("delete from session where sid=$sid");
		if( $res === false ) 
			return self::DATABASE_ERROR;
			
		return self::DELETE_SUCCESS;
	}
	
	// Accessor methods
	
	public function getTime(){ return $this->time; }
	public function getExpiry() { return $this->expiry; }

}

?>
 
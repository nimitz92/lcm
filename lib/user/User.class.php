<?php 

// Acknowledgements : Codefest 2011

class User {

	// Constants for this class
	const
		SELECT_SUCCESS = 0,
		INSERT_SUCCESS = 1,
		UPDATE_SUCCESS = 2,
		DELETE_SUCCESS = 3,
		INVALID_DATA = -1,
		DATABASE_ERROR=-15;
		USERNAME_TAKEN=-2;	
	// Fields for this class - analogous to user table columns
	protected $uid,$username,$password;
	
	// Sets the fields with new values
	public function read($username, $password) {
		$this->username = $username;
		$this->password = $password;
	}
	
	// Selects the user from database into the fields
	public function select($uid, $mysql) {
		if( !is_numeric($uid) ) 
			return self::INVALID_DATA;
		
		
			
		$res = $mysql->executeQuery("select uid, username, password from user where uid=$uid;");
		if( $res === false ) 
			return self::DATABASE_ERROR;
		else if( $mysql->getRowsCount($res) != 1 ) 
			return self::INVALID_DATA;

		$row = $mysql->getNextRow($res);
		$this->uid = $uid;
		$this->username= $row[1];
		$this->password = $row[2];

		return self::SELECT_SUCCESS;
	}
	
	// Inserts new row into user table using values from the fields
	public function insert($mysql){
		$q=sprintf("select * from user where username='%s';", $mysql->escapeString($this->username));
		$res=$mysql->executeQuery($q);
		$username=$mysql->escapeString($this->username);
		$password=$mysql->escapeString($this->password);
			if(!$mysql->getRowsCount($res))
			{
				$query = sprintf("insert into user ( username, password) values( '%s', '%s');",
				$username,
				MD5("$username$password")
				);
		
				$res = $mysql->executeQuery($query);
		
				if( $res === false ) 
				return self::DATABASE_ERROR;
	
				return self::INSERT_SUCCESS;
			}
			else
				return self::USERNAME_TAKEN;
	}
	
	// Updates a user in database from values in the fields
	public function update($mysql){
		if( !is_numeric($this->uid) ) 
			return self::INVALID_DATA;

		$query = sprintf("update contacts set password='%s' where uid=%d;",
				$mysql->escapeString($this->password),
				$this->uid
		);
		
		$res = $mysql->executeQuery($query);
		
		if( $res === false ) 
			return self::DATABASE_ERROR;
			
		return self::UPDATE_SUCCESS;
	}
	
	// Deletes a user using its uid of correct owner
	public function delete($uid, $mysql) {
		if( !is_numeric($uid) ) 
			return self::INVALID_DATA;
		
		
		$res = $mysql->executeQuery("delete from user where uid=$uid");
		if( $res === false ) 
			return self::DATABASE_ERROR;
			
		return self::DELETE_SUCCESS;
	}
	
	// Accessor methods
	
	public function getUsername(){ return $this->username; }
	public function getPassword() { return $this->password; }

}

?>
 
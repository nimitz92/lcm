<?php 

// Acknowledgements : Codefest 2011

class Contact {

	// Constants for this class
	const
		SELECT_SUCCESS = 0,
		INSERT_SUCCESS = 1,
		UPDATE_SUCCESS = 2,
		DELETE_SUCCESS = 3,
		INVALID_DATA = -1,
		DATABASE_ERROR=-15;
	
	// Fields for this class - analogous to contacts table columns
	protected $cid, $ownerid, $cname, $email, $phone;
	
	// Sets the fields with new values
	public function read($ownerid, $cname, $email, $phone) {
		$this->ownerid = $ownerid;
		$this->cname = $cname;
		$this->email = $email;
		$this->phone = $phone;
	}
	
	// Selects the contact from database into the fields
	public function select($cid, $ownerid, $mysql) {
		if( !is_numeric($cid) ) 
			return self::INVALID_DATA;
		
		if( !is_numeric($ownerid) ) 
			return self::INVALID_DATA;
			
		$res = $mysql->executeQuery("select cid, ownerid, cname, email, phone from contacts where cid=$cid and ownerid=$ownerid;");
		if( $res === false ) 
			return self::DATABASE_ERROR;
		else if( $mysql->getRowsCount($res) != 1 ) 
			return self::INVALID_DATA;

		$row = $mysql->getNextRow($res);
		$this->cid = $cid;
		$this->ownerid = $row[1];
		$this->cname = $row[2];
		$this->email = $row[3];
		$this->phone = $row[4];

		return self::SELECT_SUCCESS;
	}
	
	// Inserts new row into contact table using values from the fields
	public function insert($mysql){
		
		if( !is_numeric($this->ownerid) ) 
			return self::INVALID_DATA;
			
		$query = sprintf("insert into contacts (ownerid, cname, email, phone) values(%d, '%s', '%s', '%s');",
				$this->ownerid,
				$mysql->escapeString($this->cname),
				$mysql->escapeString($this->email),
				$mysql->escapeString($this->phone)
		);
		
		$res = $mysql->executeQuery($query);
		
		if( $res === false ) 
			return self::DATABASE_ERROR;
	
		return self::INSERT_SUCCESS;
	}
	
	// Updates a contact in database from values in the fields
	public function update($mysql){
		if( !is_numeric($this->cid) ) 
			return self::INVALID_DATA;

		$query = sprintf("update contacts set cname='%s', email='%s', phone='%s' where cid=%d;",
				$mysql->escapeString($this->cname),
				$mysql->escapeString($this->email),
				$mysql->escapeString($this->phone),
				$this->cid
		);
		
		$res = $mysql->executeQuery($query);
		
		if( $res === false ) 
			return self::DATABASE_ERROR;
			
		return self::UPDATE_SUCCESS;
	}
	
	// Deletes a contact using its cid of correct owner
	public function delete($cid, $ownerid, $mysql) {
		if( !is_numeric($cid) ) 
			return self::INVALID_DATA;
		
		if( !is_numeric($ownerid) ) 
			return self::INVALID_DATA;
		
		$res = $mysql->executeQuery("delete from contacts where cid=$cid and ownerid=$ownerid");
		if( $res === false ) 
			return self::DATABASE_ERROR;
			
		return self::DELETE_SUCCESS;
	}
	
	// Accessor methods
	public function getOwnerId() { return $this->ownerid; }
	public function getName(){ return $this->cname; }
	public function getEmail() { return $this->email; }
	public function getPhone() { return $this->phone; }

}

?>

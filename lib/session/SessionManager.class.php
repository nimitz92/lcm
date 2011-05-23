<?php
	require_once(ROOT . 'lib/database/MySQL.class.php');
	require_once(ROOT . 'lib/session/Session.class.php');
	require_once(ROOT . 'lib/util/Time.class.php');
	require_once(ROOT . 'lib/util/Random.class.php');
	
	class SessionManager{
		
		public function __construct(){
		$mysql=new MySQL();
		self::deleteAllSessions($mysql,time());
		}
		public function addSession($mysql, $uid) {
		
		$time = Time::getTime();
		$session= new Session;
		$random = Random::getString(32);
		$expiry = $time + 30*24*60*60;
		$session->read($uid,$time,$expiry);
			switch($session->insert($mysql, $random)) {
				case Session::DATABASE_ERROR :
				{
					echo "<p>A Database error has occured.</p>";
					return;
				}
				case Session::INVALID_DATA :
				{
					echo "<p>Invalid operation requested.</p>";
					return;
				}
				case Session::INSERT_SUCCESS : 
				{
					
					return $random;
				}
				default :
					break;
			}
	}

	
	
	public function deleteSession($mysql, $sid) {
			$session = new Session();
			switch($session->delete($sid,$mysql)) {
				case Session::DATABASE_ERROR :
				{
					echo "<p>A Database error has occured.</p>";
					return;
				}
				case Session::INVALID_DATA :
				{
					echo "<p>Invalid operation requested.</p>";
					return;
				}
				case Session::DELETE_SUCCESS : 
				{
					echo "<p>Session deleted successfully.</p>";
					break;
				}
				
				default :
					break;
			}
	}
	public static function deleteAllSessions($mysql,$time){
		
		$q="delete from session where expiry<$time;";
		$mysql->executeQuery($q);
	}
	
	
	public function getUid($sid,$mysql){
		$q=sprintf("select uid from session where sid = '%s';",$mysql->escapeString($sid));
		$res=$mysql->executeQuery($q);
		
		
			$result=$mysql->getNextRow($res);
			$uid=$result[0];
			return $uid;
		}
		
	}
	
	
?>
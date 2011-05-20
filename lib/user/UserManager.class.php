 <?php 

// Acknowledgements : Codefest 2011

require_once(ROOT . 'lib/database/MySQL.class.php');
require_once(ROOT . 'lib/user/User.class.php');

class UserManager {
	

	private function getAllContacts($mysql) {
		$query = "select uid, username, password from contacts";
		
		$res = $mysql->executeQuery($query);
		if( $res === false ) 
			return false;
		
		return $mysql->getResultAsArray($res);
	}
	
	public function displayForm($mysql, $uid= 0) {
		$username = "";
		$password = "";
		
		
		echo <<<FORM
		<div id="user">
			<form action="" method="POST">
				<input type='hidden' name='uid' value='$uid'>
				<table>
					<tbody>
						<tr>
							<td>Username</td>
							<td>"$username"</td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="Password" name="password" /></td>
						</tr>
							<td><input type="reset" value="Reset"/></td>
							<td><input type="submit"  name="action" value="Save"/></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
FORM;

	}
	
	public function addUser($mysql, $username, $password) {
		$user = new User();
		$user->read($username, $password);
			switch($user->insert($mysql)) {
				case User::DATABASE_ERROR :
				{
					echo "<p>A Database error has occured.</p>";
					return;
				}
				case User::INVALID_DATA :
				{
					echo "<p>Invalid operation requested.</p>";
					return;
				}
				case User::INSERT_SUCCESS : 
				{
					echo "<p>User added successfully.</p>";
					break;
				}
				case User::USERNAME_TAKEN :
				{
					echo "Username alraedy Exists.";
					break;
				}
				default :
					break;
			}
	}
	
	public function updateUser($mysql, $uid, $username, $password) {
		$user = new User();
			switch($user->select($uid, $mysql)) {
				case User::DATABASE_ERROR :
				{
					echo "<p>A Database error has occured.</p>";
					return;
				}
				case User::INVALID_DATA :
				{
					echo "<p>Invalid operation requested.</p>";
					return;
				}
				case User::SELECT_SUCCESS : 
				default :
					break;
			}
			
			$user->read($username,$password);
			
			switch($user->update($mysql)) {
				case User::DATABASE_ERROR :
				{
					echo "<p>A Database error has occured.</p>";
					return;
				}
				case User::INVALID_DATA :
				{
					echo "<p>Invalid operation requested.</p>";
					return;
				}
				case User::UPDATE_SUCCESS : 
				{
					echo "<p>User updated successfully.</p>";
					break;
				}
				default :
					break;
			}
	}
	
	public function deleteContact($mysql, $uid) {
			$user = new User();
			switch($user->delete($uid,$mysql)) {
				case User::DATABASE_ERROR :
				{
					echo "<p>A Database error has occured.</p>";
					return;
				}
				case User::INVALID_DATA :
				{
					echo "<p>Invalid operation requested.</p>";
					return;
				}
				case User::DELETE_SUCCESS : 
				{
					echo "<p>User deleted successfully.</p>";
					break;
				}
				
				default :
					break;
			}
	}
	
	public function viewContacts($mysql) {
		$users = $this->getAllContacts( $mysql);
		
		echo <<<DISPLAY
		<div id="contacts-section">
			<form action="" method="POST">
			<input type="submit" name="action" value="New user ..." />
			<table>
				<thead>
					<tr>
						<th>Select</th>
						<th>Username</th>
						<th>Password</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="submit" name="action" value="Edit" /></td>
						<td colspan="3"><input type="submit" name="action" value="Delete" /></td>
					</tr>
DISPLAY;
		
		if($users === null)
			echo "<p>A database error occurred while fetching contacts.</p>";
		else if( count($contacts) == 0 ) {
			echo "<tr><td colspan='4'>No users yet.</td></tr>";
		} else {
			foreach($users as $user) {
				$uid = $user[0];
				$username = $user[1];
				$password = $user[2];
				
				echo <<<USER
				<tr>
					<td><input type="radio" name="uid" value="$uid"></td>
					<td>$username</td>
					<td>$password</td>
				</tr>
USER;
			}
		}
		
		echo <<<DISPLAY
					</tbody>
				</thead>
			</table>
			</form>
		</div>
DISPLAY;

	}

	public function authenticate($mysql,$username,$password){
		
		$username=$mysql->escapeString($username);
		$pass=$mysql->escapeString($password);
		$query=sprintf("select uid from user where username='%s' and password='%s'",
			$username,
			MD5("$username$pass")
			);
		
		$res=$mysql->executeQuery($query);
		if ($res === false)
		{
			return -1;
		}
		else
		{
			$result=$mysql->getNextRow($res);
			
		if($mysql->getRowsCount($res)!=1){
		
		return -1;
		}
		else
			{
				$uid=$result[0];
				return $uid;
			}
		}
	}
	}
?>

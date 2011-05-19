<?php 

// Acknowledgements : Codefest 2011

require_once(ROOT . 'lib/database/MySQL.class.php');
require_once(ROOT . 'lib/contact/Contact.class.php');

class ContactManager {

	private function getAllContacts($ownerid, $mysql) {
		$query = "select cid, cname, email, phone from contacts where ownerid=$ownerid;";
		
		$res = $mysql->executeQuery($query);
		if( $res === false ) 
			return false;
		
		return $mysql->getResultAsArray($res);
	}
	
	public function displayForm($mysql, $cid = 0, $ownerid = 0) {
		$name = "";
		$email = "";
		$phone = "";
		
		if($cid != 0) {
			$con = new Contact();
			switch($con->select($cid, $ownerid, $mysql)) {
				case Contact::DATABASE_ERROR :
				{
					echo "<p>A Database error has occured.</p>";
					return;
				}
				case Contact::INVALID_DATA :
				{
					echo "<p>Invalid operation requested.</p>";
					return;
				}
				case Contact::SELECT_SUCCESS : 
				{
					$name = $con->getName();
					$email = $con->getEmail();
					$phone = $con->getPhone();
					break;
				}
				default :
					break;
			}
		}
		
		echo <<<FORM
		<div id="contact">
			<form action="" method="POST">
				<input type='hidden' name='cid' value='$cid'>
				<table>
					<tbody>
						<tr>
							<td>Name</td>
							<td><input type="text" name="cname" value="$name"/></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><input type="text" name="email" value="$email"/></td>
						</tr>
						<tr>
							<td>Phone</td>
							<td><input type="text" name="phone" value="$phone"/></td>
						</tr>
						<tr>
							<td><input type="reset" value="Reset"/></td>
							<td><input type="submit"  name="action" value="Save"/></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
FORM;

	}
	
	public function addContact($mysql, $name, $email, $phone, $ownerid) {
		$con = new Contact();
		$con->read($ownerid, $name, $email, $phone);
			switch($con->insert($mysql)) {
				case Contact::DATABASE_ERROR :
				{
					echo "<p>A Database error has occured.</p>";
					return;
				}
				case Contact::INVALID_DATA :
				{
					echo "<p>Invalid operation requested.</p>";
					return;
				}
				case Contact::INSERT_SUCCESS : 
				{
					echo "<p>Contact added successfully.</p>";
					break;
				}
				default :
					break;
			}
	}
	
	public function updateContact($mysql, $cid, $name, $email, $phone, $ownerid) {
		$con = new Contact();
			switch($con->select($cid, $ownerid, $mysql)) {
				case Contact::DATABASE_ERROR :
				{
					echo "<p>A Database error has occured.</p>";
					return;
				}
				case Contact::INVALID_DATA :
				{
					echo "<p>Invalid operation requested.</p>";
					return;
				}
				case Contact::SELECT_SUCCESS : 
				default :
					break;
			}
			
			$con->read($ownerid, $name, $email, $phone);
			
			switch($con->update($mysql)) {
				case Contact::DATABASE_ERROR :
				{
					echo "<p>A Database error has occured.</p>";
					return;
				}
				case Contact::INVALID_DATA :
				{
					echo "<p>Invalid operation requested.</p>";
					return;
				}
				case Contact::UPDATE_SUCCESS : 
				{
					echo "<p>Contact updated successfully.</p>";
					break;
				}
				default :
					break;
			}
	}
	
	public function deleteContact($mysql, $cid, $ownerid) {
			$con = new Contact();
			switch($con->delete($cid, $ownerid, $mysql)) {
				case Contact::DATABASE_ERROR :
				{
					echo "<p>A Database error has occured.</p>";
					return;
				}
				case Contact::INVALID_DATA :
				{
					echo "<p>Invalid operation requested.</p>";
					return;
				}
				case Contact::DELETE_SUCCESS : 
				{
					echo "<p>Contact deleted successfully.</p>";
					break;
				}
				default :
					break;
			}
	}
	
	public function viewContacts($ownerid, $mysql) {
		$contacts = $this->getAllContacts($ownerid, $mysql);
		
		echo <<<DISPLAY
		<div id="contacts-section">
			<form action="" method="POST">
			<input type="submit" name="action" value="New Contact ..." />
			<table>
				<thead>
					<tr>
						<th>Select</th>
						<th>Name</th>
						<th>E Mail</th>
						<th>Phone</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="submit" name="action" value="Edit" /></td>
						<td colspan="3"><input type="submit" name="action" value="Delete" /></td>
					</tr>
DISPLAY;
		
		if($contacts === null)
			echo "<p>A database error occurred while fetching contacts.</p>";
		else if( count($contacts) == 0 ) {
			echo "<tr><td colspan='4'>No contacts yet.</td></tr>";
		} else {
			foreach($contacts as $con) {
				$cid = $con[0];
				$cname = $con[1];
				$email = $con[2];
				$phone = $con[3];
				
				echo <<<CONTACT
				<tr>
					<td><input type="radio" name="cid" value="$cid"></td>
					<td>$cname</td>
					<td>$email</td>
					<td>$phone</td>
				</tr>
CONTACT;
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
}

?>

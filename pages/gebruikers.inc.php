<?php
	/**
	 * GebruikersPage class.
	 *
	 * @extends Core
	 * @implements iPage
	 */
/*
	Contains details of page information
	returns the built html
	Class Name convention: <pagename>Page
	Must contain iPage interface implementation
	Called by content.inc.php

	Possible ACTION: create, read, update , delete
	Possible PARAM: uuid (@details)
*/
	class GebruikersPage extends Core implements iPage {

		public function getHtml() {
			if(defined('ACTION')) {			// process the action obtained is existent
				switch(ACTION) {
					// get html for the required action
					case "create"	: return $this->create(); break;
					case "read"		: return $this->read(); break;
					case "update"	: return $this->update();break;
					case "delete"	: return $this->delete();
				}
			} else { // no ACTION so normal page
				$table 	= $this->getData();		// get users from database in tableform
				$button = $this->addButton("/create", "Toevoegen");	// add "/add" button. This is ACTION button
				// first show button, then table
				$html = $button . "<br />" . $table;
				return $html;
			}
		}

		// show button with the PAGE $p_sAction and the tekst $p_sActionText
		private function addButton($p_sAction, $p_sActionText) {
			// calculate url and trim all parameters [0..9]
			$url = rtrim($_SERVER['REQUEST_URI'],"/[0..9]");
			// create new link with PARAM for processing in new page request
			$url = $url . $p_sAction;
			$button = "<button onclick='location.href = \"$url\";'>$p_sActionText</button>";
			return $button;
		}

		private function getData(){
			// execute a query and return the result
			$sql='SELECT * FROM `tb_users` WHERE status = 0 OR status = 1 ORDER BY username';
            $result = $this->createTable(Database::getData($sql));

			//TODO: generate JSON output like this for webservices in future
			/*
				$data = Database::getData($sql);
				$json = Database::jsonParse($data);
				$array = Database::jsonParse($json);

				echo "<br />result: ";  print_r(Database::getData($sql));
	            echo "<br /><br />json :" . $json;
	            echo "<br /><br />array :"; print_r($array);
			*/

			return $result;
		} // end function getData()

		private function createTable($p_aDbResult){ // create html table from dbase result
			$imageC = "<img src='".ICONS_PATH."create.png' width=\"50\" height=\"70\" />";
			$imageR = "<img src='".ICONS_PATH."read.png' width=\"50\" height=\"70\" />";
			$imageU = "<img src='".ICONS_PATH."update.png' width=\"50\" height=\"70\" />";
			$imageD = "<img src='".ICONS_PATH."delete.png' width=\"50\" height=\"70\" />";
			$table = "<table>"; 
				$table .= "<col><col><col><col><col><col><col>";
				$table .= "	<th>Inlognaam</th>
							<th>E-mailadres</th>
							<th>Status</th>
							<th>Rechten</th>
							<th>Bekijk</th>
							<th>Verwijder</th>
							<th>Aanpassen</th>";
				// now process every row in the $dbResult array and convert into table
				foreach ($p_aDbResult as $row){
					$table .= "<tr>";
					$table .= "<td>" . $row['username'] . "</td>";
					$table .= "<td>" . $row['email'] . "</td>";
					$table .= "<td>" . $row['status'] . "</td>";
					$table .= "<td>" . $row['role'] . "</td>";

						// calculate url and trim all parameters [0..9]
	                    $url = rtrim($_SERVER['REQUEST_URI'],"/[0..9]");
						// create new link with parameter (== edit user link!)
						$table 	.= "<td><a href="
								. $url 							// current menu
								. "/read/" . $row["uuid"] 	// add ACTION and PARAM to the link
								. ">$imageR</a></td>";			// link to edit icon
						//create new link with parameter (== delete user)
						$table 	.= "<td><a href="
								. $url 							// current menu
								. "/delete/" . $row["uuid"] 	// add ACTION and PARAM to the link
								. ">$imageD</a></td>";			// link to delete icon
						// create new link with parameter (== update)
						$table 	.= "<td><a href="
								. $url 							// current menu
								. "/update/" . $row["uuid"] 	// add ACTION and PARAM to the link
								. ">$imageU</a></td>";			// link to delete icon
					$table .= "</tr>";
					
				} // foreach
			$table .= "</table>";
			return $table;
		} //function

		// [C]rud action example
		// based on sent form 'frmAddUser' fields
		private function create() {
			// use variabel field  from form for processing -->
			if(isset($_POST['frmAddUser'])) { // in this case the form is returned
				return $this->processFormAddUser();
			} // ifisset
			else {								// in this case the form is made
				return $this->addForm();
			} //else
		}

		private function addForm() { // processed in $this->processFormAddUser()
			$url = rtrim($_SERVER['REQUEST_URI'],"/[0..9]"); 	// strip not required info
			// heredoc statement. Everything between 2 HTML labels is put into $html
			$html = <<<HTML
				<fieldset>
					<legend>Voeg een nieuwe gebruiker toe</legend>
						<form action="$url" enctype="multipart/formdata" method="post">
							<label>Inlognaam</label>
							<input type="text" name="loginname" id="" value="foute naam" placeholder="Inlognaam" />

							<label>Wachtwoord</label>
							<input type="text" name="password" id="" value="" placeholder="Wachtwoord" />

							<label>Rol</label>
							<input type="text" name="role" id="" value="" placeholder="Rol" />

							<label>E-mail</label>
							<input type="text" name="email" id="" value="" placeholder="E-mailadres" />

							<label></label>
							<!-- add hidden field for processing -->
							<input type="hidden" name="frmAddUser" value="frmAddUser" />
							<input type="submit" name="submit" value="Voeg toe" />
						</form>
				</fieldset>
HTML;
			return $html;
		} // function

		private function processFormAddUser() {
			$hash 		= $this->createHash(); // in code
			$uuid 		= $this->createUuid(); // in code
			$hashDate 	= $this->createHashDate(); // in core
			// get transfered datafields from form "$this->addForm()"
	
			$username 	= $_POST['loginname'];
			$password	= password_hash($_POST['password'], PASSWORD_DEFAULT);
			$role		= $_POST['role'];
			$email		= $_POST['email'];
			// create insert query with all info above
			$sql = "INSERT
						INTO tb_users
							(uuid, username, password, email, role, hash, hash_date)
								VALUES
									('$uuid', '$username', '$password', '$email', '$role', '$hash', '$hashDate')";

			Database::getData($sql);
			/*
				echo "<br />";
				echo $hash . "<br />";
				echo $uuid . "<br />";
				echo $hashDate . "<br />";
			*/
			return "Gebruiker is toegevoegd.";
		} //function

		// c[R]ud action
		private function read() {
			// get and present information from the user with uuid in PARAM
			$button = $this->addButton("/../../../gebruikers", "Terug");	
			// first show button, then table
			return $button ."<br>Dit zijn de details van " . PARAM;
		} // function details

		//cr[U]d action
		private function update() {
			// present form with all user information editable and process
			// use variabel field  from form for processing -->
			if(isset($_POST['frmUpdUser'])) { // in this case the form is returned and processed
				return $this->processFormUpdate();
			} // ifisset
			else {								// in this case the form is made
				return $this->updateForm();
			} //else
			$button = $this->addButton("/../../..", "Terug");	
			// first show button, then table

			return $button ."<br>Deze gebruiker is aangepast " . PARAM;
		}

		// if update form sent, save information in database for user uuid
		private function processFormUpdate(){
			$username 	= $_POST['loginname'];
			$uuid		= $_POST['uuid'];
			// old password is hashed
			$password	= $_POST['password']; // old password. If old !=new then process new 

			$passwordnew	= password_hash($_POST['passwordnew'], PASSWORD_DEFAULT);
			// new password also hashed	

			$role		= $_POST['role'];
			$email		= $_POST['email'];
			$status		= $_POST['status'];
			$hash 		= $_POST['hash'];
			$hashdate	= $_POST['hashdate'];
			// data retrieved from form, now update form
			$sql = '
			UPDATE tb_users
				SET 	username 	= "'. $username . '"
					, 	password 	= "'. $passwordnew . '"
					, 	email		= "'. $email. '"
					, 	role		= "'. $role. '"
					, 	status		= "'. $status. '"
					, 	hash		= "'. $hash. '"
					, 	hash_date	= "'. $hashdate. '" 
				WHERE uuid 			= "'. $uuid . '";';
			Database::getData($sql);
			return "Gebruiker $username aangepast";			

		}

		// get data from database for user uuid and create form with source data
		// uuid passed via PARAM
		private function updateForm(){
			$sql='SELECT * FROM `tb_users` WHERE uuid = "'.PARAM . '"';
			// getdata from database (assumed uuid exist once)
			$result=Database::getData($sql);

			// get result data te be stored in form
			$username = $result[0]['username'];
			$uuid = $result[0]['uuid'];
			$password = $result[0]['password'];
			$email = $result[0]['email'];
			$role =$result[0]['role'];
			$status = $result[0]['status'];
			$hash = $result[0]['hash'];
			$hashdate = $result[0]['hash_date'];
			// create form
			$url = rtrim($_SERVER['REQUEST_URI'],"/[0..9]"); 	// strip not required info
			// heredoc statement. Everything between 2 HTML labels is put into $html
			$html = <<<HTML
				<fieldset>
					<legend>Voeg een nieuwe gebruiker toe</legend>
						<form action="$url" enctype="multipart/formdata" method="post">
							<label>Inlognaam</label>
							<input type="text" name="loginname" id="" value="$username" placeholder="Inlognaam" />

							<label>Wachtwoord</label>
							<input type="text" name="passwordnew" id="" value="" placeholder="Wachtwoord" />

							<label>Rol</label>
							<input type="text" name="role" id="" value="$role" placeholder="Rol" />

							<label>Status</label>
							<input type="text" name="status" id="" value="$status" placeholder="Rol" />

							<label>E-mail</label>
							<input type="text" name="email" id="" value="$email" placeholder="E-mailadres" />

							<label></label>
							<!-- add hidden field for processing -->
							<input type="hidden" name="uuid" value="$uuid" />
							<input type="hidden" name="hash" value="$hash" />
							<input type="hidden" name="hashdate" value="$hashdate" />
							<input type="hidden" name="password" value="$password" />
							
							<input type="hidden" name="frmUpdUser" value="frmUpdUser" />
							<input type="submit" name="submit" value="Pas aan" />
						</form>
				</fieldset>
HTML;
			return $html;
		}

		//cru[D] action
		private function delete() {
			// remove selected record based om uuid in PARAM
			$sql='DELETE FROM tb_users WHERE uuid="' . PARAM. '"';		
            $result = Database::getData($sql);
			$button = $this->addButton("/../../..", "Terug");	// add "/add" button. This is ACTION button
			// first show button, then table

			return $button ."<br>Deze gebruiker is verwijderd " . PARAM;
		}
	}// class gebruikerPage
?>
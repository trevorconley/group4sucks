<title>User Management</title>

	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content">
			<div class="post">
				<?php
					@$action  = $_POST["CreateAccount"];
					@$temp_fn = $_POST["FirstName"];
					@$temp_ln = $_POST["LastName"];
					@$temp_pw = $_POST["Password"];
					@$temp_ph = $_POST["Phone"];
					@$temp_ca = $_POST["Carrier"];
					@$temp_em = $_POST["Email"];

					$fn_err = $ln_err = $pw_err = $ph_err = $ca_err = $em_err = "";

					if ($action == "TRUE") 
					{
						if ($temp_fn == "") 
						{
							$fn_err = "You cannot leave your first name blank.";
						}

						if ($temp_ln == "") 
						{
							$ln_err = "You cannot leave your last name blank.";
						}

						if ($temp_pw == "") 
						{
							$pw_err = "You cannot leave your password blank.";
						} else 
						{
							if (strlen($temp_pw) < 8) 
							{
								$pw_err = "Your password must be at least 8 characters long.";
							} else {
								$contains_number    = 0;
								$contains_uc_letter = 0;
								$contains_lc_letter = 0;
								$contains_invalid   = 0;

								for ($counter = 0; $counter < strlen($temp_pw); $counter++) 
								{
									$value = ord(substr($temp_pw, $counter, 1));

									if ($value > 47 && $value < 58)
									{
										$contains_number = 1;
									} 
									else if ($value > 64 && $value < 91) 
									{
										$contains_uc_letter = 1;
									} else if ($value > 96 && $value < 123) 
									{
										$contains_lc_letter = 1;
									} else 
									{
										$contains_invalid = 1;
									}
								}

								if ($contains_invalid == 1) 
								{
									$pw_err = "Your password contains invalid characters.";
								} else 
								{
									if ($contains_number == 1 && ($contains_uc_letter == 1 || $contains_lc_letter == 1)) 
									{
										// Password's good! :)
									} else {
									
										$pw_err = "Your password must consist of letters AND numbers, not just one or the other.";
									}
								}
							}
						}

						if ($temp_ph != "") 
						{
							for ($counter = 0; $counter < strlen($temp_ph); $counter++) 
							{
								$value = ord(substr($temp_ph, $counter, 1));

								if ($value < 48 || $value > 57) 
								{
									$ph_err = "Your phone number can only consist of numbers!";
									break;
								}
							}

							if ($ph_err == "" && strlen($temp_ph) != 10) 
							{
								$ph_err = "Your phone number must be exactly 10 numbers (eg: 5554443333).";
							}
						}

						if ($temp_em == "") 
						{
							$em_err = "Your email cannot be left blank.";
						} else {
							$user_exists = 0;
							$query = mysql_query("SELECT ID FROM Users WHERE Email='".$temp_em."'");
							while ($result = mysql_fetch_row($query)) 
							{
								$user_exists = 1;
							}
							if ($user_exists == 1) 
							{
								$em_err = "This email address is already registered to another account.";
							}
						}

			//			$query      = false;
						$sent_query = false;

						if ($fn_err == "" && $ln_err == "" && $pw_err == "" && $ph_err == "" && $ca_err == "" && $em_err == "") 
						{
			//				$sent_query = true;
			//				$query      = mysql_query("INSERT INTO Users (FirstName, LastName, Password, Superuser, Phone, Carrier, Email, SessionID) VALUES ('".$temp_fn."', '".$temp_ln."', '".md5($temp_pw)."', '0', '".$temp_ph."', '".$temp_ca."', '".$temp_em."', '')");
						}
					}

					if ($action == "TRUE") 
					{
						if ($fn_err == "" && $ln_err == "" && $pw_err == "" && $ph_err == "" && $ca_err == "" && $em_err == "") 
						{
							if ($query && $sent_query) 
							{
								echo "<center><font color='green'>Successfully created your account!</font></center>";
							} else if ($sent_query) {
								echo "<center><font color='red'>There was a problem with adding your account to our records: ".mysql_error()."</font></center>";
							}
						} else {
							echo "<center><font color='red'>Errors were found in the information you submitted, see feedback below.</font></center><br /><br />";
						}
					}

					if (@!$query || !$sent_query || $action != "TRUE") 
					{
						echo "<form action='admin.php' method='POST'>";
						echo "<input type='hidden' name='CreateAccount' value='TRUE' />";
						echo "<table cellpadding='0' cellspacing='0'>";
						echo "<tr>";
							echo "<td id='form_left'>First Name: </td>";
							echo "<td id='form_middle'><input id='text_box' name='FirstName' type='text' value='".$temp_fn."' /></td>";
							echo "<td id='form_right'><font color='red'>".$fn_err."</font></td>";
						echo "</tr>";
						echo "<tr>";
                            echo "<td id='form_left'>Last Name: </td>";
							echo "<td id='form_middle'><input id='text_box' name='LastName' type='text' value='".$temp_ln."' /></td>";
							echo "<td id='form_right'><font color='red'>".$ln_err."</font></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td id='form_left'>Email (your login): </td>";
							echo "<td id='form_middle'><input id='text_box' name='Email' type='text' value='".$temp_em."' /></td>";
							echo "<td id='form_right'><font color='red'>".$em_err."</font></td>";
						echo "</tr>";
							echo "<tr>";
							echo "<td id='form_left'>Password: </td>";
							echo "<td id='form_middle'><input id='text_box' name='Password' type='password' value='' /></td>";
							echo "<td id='form_right'><font color='red'>".$pw_err."</font></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td colspan='3'>Passwords <font color='red'>must</font> be at least 8 characters long, and must contain at least one number and one letter (uppercase or lowercase).</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td id='form_left'>Phone: </td>";
							echo "<td id='form_middle'><input id='phone_box' name='Phone' type='text' value='".$temp_ph."' /></td>";
							echo "<td id='form_right'><font color='red'>".$ph_err."</font></td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td id='form_left'>Access Level: </td>";
							echo "<td id='form_middle'><select name='Access' id='access_box'>";
							echo "<option value='writer'>Writer</option>";
							echo "<option value='publisher'>Publisher</option>";
							echo "<option value='superuser'>Super User</option>";
							echo "</select></td>";
                            echo "<td id='form_right'><font color='red'>".$fn_err."</font></td>";
                            echo "</tr>";
						echo "</table><br /><br />";
						echo "<center><input type='submit' value='Create Account' /></center>";
						echo "</form>";
					}
				?>
			</div>
		<div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end #content -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	</div>
	</div>
	<!-- end #page -->
</div>
</body>
</html>

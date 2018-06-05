<?php

session_start();
date_default_timezone_set("Asia/Karachi");

include 'dbh.inc.php';

if (isset($_POST['submit'])) {

	$username = mysqli_real_escape_string($connection, $_POST['uid']);
	$password = mysqli_real_escape_string($connection, $_POST['pwd']);
	$email = mysqli_real_escape_string($connection, $_POST['eid']);
	$full_name = mysqli_real_escape_string($connection, $_POST['full_name']);
	$gender = mysqli_real_escape_string($connection, $_POST['gender']);
	$birthday = mysqli_real_escape_string($connection, $_POST['birthday']);
	$phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);

	$emptyCheck = 
		empty($username) || 
		empty($password) || 
		empty($email) || 
		empty($full_name) ||  
		empty($gender) || 
		empty($birthday) ||
		empty($phone_number);

	// Check for empty fields
	if ($emptyCheck) {
		echo ("
			<script type='text/javascript'> 
				window.location.href='../shop.php?register=empty-fields'; 
				window.alert('You must fill all the fields\\nTry Again.');
			</script>
		");
	} else {
		// Check whether username is valid
		if (!preg_match("/^[a-zA-Z]+[a-zA-Z0-9]{3}/", $username) || strlen($username) > 21) {
			echo ("
				<script type='text/javascript'> 
					window.location.href='../shop.php?register=invalid-username';
					window.alert('Invalid Username\\n\\n1. Should only contain letters and numbers\\n2. Limited to 5-21 character
				s\\n3. Start with a letter.');
				</script>
			");
		} else {
			// Check whether email is valid
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo ("
					<script type='text/javascript'> 
						window.location.href='../shop.php?register=invalid-email'; 
					</script>
				");			
			} else {

				$result = mysqli_query (
					$connection, 
					"SELECT * FROM users WHERE uid='$username'"
				);

				if (mysqli_num_rows($result) > 0) {
					echo ("
						<script type='text/javascript'> 
							window.location.href='../shop.php?register=user-taken'; 
							window.alert('Username already exists');
						</script>
					");
				} else {

					$result = mysqli_query (
						$connection, 
						"SELECT * FROM users WHERE eid='$email'"
					);

					if (mysqli_num_rows($result) > 0) {

						echo ("
							<script type='text/javascript'> 
								window.location.href='../shop.php?register=email-taken'; 
								window.alert('Email is already taken');
							</script>
						");

					} else {
						// Hash password
						$hashP = password_hash($password, PASSWORD_DEFAULT);

						// Birthday
						$birthday = date_create($birthday);
						$birthday = date_format($birthday, "Y/m/d");

						// Insert User into database
						mysqli_query (
							$connection, 
							"
								INSERT INTO users (uid, eid, pwd, full_name, gender, birthday, phone_number) 
								VALUES ('$username', '$email', '$hashP', '$full_name', '$gender', '$birthday', '$phone_number')
							"
						);

						echo ("
							<script type='text/javascript'> 
								window.location.href='../shop.php?register=success'; 
							</script>
						");
					}
				}
			}
		}
	}
} else {
	echo ("
		<script type='text/javascript'> 
			window.location.href='../shop.php?register=error'; 
		</script>
	");
}
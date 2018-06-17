<?php

$root_dir = $_SERVER["DOCUMENT_ROOT"];

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

include($root_dir . '/includes/dbh.inc.php');

if (isset($_POST['submit']) and isset($_GET['type'])) {
	$name = mysqli_real_escape_string($connection, $_POST['name']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	$emptyCheck = empty($name) || empty($email) || empty($password);
	if ($emptyCheck) {
		echo ("
			<script type='text/javascript'> 
				window.location.href='../index.php?form=signup'; 
				window.alert('You must fill all the fields\\nTry Again.');
			</script>
		");
	} else {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo ("
				<script type='text/javascript'> 
					window.location.href='../index.php?form=signup';
					window.alert('Invalid Email\\nTry Again.');
				</script>
			");			
		} else {
			$sql = "SELECT * FROM (users) WHERE email='$email'";
			$result = mysqli_query ($connection, $sql);

			if (mysqli_num_rows($result) > 0) {

				echo ("
					<script type='text/javascript'> 
						window.location.href='../index.php?form=signup';
						window.alert('Email is already taken');
					</script>
				");

			} else {
				// Hash password
				$hashP = password_hash($password, PASSWORD_DEFAULT);
				$type = $_GET['type'];

				// Insert User into database
				$sql = "INSERT INTO users (name, email, password, type) VALUES ('$name', '$email', '$hashP', '$type')";
				mysqli_query($connection, $sql);

				$sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
				$result = mysqli_query($connection, $sql);

				$row = mysqli_fetch_assoc($result);

				$user_id = $row['id'];
				$profile_picture_directory = "assets/img/profile_pictures/default_profile_picture.jpg";

				// User Info
				if ($type === "D") {
					$sql = sprintf("INSERT INTO donators_info (user_id, profile_picture_directory, profile_bio) VALUES (%d, '%s', '%s')", $user_id, $profile_picture_directory, "");
					mysqli_query($connection, $sql);
				} else {
					$sql = sprintf("INSERT INTO organisations_info (user_id, profile_picture_directory, profile_description, category) VALUES ('%d', '%s', '%s', '%s')", $user_id, "$profile_picture_directory", "", mysqli_real_escape_string($connection, $_POST['category']));
					mysqli_query($connection, $sql);
				}

				echo ("
					<script type='text/javascript'> 
						window.location.href='../index.php?signup=success';
					</script>
				");
			}
		}
	}
} else {
	echo ("
		<script type='text/javascript'> 
			window.location.href='../index.php';
		</script>
	");
}
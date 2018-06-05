<?php

$root_dir = $_SERVER["DOCUMENT_ROOT"];

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

include($root_dir . '/includes/dbh.inc.php');

// Donator Sign up
if (isset($_POST['don_submit'])) {
	$full_name = mysqli_real_escape_string($connection, $_POST['full_name']);
	$email = mysqli_real_escape_string($connection, $_POST['don_email']);
	$password = mysqli_real_escape_string($connection, $_POST['don_password']);

	$emptyCheck = empty($full_name) || empty($email) || empty($password);
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
			$result = mysqli_query (
				$connection, 
				"SELECT * FROM (organisations, donators) WHERE organisations.email='$email' OR donators.email='$email'"
			);

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

				// Insert User into database
				mysqli_query (
					$connection, 
					"INSERT INTO donators (name, email, password) VALUES ('$full_name', '$email', '$hashP')"
				);

				echo ("
					<script type='text/javascript'> 
						window.location.href='../index.php?signup=success';
					</script>
				");
			}
		}
	}
} else if (isset($_POST['org_submit'])) {
	$org_name = mysqli_real_escape_string($connection, $_POST['org_name']);
	$email = mysqli_real_escape_string($connection, $_POST['org_email']);
	$password = mysqli_real_escape_string($connection, $_POST['org_password']);

	$emptyCheck = empty($org_name) || empty($email) || empty($password);
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
			$result = mysqli_query (
				$connection, 
				"SELECT * FROM (organisations, donators) WHERE organisations.email='$email' OR donators.email='$email'"
			);

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

				// Insert User into database
				mysqli_query (
					$connection, 
					"INSERT INTO organisations (name, email, password) VALUES ('$org_name', '$email', '$hashP')"
				);

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
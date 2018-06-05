<?php

$root_dir = $_SERVER["DOCUMENT_ROOT"];

ob_start();
session_start();

include($root_dir . '/includes/dbh.inc.php');

if (isset($_POST['submit'])) {

	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	if (empty($email) || empty($password)) {
		echo ("
			<script type='text/javascript'> 
				window.location.href='../index.php?form=login';
				window.alert('You must fill all the fields\\nTry Again.');
			</script>
		");
	} else {

		$result_don = mysqli_query (
			$connection, 
			"SELECT * FROM donators WHERE email = '$email'"
		);

		$result_org = mysqli_query (
			$connection, 
			"SELECT * FROM organisations WHERE email='$email'"
		);

		$result = $result_don;

		if (mysqli_num_rows($result) < 1) {
			if (mysqli_num_rows($result_org) >= 1) {
				$result = $result_org;
			}
		} 

		if (mysqli_num_rows($result) < 1) {
			echo ("
				<script type='text/javascript'> 
					window.location.href='../index.php?form=login';
					window.alert('No user associated with the entered email\\nTry Again.');
				</script>
			");
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				
				$hashP = password_verify($password, $row['password']);

				if ($hashP === false) {
					echo ("
						<script type='text/javascript'> 
							window.location.href='../index.php?form=login';
							window.alert('Wrong password\\nTry Again.');
						</script>
					");
				} else if ($hashP === true) {
					
					// Log the user in
					$_SESSION['u_id'] = $row['id'];
					$_SESSION['u_email'] = $row['email'];
					
					echo ("
						<script type='text/javascript'> 
							window.location.href='../index.php?login=success';
						</script>
					");
				}
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
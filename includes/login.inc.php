<?php

$root_dir = $_SERVER["DOCUMENT_ROOT"];

ob_start();
session_start();

require($root_dir . '/includes/dbh.inc.php');

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
		$sql = "SELECT * FROM users WHERE email = '$email'";
		$result = mysqli_query($connection, $sql);

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
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['user_name'] = $row['name'];
					$_SESSION['user_type'] = $row['type'];
					
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
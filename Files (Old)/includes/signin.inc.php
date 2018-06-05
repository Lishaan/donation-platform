<?php

ob_start();
session_start();

include 'dbh.inc.php';

if (isset($_POST['submit'])) {

	$username = mysqli_real_escape_string($connection, $_POST['uid']);
	$password = mysqli_real_escape_string($connection, $_POST['pwd']);

	if (empty($username) || empty($password)) {
		echo ("
			<script type='text/javascript'> 
				window.location.href='../shop.php?signin=empty'; 
			</script>
		");
	} else {

		$result = mysqli_query (
			$connection, 
			"SELECT * FROM users WHERE uid = '$username' OR eid='$username'"
		);

		if (mysqli_num_rows($result) < 1) {
			echo ("
				<script type='text/javascript'> 
					window.location.href='../shop.php?signin=error'; 
				</script>
			");
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				
				$hashP = password_verify($password, $row['pwd']);

				if ($hashP === false) {
					echo ("
						<script type='text/javascript'> 
							window.location.href='../shop.php?signin=error'; 
						</script>
					");
				} elseif ($hashP === true) {
					
					// Log the user in
					$_SESSION['u_id'] = $row['id'];
					$_SESSION['u_name'] = $row['uid'];
					$_SESSION['u_email'] = $row['eid'];
					$_SESSION['cart'] = array();
					
					echo ("
						<script type='text/javascript'> 
							window.location.href='../shop.php?signin=success'; 
						</script>
					");
				}
			}
		}
	} 
} else {
	echo ("
		<script type='text/javascript'> 
			window.location.href='../shop.php?signin=error'; 
		</script>
	");
}
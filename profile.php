<?php
session_start();

$root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/includes/dbh.inc.php');

$user_id = 0;
$user_email = "";
$user_name = "";

if (isset($_GET['user_id'])) {
	$user_id = $_GET['user_id'];

	$result_don = mysqli_query ($connection, "SELECT * FROM donators WHERE id = '$user_id'");
	$result_org = mysqli_query ($connection, "SELECT * FROM organisations WHERE id='$user_id'");

	$result = $result_don;

	if (mysqli_num_rows($result) < 1) {
		if (mysqli_num_rows($result_org) >= 1) {
			$result = $result_org;
		}
	} 

	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);

		$user_id = $row['id'];
		$user_name = $row['name'];
		$user_email = $row['email'];

	} else {
		die ("No user found");
	}
} else {
	die ("No user found");
}

?>

Profile: <?php echo $user_name; ?>
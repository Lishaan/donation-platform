<?php $root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/includes/dbh.inc.php');
require($root_dir . '/classes/User.php');
require($root_dir . '/components/explore_organisation.php');

$search = mysqli_real_escape_string($connection, $_GET['search']);

$sql = "SELECT * FROM users WHERE type='O' AND name LIKE '%$search%'";

$result = mysqli_query($connection, $sql);

$organisations_html = "";

while ($row = mysqli_fetch_assoc($result)) {
	$name = $row['name'];
	$user_id = $row['id'];
	$description = "description";
	$user_category = "poverty or something";
	$profile_picture_directory = "assets/img/profile_pictures/default_profile_picture.jpg";

	$organisations_html .= render_explore_organisation($user_id, $name, $description, $user_category, $profile_picture_directory);
}

echo $organisations_html;
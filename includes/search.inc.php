<?php $root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/includes/dbh.inc.php');
require($root_dir . '/classes/User.php');
require($root_dir . '/components/explore_organisation.php');

$search = mysqli_real_escape_string($connection, $_GET['search']);
$category = mysqli_real_escape_string($connection, $_GET['category']);

// $sql = "SELECT * FROM users WHERE type='O' AND name LIKE '%$search%'";
$sql = "SELECT users.name, users.id, organisations_info.profile_picture_directory, organisations_info.profile_description, organisations_info.category FROM users, organisations_info WHERE users.id = organisations_info.user_id AND name LIKE '%$search%' AND users.type = 'O'";

if (isset($_GET['category'])) {
	$sql .= " AND organisations_info.category='$category'";
}

$result = mysqli_query($connection, $sql);

$organisations_html = "";

while ($row = mysqli_fetch_assoc($result)) {
	$name = $row['name'];
	$user_id = $row['id'];
	$description = $row['profile_description'];
	$user_category = $row['category'];
	$profile_picture_directory = $row['profile_picture_directory'];

	$organisations_html .= render_explore_organisation($user_id, $name, $description, $user_category, $profile_picture_directory);

}

if (mysqli_num_rows($result) <= 0) {
	$organisations_html .= "
		<div class='row'>
			<div class='col s9 white z-depth-2' style='padding: 20px; margin: 0 10px -10px 10px;'>
				<span class='black-text'>
					<div>
						<text style='font-size: 12pt'>
							No Results
						</text>
					</div>
				</span>
			</div>
		</div>
	";
}

echo $organisations_html;
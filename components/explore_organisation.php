<link rel="stylesheet" href="../assets/css/feed.css">

<?php function render_explore_organisation($user_id, $name, $description, $user_category, $profile_picture_directory) {
	$container_style = "style='
		width: 32%;
		float: left;
		padding: 20px;
		margin: 0 10px 10px 0;
	'";

	$img_style = "style='
		padding: 0.2px;
		margin-top: 10px;
		border-radius: 50%;
		border: 2px solid #004d40;
		width: 100px;
		height: 100px;
	'";

	$a_options = "
		href='profile.php?user_id=$user_id'
		class='tooltipped'
		data-position='bottom'
		data-tooltip='Go to Profile'
	";

	return "
		<div class='center white z-depth-2' $container_style >
			<div class='z-depth-1 white' style='margin-bottom: 20px; padding: 15px; border-radius: 20px'>
				<p style='font-size: 10pt; margin: 0'><i>$user_category</i></p>
			</div>
			<a $a_options><img $img_style src='$profile_picture_directory' alt='' class='z-depth-1'></a>
			<h5 style='margin-bottom: 20px'>$name</h5>
			<div class='z-depth-1 white valign-wrapper' style='padding: 10px; margin: 0; border-radius: 20px; height: 128px'>
				<p style='font-size: 10pt;'><i>$description</i></p>
			</div>
		</div>
	";

}
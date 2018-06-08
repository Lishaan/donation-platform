<?php
$root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/includes/dbh.inc.php');
require($root_dir . '/classes/User.php');

if (isset($_GET['user_id'])) {

	$user = new User((int) $_GET['user_id']);
	$active_user = new User((int) $_SESSION['user_id']);

	if (User::exists($user)) {
		$following = User::isFollowing($user, $active_user);

		// If user clicks follow button
		if (isset($_POST['follow'])) {
			if (!$following) {
				$active_user->follow($user);
			}
		}

		// If user clicks unfollow button
		if (isset($_POST['unfollow'])) {
			if ($following) {
				$active_user->unfollow($user);
			}
		}

		// Submit post
		if (isset($_POST['submit_post'])) {
			$active_user->createPost($_POST['title'], $_POST['body']);
		}

		// Delete post
		if (isset($_POST['delete_post'])) {
			$active_user->deletePost((int) $_GET['delete_post_id']);
		}

		// Submit like
		if (isset($_POST['like'])) {
			$active_user->likePost((int) $_GET['post_id']);
		}

		// Submit Comment
		if (isset($_POST['comment'])) {
			$post_id = $_GET['post_id'];
			$commenter_user_id = $_SESSION['user_id'];
			$comment_body = $_POST['comment_body'];

			$sql = "SELECT * FROM posts WHERE id=$post_id";
			$result = mysqli_query($connection, $sql);

			if (mysqli_num_rows($result) > 0) {
				$sql = "INSERT INTO comments (post_id, commenter_user_id, comment_body, posted_at) VALUES ($post_id, $commenter_user_id, '$comment_body', now())";
				mysqli_query($connection, $sql);
			}
		}
	} else {
		echo ("
			<script type='text/javascript'> 
				window.location.href='../index.php';
			</script>
		");
	}
} else {
	echo ("
		<script type='text/javascript'> 
			window.location.href='../index.php';
		</script>
	");
}

function render_profile_info(User $user, $following) {
	$bio_desc = "Description";
	
	if ($user->getType() === 'D') {
		$bio_desc = "Bio";
	}

	$user_id = $user->getID();
	$user_name = $user->getName();

	echo ("
		<div class='col s3 white z-depth-2' style='margin-bottom: 20%'>
			<div id='profile-picture'>
				<img src='assets/img/default-profile-picture.jpg' id='banner-image' class='circle responsive-img'>	
			</div>
			<div style='padding: 20px; padding-top: 40px'>
				<h4>$user_name</h4>
				<p><b>$bio_desc: </b>Aenean eu ipsum vestibulum, congue ipsum sit amet, bibendum sem.</p>
				<!-- Follow Button -->
				<form action='../profile.php?user_id=$user_id' method='POST' accept-charset='utf-8'>
	");
	if ($following and $_SESSION['user_id'] !== $user_id) {
		echo ("
					<button class='btn waves-effect waves-light' style='margin-top: 40px;' type='submit' name='unfollow' value='Unfollow'>Unfollow<i class='material-icons right'>person_outline</i>
				  	</button>
		");
	} else if (!$following and $_SESSION['user_id'] !== $user_id) {
		echo ("
					<button class='btn waves-effect waves-light' style='margin-top: 40px;' type='submit' name='follow' value='Follow'>Follow<i class='material-icons right'>person_add</i>
					</button>
		");
	}
	echo ("
				</form>
			</div>
		</div>
	");
}
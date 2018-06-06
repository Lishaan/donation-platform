<?php
if (isset($_GET['user_id'])) {
	$sql = "SELECT * FROM users WHERE id = '" . $_GET['user_id'] . "'";
	$result = mysqli_query($connection, $sql);

	$row = mysqli_fetch_assoc($result);
	$user_id = $row['id'];
	$user_name = $row['name'];
	$user_type = $row['type'];

	if (mysqli_num_rows($result) > 0) {
		$follower_user_id = $_SESSION['user_id'];
		$sql = "SELECT follower_user_id FROM followers WHERE follower_user_id=$follower_user_id AND user_id=$user_id";
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) > 0) {
			$following = true;
		}

		// If user clicks follow button
		if (isset($_POST['follow'])) {
			if (!$following) {
				$follower_user_id = $_SESSION['user_id'];

				$sql = "INSERT INTO followers (user_id, follower_user_id, follow_date) VALUES ($user_id, $follower_user_id, now())";
				mysqli_query($connection, $sql);

				echo ("
					<script type='text/javascript'> 
					window.location.href='../profile.php?user_id=$user_id';
					</script>
				");
			}
		}

		// If user clicks unfollow button
		if (isset($_POST['unfollow'])) {
			if ($following) {
				$follower_user_id = $_SESSION['user_id'];

				$sql = "DELETE FROM followers WHERE user_id=$user_id AND follower_user_id=$follower_user_id";
				mysqli_query($connection, $sql);

				echo ("
					<script type='text/javascript'> 
						window.location.href='../profile.php?user_id=$user_id';
					</script>
				");
			}
		}

		// Submit post
		if (isset($_POST['submit_post'])) {
			$poster_user_id = mysqli_real_escape_string($connection, $_SESSION['user_id']);
			$title = mysqli_real_escape_string($connection, $_POST['title']);
			$body = mysqli_real_escape_string($connection, $_POST['body']);

			$sql = "INSERT INTO posts (poster_user_id, posted_at, likes, title, body) VALUES ($poster_user_id, now(), 0, '$title', '$body')";
			mysqli_query($connection, $sql);

			echo ("
				<script type='text/javascript'> 
					window.location.href='../profile.php?user_id=$user_id&create_post=success';
				</script>
			");
		}

		// Submit like
		if (isset($_POST['like'])) {
			$post_id = $_GET['post_id'];
			$liker_user_id = $_SESSION['user_id'];

			$sql = "SELECT * FROM posts_likes WHERE post_id=$post_id AND user_id=$liker_user_id";
			$result = mysqli_query($connection, $sql);

			if (mysqli_num_rows($result) <= 0) {
				$sql = "UPDATE posts SET likes=likes+1 WHERE id=" . $_GET['post_id'];
				mysqli_query($connection, $sql);

				$sql = "INSERT INTO posts_likes (post_id, user_id) VALUES ($post_id, $liker_user_id)";
				mysqli_query($connection, $sql);
			} else {
				$sql = "UPDATE posts SET likes=likes-1 WHERE id=" . $_GET['post_id'];
				mysqli_query($connection, $sql);

				$sql = "DELETE FROM posts_likes WHERE post_id=$post_id AND user_id=$liker_user_id";
				mysqli_query($connection, $sql);
			}
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

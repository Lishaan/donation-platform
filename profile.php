<?php
session_start();

$root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/includes/dbh.inc.php');

$user_id = "";
$user_name = "";
$user_type = "";
$following = false;
require($root_dir . '/includes/profile_loader.inc.php');

require($root_dir . '/fragments/head.php');
require($root_dir . '/fragments/navbar.php');

render_head("Home");
render_navbar("Home");

if ($_GET['create_post'] === "success") {
	?>
	<script type="text/javascript">
		M.toast({html: 'Your post has been created'})
	</script>
	<?php
}

if ($_GET['login'] === "success") {
	?>
	<script type="text/javascript">
		M.toast({html: 'You have been logged in'})
	</script>
	<?php
}
?>
<link rel="stylesheet" href="assets/css/profile.css">
<main>
	<?php if ($_SESSION['user_id'] === $user_id): ?>
		<div style="background-color: #00695c;">
			<p class="center white-text" style="margin: 0; padding: 10px 0 10px 0;">Viewing your profile</p>
		</div>
	<?php endif; ?>


	<div class="z-depth-2" id="banner">
		<img src="assets/img/default-profile-banner.jpg" alt="banner-img" id="banner-image">
	</div>
	<div id="profile-picture">
		<img src="assets/img/default-profile-picture.jpg" alt="" id="banner-image" class="circle responsive-img">	
	</div>

	<div class="row" style="margin-bottom: 10px">
		<div class="col s12">
			<ul class="tabs z-depth-1">
				<li class="col s4" style="margin-right: 10px"></li>
				<li class="tab col s2"><a class="active" href="#timeline">Timeline</a></li>
				<li class="tab col s2"><a href="#followers">Followers</a></li>
				<li class="tab col s2"><a href="#statistics">Statistics</a></li>
			</ul>
		</div>
	</div>
		<!-- Timeline -->
	<div class="row">
		<div id="timeline" class="col s12">
			<?php require($root_dir . '/components/profile_info.php'); ?>
			<div class="col s8">
				<!-- Post Form -->
				<?php if ($_SESSION['user_id'] === $user_id): ?>
					<div class='row'>
						<div class="hoverable container white" style="margin-left: 10px">
							<ul class="collapsible" style="margin: 0;">
								<li>
									<div class="collapsible-header"><i class="material-icons">forum</i><b>Create a Post</b></div>
									<div class="collapsible-body">
      									<div style="padding: 0 20px 0 20px">
											<form action="profile.php?user_id=<?php echo $user_id; ?>" method="POST">
												<div class="input-field" style="margin-bottom: 50px">
										          <input placeholder="(Optional)" autocomplete="false" name="title" id="post_title" type="text" class="validate" data-length="32">
										          <label for="post_title">Title</label>
										        </div>
												<div class="input-field">
										          <textarea placeholder="Body" autocomplete="false" name="body" id="post_textarea" class="materialize-textarea" data-length="512"></textarea>
										          <label for="post_textarea">Body</label>
										        </div>

										        <button disabled style="margin-top: 20px" class="btn waves-effect waves-light btn-large" type="submit" name="submit_post" id="post_submit">Submit
												    <i class="material-icons right">send</i>
												</button>
											</form>
										</div>
									</div>
								</li>
							</ul>
						</div>					
					</div>
				<?php endif;
				$sql = "SELECT * FROM posts WHERE poster_user_id=$user_id ORDER BY posted_at DESC;";
				$result = mysqli_query($connection, $sql);

				$posts = array();

				while ($row = mysqli_fetch_assoc($result)) {
					array_push($posts, $row);
				}

				foreach ($posts as $post) {
					echo("
						<div class='row'>
							<div class='container white z-depth-2' style='padding: 30px; margin: 0 0 30px 10px'>
					");

					$post_id = $post['id'];
					$title = $post['title'];
					$body = htmlspecialchars($post['body']);
					$likes = $post['likes'];
					$date = date("jS F, Y", strtotime($post['posted_at']));
					$time = date("g:ia", strtotime($post['posted_at']));

					$liker_user_id = $_SESSION['user_id'];

					$sql = "SELECT * FROM posts_likes WHERE post_id=$post_id AND user_id=$liker_user_id";
					$result = mysqli_query($connection, $sql);

					$like_button = "
						<div style='margin-bottom: 20px;'> 
							<form action='profile.php?user_id=$user_id&post_id=$post_id' method='POST'>
						        <button style='margin-top: 20px' class='z-depth-2 btn waves-effect' type='submit' name='like'>$likes
									<i style='border-radius: 10px;' class='material-icons right'>thumb_up</i>
								</button>
							</form>
						</div>
					";

					$unlike_button = "
						<div style='margin-bottom: 20px;'> 
							<form action='profile.php?user_id=$user_id&post_id=$post_id' method='POST'>
						        <button style='margin-top: 20px; background-color: #e37375;' class='z-depth-2 btn waves-effect' type='submit' name='like'>$likes
									<i style='border-radius: 10px;' class='material-icons right'>thumb_down</i>
								</button>
							</form>
						</div>
					";

					if (mysqli_num_rows($result) > 0) {
						$like_button = $unlike_button;
					}

					$poster_user_id = $post['poster_user_id'];
					$sql = "SELECT * FROM users WHERE id=$poster_user_id";
					$result = mysqli_query($connection, $sql);
					$row = mysqli_fetch_assoc($result);

					$poster_user_name = $row['name'];

					if ($_SESSION['user_id'] === $user_id) {
						$like_button = "
							<div style='margin-bottom: 20px;'> 
								<form action='profile.php?user_id=$user_id&post_id=$post_id' method='POST'>
							        <button style='margin-top: 20px' class='z-depth-2 btn waves-effect' type='submit' name='like' disabled>$likes
										<i style='border-radius: 10px;' class='material-icons right'>thumb_up</i>
									</button>
								</form>
							</div>
						";
					}

					// Render post
					echo ("
						<span class='black-text'>
							<a style='color: inherit;' href='profile.php?user_id=$poster_user_id'><h5><b>$poster_user_name</b></h5></a>
							<b>Posted at: </b><text style='color: #90949c'>$date at $time</text>
							$like_button
							<div class='z-depth-1' style='margin: 20px 0 20px 0; padding: 10px 20px 10px 20px'>
								<p style='font-size: 14pt; line-height: 5px;'><b>$title</b></p>
								<p>$body</p>
							</div>
						</span>
					");

					$sql = "SELECT * FROM comments WHERE post_id=$post_id ORDER BY posted_at ASC;";
					$result = mysqli_query($connection, $sql);

					$comments = array();

					$comments_count = 0;

					while ($row = mysqli_fetch_assoc($result)) {
						array_push($comments, $row);
						$comments_count += 1;
					}


					echo (" 
						<ul class='collapsible'>
							<li>
							<div class='collapsible-header'><i class='material-icons'>comment</i>Comment section ($comments_count comments)</div>
							<div class='collapsible-body'>
					");

					foreach ($comments as $comment) {
						$commenter_user_id = $comment['commenter_user_id'];
						$comment_body = $comment['comment_body'];
						$date = date("jS F, Y", strtotime($comment['posted_at']));
						$time = date("g:ia", strtotime($comment['posted_at']));

						$sql = "SELECT name FROM users WHERE id=$commenter_user_id";
						$result = mysqli_query($connection, $sql);
						$row = mysqli_fetch_assoc($result);

						$commenter_user_name = $row['name'];

						$comment_style = "style='padding: 20px; margin: 20px 20px 0px 20px;border-radius: 20px;'";

						// Render comment
						echo ("
							<div class='row'>
								<div class='white z-depth-1' $comment_style>
									<div class='black-text' style='word-wrap: break-word;'>
										<span>
											<a class='tooltipped' data-position='top' data-tooltip='Go to Profile' style='color: inherit;' href='profile.php?user_id=$commenter_user_id'>
												<b>$commenter_user_name: </b>
											</a>
										</span>
										<span>
											<p>$comment_body</p>
										</span>
									</div>
									<div>
										<text style='font-size: 9pt'>
											<b>Posted at: </b>
											<text style='color: #90949c'>$date at $time</text>
										</text>
									</div>
								</div>
							</div>
						");
					}

					if (empty($comments)) {
						echo ("
							<div class='row'>
								<div class='white z-depth-1' style='padding: 20px; margin: 20px 20px 0px 20px;border-radius: 20px;'>
									<div class='center black-text' style='word-wrap: break-word;'>
										<span>
											<p>No comments.</p>
										</span>
									</div>
								</div>
							</div>
						");
					}

					$comment_button = "
						<div class='z-depth-1' style='margin-top: 40px;padding-bottom: 20px;'>
							<div style='padding: 40px'>
								<form action='profile.php?user_id=$user_id&post_id=$post_id' method='POST'>
									<div class='input-field'>
							          <textarea autocomplete='false' name='comment_body' id='comment_textarea' class='materialize-textarea' data-length='256'></textarea>
							          <label for='comment_textarea'>Your comment</label>
							        </div>

							        <button class='right btn waves-effect btn' type='submit' name='comment' id='comment_submit'>
									    <i class='material-icons left'>add_comment</i>Comment
									</button>
								</form>
							</div>
						</div>
					";

					echo("</div></li></ul>$comment_button</div></div>");
				}

				if (empty($posts)) {
					echo ("
						<div class='row'>
							<div class='white container z-depth-2' style='padding: 20px; margin: 0 0 -10px 10px;'>
								<span class='black-text'>
									<h5>No Posts.</h5>
								</span>
							</div>
						</div>
					");
				}
				?>
			</div>
		</div>
		<!-- Following -->
		<div id="followers" class="col s12">
			<?php require($root_dir . '/components/profile_info.php'); ?>

			<!-- Following -->
			<div class="col s8">

				<?php
				$nofollowers = true;
				$sql = "SELECT * FROM followers WHERE user_id=$user_id ORDER BY id DESC";
				$result = mysqli_query($connection, $sql);

				$followers = array();

				while ($row = mysqli_fetch_assoc($result)) {
					array_push($followers, array($row['follower_user_id'], $row['follow_date']));
				}

				foreach ($followers as $index => $follower) {
					$follower_id = $follower[0];

					$sql = "SELECT name FROM users WHERE id=$follower_id";
					$row = mysqli_fetch_assoc(mysqli_query($connection, $sql));

					$follow_date = date("jS F, Y", strtotime($follower[1]));
					$follow_time = date("g:ia", strtotime($follower[1]));
					$follower_name = $row['name'];

					$nofollowers = false;
					
					echo ("
						<div class='row'>
							<div class='white container z-depth-2' style='padding: 4px 20px 20px 20px; margin: 0 0 -10px 10px;'>
								<span class='black-text'>
									<h5 style='padding: 0'>
										<a href='profile.php?user_id=$follower_id'>$follower_name</a>
										started following $user_name
									</h5>

									<b>Date: </b><text style='color: #90949c'>$follow_date $follow_time</text>
								</span>
							</div>
						</div>
					");
				}

				if ($nofollowers) {
					echo ("
						<div class='row'>
							<div class='white container z-depth-2' style='padding: 20px; margin: 0 0 -10px 10px;'>
								<span class='black-text'>
									<h5>No followers.</h5>
								</span>
							</div>
						</div>
					");
				}
				?>
			</div>
		</div>
		<div id="statistics" class="col s12">
			<?php require($root_dir . '/components/profile_info.php'); ?>
		</div>
	</div>
</main>

<script type="text/javascript">
	$(document).ready(function() {
		$('.tooltipped').tooltip();
		$('.tabs').tabs();
		$('input#post_title, textarea#post_textarea').characterCounter();
		$('.collapsible').collapsible();

		$('#post_textarea').on("keyup", postCheck);

		function postCheck() {
		   if($('#post_textarea').val().length > 0) {
		      $('#post_submit').prop("disabled", false);
		   }else {
		      $('#post_submit').prop("disabled", true);
		   }
		}
	});
</script>
<?php
require($root_dir . '/fragments/footer.php');
<?php $root_dir = $_SERVER["DOCUMENT_ROOT"];
session_start();

$user;
$active_user;

require($root_dir . '/includes/dbh.inc.php');
require($root_dir . '/includes/profile_loader.inc.php');

$following = User::isFollowing($user, $active_user);

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
	<?php if ($_SESSION['user_id'] === $user->getID()): ?>
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
			<?php render_profile_info($user, $following) ?>
			<div class="col s8">
				<!-- Post Form -->
				<?php if ($_SESSION['user_id'] === $user->getID()): ?>
					<div class='row'>
						<div class="hoverable container white" style="margin-left: 10px">
							<ul class="collapsible" style="margin: 0;">
								<li>
									<div class="collapsible-header"><i class="material-icons">forum</i><b>Create a Post</b></div>
									<div class="collapsible-body">
      									<div style="padding: 0 20px 0 20px">
											<form action="profile.php?user_id=<?php echo $user->getID() ?>" method="POST">
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

				$posts = $user->getPosts();

				foreach ($posts as $post) {
					$post->render($user, $active_user);
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
			<?php render_profile_info($user, $following) ?>

			<!-- Following -->
			<div class="col s8">
				<?php
				$nofollowers = true;

				$followers = $user->getFollowersArray();

				foreach ($followers as $index => $follower) {
					$nofollowers = false;
					$follower_id = $follower[0];

					$sql = "SELECT name FROM users WHERE id=$follower_id";
					$row = mysqli_fetch_assoc(mysqli_query($connection, $sql));

					$follow_date = date("jS F, Y", strtotime($follower[1]));
					$follow_time = date("g:ia", strtotime($follower[1]));
					$follower_name = $row['name'];

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
			<?php render_profile_info($user, $following) ?>
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
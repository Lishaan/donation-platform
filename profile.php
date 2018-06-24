<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>									      <script type="text/javascript" src="chartjs/myNewChart.js"></script>
<script type="text/javascript" src="chartjs/js/app.js"></script>

<?php $root_dir = $_SERVER["DOCUMENT_ROOT"];
session_start();
require($root_dir . '/includes/dbh.inc.php');

$user;
$active_user;
require($root_dir . '/includes/profile_loader.inc.php'); // Initializes $user and #active_user
require($root_dir . '/fragments/edit_profile.php');

$following = User::isFollowing($user, $active_user);
$edit_profile = $_GET['edit-profile'] === "true";

require($root_dir . '/fragments/head.php');
require($root_dir . '/fragments/navbar.php');

render_head("Profile - " . $user->getName());
render_navbar("Profile - " . $user->getName());
?>
<link rel="stylesheet" href="assets/css/profile.css">

<?php if ($edit_profile and $_SESSION['user_id'] === $user->getID()): ?>
<main>
	<?php render_edit_profile($active_user); ?>
</main>
<?php else: ?>
<main>
	<?php if ($_SESSION['user_id'] === $user->getID()): ?>
		<div style="background-color: #00695c;">
			<p class="center white-text" style="margin: 0; padding: 10px 0 10px 0;">Viewing your profile</p>
		</div>
	<?php endif; ?>

	<div class="z-depth-2" id="banner">
		<img src="assets/img/default-profile-banner.jpg" alt="banner-img" id="banner-image">
	</div>

	<div class="row" style="margin-bottom: 10px">
		<div class="col s12">
			<ul class="tabs z-depth-1">
				<li class="col s3"></li>
				<li class="tab col s2"><a class="active" href="#timeline">Timeline</a></li>
				<li class="tab col s2"><a href="#followers">Followers (<?php echo count($user->getFollowersArray()) ?>)</a></li>
				<li class="tab col s2"><a href="#statistics">Statistics</a></li>
			</ul>
		</div>
	</div>

	<!-- Timeline -->
	<div class="row">
		<div id="timeline" class="col s12">
			<?php render_profile_info($user, $following) ?>
			<div class="col s6">
				<!-- Post Form -->
				<?php if ($_SESSION['user_id'] === $user->getID() and $user->isDonator()): ?>
					<div class='row' style="margin-bottom: 10px;">
						<div class="hoverable white" style="margin: 0 10px 0 10px">
							<ul class="collapsible" style="margin: 0;">
								<li>
									<div class="waves-effect waves-blue collapsible-header"><i class="material-icons">forum</i><b>Create a Post</b></div>
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
				<!-- Post/Event Form -->
				<?php elseif ($_SESSION['user_id'] === $user->getID()): ?>
					<div class='row' style="margin-bottom: 10px;">
						<div class="hoverable white" style="margin: 0 10px 0 10px">
							<ul class="collapsible" style="margin: 0px;">
								<li>
									<div class="collapsible-header"><i class="material-icons">forum</i><b>Create a Post/Event</b></div>
									<div class="collapsible-body" style="padding: 40px;">
      									<div class="z-depth-1" style="padding: 40px">
	      									<div class="row" style="margin: 0 0 40px 0">	
	      										<ul class="tabs tabs-fixed-width" id="tab_fg">
													<li id="tab_post" class="tab col s6"><a class="active" href="#Post">Post</a></li>
													<li class="tab col s6"><a href="#Event">Event</a></li>
												</ul>										
											</div>
										
											<div id="Post" >
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

											<div id="Event" >
												<div style="padding: 0 20px 0 20px">
													<form action="profile.php?user_id=<?php echo $user->getID() ?>" method="POST" enctype="multipart/form-data">
														<div class="input-field" style="margin-bottom: 50px">
												          <input autocomplete="false" placeholder="(Optional)" name="title" id="event_title" type="text" class="validate" data-length="32">
												          <label for="event_title">Title</label>
												        </div>

														<div class="input-field" style="margin-bottom: 50px">
												          <textarea placeholder="Required" autocomplete="false" name="body" id="event_textarea" class="materialize-textarea" data-length="512"></textarea>
												          <label for="event_textarea">Description</label>
												        </div>

												        <div class="input-field">
													        <input placeholder = "Required" autocomplete="false"  name="fundsNeeded" onkeypress="return isNumberKey(event)" id="event_funds_Needed" type="number" data-length="11">
		            										<label for="input_text">Funds Needed</label>
												        </div>

														<div class="file-field input-field" style="margin: 40px 0 40px 0">
															<div class="btn">
																<span>Upload an image</span>
																<input id="event_image" name="event_image" type="file">
															</div>
															<div class="file-path-wrapper">
																<input class="file-path validate" type="text" placeholder="JPG and PNG only (Required)">
															</div>
														</div>
														
												        <button disabled style="margin-top: 20px" class="btn waves-effect waves-light btn-large" type="submit" name="submit_event" id="event_submit">Submit
														    <i class="material-icons right">send</i>
														</button>
													</form>
												</div>
											</div>     									
      									</div>
									</div>
								</li>
							</ul>
						</div>					
					</div>
				<?php endif;

				if ($user->isDonator()) {
					$posts = $user->getPosts();

					foreach ($posts as $post) {
						$post->render($user, $active_user);
					}

					if (empty($posts)) {
						echo ("
							<div class='row'>
								<div class='white z-depth-2' style='padding: 20px; margin: 0 10px -10px 10px;'>
									<span class='black-text'>
										<div>
											<text style='font-size: 12pt'>
												No Posts
											</text>
										</div>
									</span>
								</div>
							</div>
						");
					}
				} else {
					$posts_and_events = $user->getEventsAndPosts();

					foreach ($posts_and_events as $post_event) {
						$post_event->render($user, $active_user);
					}

					if (empty($posts_and_events)) {
						echo ("
							<div class='row'>
								<div class='white z-depth-2' style='padding: 20px 20px 20px 20px; margin: 0 10px -10px 10px;'>
									<span class='black-text'>
										<div>
											<text style='font-size: 12pt'>
												No Posts or Events
											</text>
										</div>
									</span>
								</div>
							</div>
						");
					}
				}
				?>
			</div>
		</div>
		<!-- Following -->
		<div id="followers" class="col s12">
			<?php render_profile_info($user, $following) ?>

			<!-- Following -->
			<div class="col s6">
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
					$user_name = $user->getName();

					if ($user->getID() === $_SESSION['user_id']) {
						$user_name = "you";
					}

					$followers_style = "style='padding: 20px 20px 20px 20px; margin: 0 10px -10px 10px;'";
					echo ("
						<div class='row'>
							<div class='white z-depth-2' $followers_style>
								<span class='black-text'>
									<div>
										<text style='font-size: 12pt'>
											<a href='profile.php?user_id=$follower_id'>$follower_name</a>
											started following $user_name.
										</text>
									</div>
									<div  style='font-size: 9pt'>
										<b>Date: </b><text style='color: #90949c'>$follow_date $follow_time</text>
									</div>
								</span>
							</div>
						</div>
					");
				}

				if ($nofollowers) {
					echo ("
						<div class='row'>
							<div class='white z-depth-2' style='padding: 20px 20px 20px 20px; margin: 0 10px -10px 10px;'>
								<span class='black-text'>
									<div>
										<text style='font-size: 12pt'>
											No Followers
										</text>
									</div>
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
			<div class="col s6">
			
				<ul class="collection">
					<li class="collection-item" style="height: 400px">									
						<canvas id ="mycanvas" height="150" width="400"></canvas>									
					</li>
				</ul>
			</div> 
		</div>
	</div>
</main>
<?php endif; ?>

<script type="text/javascript">
	$(document).ready(() => {
		$('.sidenav').sidenav();
		$('.tooltipped').tooltip();
		$('.tabs').tabs();
		$('.modal').modal();
		$('input#post_title, textarea#post_textarea').characterCounter();
		$('.collapsible').collapsible();

		$('#post_textarea').on("keyup", postCheck);
		$('#event_textarea').on("keyup", eventCheck);
		$('#event_funds_Needed').on("keyup", eventCheck);
		$('#event_image').on("change", eventCheck);

		$('.tabs').tabs('updateTabIndicator');

		function postCheck() {
			if ($('#post_textarea').val().length > 0) {
				$('#post_submit').prop("disabled", false);
			} else {
				$('#post_submit').prop("disabled", true);
			}
		};

		function eventCheck() {
			if ($('#event_textarea').val().length > 0 && $('#event_funds_Needed').val() > 0 && $('#event_image').val()) {
				$('#event_submit').prop("disabled", false);
			} else {
				$('#event_submit').prop("disabled", true);
			}
		};

		function isNumberKey(evt) {
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			} else {
				return true;
			}
		}
	});
</script>

<?php require($root_dir . '/fragments/footer.php');
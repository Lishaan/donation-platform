<?php
session_start();

$root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/includes/dbh.inc.php');

require($root_dir . '/classes/User.php');
require($root_dir . '/fragments/head.php');
require($root_dir . '/fragments/navbar.php');

$active_user = new User((int) $_SESSION['user_id']);

render_head("Feed - " . $active_user->getName());
render_navbar("Feed - " . $active_user->getName());
?>

<link rel="stylesheet" href="assets/css/feed.css">
<main>
	<div class="row" style="margin-bottom: 10px">
		<div class="col s12">
			<ul class="tabs z-depth-1">
				<li class="col s3"></li>
				<li class="tab col s3"><a class="active" href="#following">Following</a></li>
				<li class="tab col s3"><a href="#global">Global</a></li>
				<li class="col s3"></li>
			</ul>
		</div>
	</div>

	<!-- Following & Global Content -->
	<div class="row">
		<div id="following" class="col s12">
			<!-- Left -->
			<div class='col s3 white z-depth-2' style='margin-bottom: 20%; padding: 20px'>
				<h5><b>Useful Links</b></h5>

				<ul>
					<li>• wwf.com.org</li>
					<li>• aspca.com.org</li>
					<li>• UNICEF.com.org</li>
				</ul>
			</div>

			<!-- Center -->
			<div class="col s6">
				<?php 
				$posts_and_events = $active_user->getEventsAndPostsFollowing();

				foreach ($posts_and_events as $post_event) {
					$post_event->render($active_user, $active_user, "&goback=feed");
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
				?>
			</div>
		</div>
		<div id="global" class="col s12">
			<!-- Left -->
			<div class='col s3 white z-depth-2' style='margin-bottom: 20%; padding: 20px'>
				<h5><b>Useful Links</b></h5>

				<ul>
					<li>• wwf.com.org</li>
					<li>• aspca.com.org</li>
					<li>• UNICEF.com.org</li>
				</ul>
			</div>

			<!-- Center -->
			<div class="col s6">
				<?php 
				$posts_and_events = $active_user->getEventsAndPosts();

				foreach ($posts_and_events as $post_event) {
					$post_event->render($active_user, $active_user, "&goback=feed");
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
				?>
			</div>
		</div>
	</div>
</main>
        
<script type="text/javascript">
 	$(document).ready(function(){
    $('.tabs').tabs();
    $('.collapsible').collapsible();
    $('.modal').modal();
    $('.tooltipped').tooltip();
  });
</script> 

<?php 
require($root_dir . '/fragments/footer.php');
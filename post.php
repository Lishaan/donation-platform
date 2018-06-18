<?php $root_dir = $_SERVER["DOCUMENT_ROOT"];
session_start();
require($root_dir . '/includes/dbh.inc.php');

require($root_dir . '/classes/User.php');

$active_user;
$post;
$user;

if (isset($_GET['post_id'])) {
	$active_user = new User((int) $_SESSION['user_id']);
	$post = new Post((int) $_GET['post_id']);
	$user = $post->getPosterUser();

	if (Post::exists($post) and User::exists($active_user)) {



		// echo ("D");


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

require($root_dir . '/fragments/head.php');
require($root_dir . '/fragments/navbar.php');

render_head("Post - " . $user->getName());
render_navbar("Post - " . $user->getName());
?>

<link rel="stylesheet" href="assets/css/profile.css">

<main>
	<!-- Content -->
	<div class="row" style="margin-top: 10px;">
		<div class="col s12">
			<!-- Left -->
			<div class='col s3 white z-depth-2' style='margin-bottom: 20%; padding: 20px'>
			</div>

			<!-- Center -->
			<div class="col s6">
				<?php $post->render($user, $active_user, "&goback=post&post_id=" . $post->getID()) ?>
			</div>
		</div>
	</div>
</main>
<script type="text/javascript">
	$(document).ready(() => {
		$('.collapsible').collapsible();
		$('.modal').modal();
		$('.tooltipped').tooltip();
	});
</script>
<?php
require($root_dir . '/fragments/footer.php');
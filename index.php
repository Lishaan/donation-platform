<?php
session_start();
$root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/includes/dbh.inc.php');

require($root_dir . '/fragments/head.php');
require($root_dir . '/fragments/navbar.php');
require($root_dir . '/fragments/terms_of_service.php');

render_head("Home");
render_navbar("Home");
?>

<main>
	<center>
		<?php 
		if (($_GET['form']) === "login" and !isset($_SESSION['u_id'])) {
			require($root_dir . '/components/login_form.php'); 
		} else if ($_GET['form'] === "signup" and !isset($_SESSION['u_id'])) {
			require($root_dir . '/components/signup_form.php');
		} else if ($_GET['page'] === "terms-of-service") {
			render_terms_of_service();
		} else {
			require($root_dir . '/fragments/home.php');
		}

		if ($_GET['signout'] === "success") {
			?>
			<script type="text/javascript">
				M.toast({html: 'You have been signed out'})
			</script>
			<?php
		}
		?> 
	</center>
</main>
<script type="text/javascript">
	$(document).ready(() => {
		$('.tabs').tabs();
		$('select').formSelect();
	});
</script>
<?php
require($root_dir . '/fragments/footer.php');
<?php
session_start();

$root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/includes/dbh.inc.php');

require($root_dir . '/classes/User.php');
require($root_dir . '/fragments/head.php');
require($root_dir . '/fragments/navbar.php');
require($root_dir . '/components/explore_organisation.php');

if (isset($_SESSION['user_id'])) {
	$active_user = new User((int) $_SESSION['user_id']);
	render_head("Explore - " . $active_user->getName());
	render_navbar("Explore - " . $active_user->getName());
} else {
	render_head("Explore");
	render_navbar("Explore");
}

?>

<link rel="stylesheet" href="assets/css/feed.css">
<main>
	<div class="row" style="margin-bottom: 10px">
		<div class="col s12">
			<div class="white z-depth-1 center" style="padding: 10px">
				<h5 style="padding: 10px; margin: 0;">Explore Organisations</h5>
			</div>
		</div>
	</div>

	<!-- Content -->
	<div class="row">
		<div class="col s12">
			<!-- Left -->
			<div class='col s3 white z-depth-2' style='padding: 20px; margin: 0 0 20% 0'>
				<nav>
					<div class="nav-wrapper">
						<form action="explore.php" method="POST">
							<div class="input-field">
								<input autocomplete="off" class="white" placeholder="Search for organisations" id="search_input" type="search" required>
								<label class="label-icon" for="search"><i class="material-icons">search</i></label>
								<i class="material-icons">close</i>
								<button id="search_button" class="hide" type="submit" name="submit-search"></button>
							</div>
						</form>
					</div>
				</nav>
				<h5 style="margin: 50px 0 30px 0">Sort By Category</h5>
				<ul>
					<?php
					$categories = Database::getCategories();

					foreach ($categories as $category) {
						echo "
							<li style='margin: 0 0 10px 0;'>
								<label>
									<input type='checkbox' class='filled-in' />
									<span>$category</span>
								</label>
							</li>
						";
					}
					?>
				</ul>
			</div>

			<!-- Center -->
			<div id="organisations_col" class="col s9" style="margin: 0">
					<?php 
					$organisations = User::getOrganisations();

					foreach ($organisations as $o) {

						echo render_explore_organisation (
							$o->getID(), 
							$o->getName(), 
							$o->getBioDesc(), 
							$o->getCategory(), 
							$o->getProfilePictureDirectory()
						);
					}
					?>
			</div>
		</div>
	</div>
</main>
        
<script type="text/javascript">
 	$(document).ready(() => {
	    $('.tabs').tabs();
	    $('.collapsible').collapsible();
	    $('.modal').modal();
	    $('.tooltipped').tooltip();

	    $org_col = $('#organisations_col').html();
	    
	    $('#search_input').on("input", () => {
	    	$search = $('#search_input').val();

	    	if ($search.length > 0) {
	    		$.get('includes/search.inc.php', {'search': $search}, ($data) => {
	    			$('#organisations_col').html($data);
	    		});
	    	} else {
	    		$('#organisations_col').html($org_col);
	    	}
	    });
	});
</script> 

<?php 
require($root_dir . '/fragments/footer.php');
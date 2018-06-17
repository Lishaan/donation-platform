<?php
session_start();

$root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/includes/dbh.inc.php');

require($root_dir . '/classes/User.php');
require($root_dir . '/fragments/head.php');
require($root_dir . '/fragments/navbar.php');

$active_user = new User((int) $_SESSION['user_id']);

render_head("Explore - " . $active_user->getName());
render_navbar("Explore - " . $active_user->getName());
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
						<form>
							<div class="input-field">
								<input class="white" placeholder="Search for organisations" id="search" type="search" required>
								<label class="label-icon" for="search"><i class="material-icons">search</i></label>
								<i class="material-icons">close</i>
							</div>
						</form>
					</div>
				</nav>
				<h5 style="margin: 50px 0 30px 0">Sort By Category</h5>
				<ul>
					<?php
					$categories = array("Clubs and communities", "Environment", "Hunger", "Poverty", "Animals");

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
			<div class="col s9" style="margin: 0">
					<?php

					$container_style = "style='
						padding: 20px; 
						margin: 0 10px 10px 0;
						width: 32%;
						float: left;
					'";

					$organisations = User::getOrganisations();

					foreach ($organisations as $organisation) {
						$name = $organisation->getName();
						$user_id = $organisation->getID();
						$description = $organisation->getBioDesc();
						$user_category = $organisation->getCategory();
						$profile_picture_dirctory = $organisation->getProfilePictureDirectory();

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

						echo "
							<div class='center white z-depth-2' $container_style >
								<div class='z-depth-1 white' style='margin-bottom: 10px; padding: 15px; border-radius: 20px'>
									<p style='font-size: 10pt; margin: 0'><i>$user_category</i></p>
								</div>
								<a $a_options><img $img_style src='$profile_picture_dirctory' alt='' class='z-depth-1'></a>
								<h5>$name</h5>
								<div class='z-depth-1 white valign-wrapper' style='padding: 10px; margin: 0; border-radius: 20px; height: 128px'>
									<p style='font-size: 10pt;'><i>$description</i></p>
								</div>
							</div>
						";
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
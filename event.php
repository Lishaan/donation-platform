<?php $root_dir = $_SERVER["DOCUMENT_ROOT"];
session_start();
require($root_dir . '/includes/dbh.inc.php');

require($root_dir . '/classes/User.php');

$active_user;
$event;
$user;

if ($_GET['donate_event'] === "success") {
	?>
	<script type="text/javascript">
		M.toast({html: 'Your donation has been made successfully'})
	</script>
	<?php
}

if ($_GET['donate_event'] === "failed") {
	?>
	<script type="text/javascript">
		M.toast({html: 'There was an error donating to the event'})
	</script>
	<?php
}

if (isset($_GET['event_id'])) {
	$active_user = new User((int) $_SESSION['user_id']);
	$event = new Event((int) $_GET['event_id']);
	$user = $event->getPosterUser();

	if (Event::exists($event) and User::exists($active_user)) {

	} else {
		echo ("
			<script type='text/javascript'> 
				window.location.href='../index.php?view_event=failed';
			</script>
		");
	}
} else {
	echo ("
		<script type='text/javascript'> 
			window.location.href='../index.php?view_event=failed';
		</script>
	");
}

if (isset($_GET['donation_amount']) and isset($_POST['donation_submit'])) {
	$active_user->donateEvent((int) $_GET['event_id'], (double) $_GET['donation_amount'], (int) $active_user->getID());
}

require($root_dir . '/fragments/head.php');
require($root_dir . '/fragments/navbar.php');

render_head("Event - " . $user->getName());
render_navbar("Event - " . $user->getName());
?>

<link rel="stylesheet" href="assets/css/profile.css">

<main>
	<!-- Content -->
	<div class="row" style="margin-top: 10px;">
		<div class="col s12">
			<!-- Left -->
			<div class='col s3 white z-depth-2' style='margin-bottom: 20%; padding: 20px'>

				<!-- Modal Trigger -->
				<a class="waves-effect waves-light btn modal-trigger" href="#donations_modal">View Donations</a>

				<!-- Modal Structure -->
				<div id="donations_modal" class="modal bottom-sheet">
					<div class="modal-content">
						<h4>Donations</h4>
						<ul class='collection'>
							<?php 
							$donations = $event->getDonationsArray();

							foreach ($donations as $donation) {
								$donator_user = new User((int) $donation['donator_user_id']);
								$user_id = $donator_user->getID();
								$user_name = $donator_user->getName();
								$profile_picture_dirctory = $donator_user->getProfilePictureDirectory();
								$amount = $donation['donation_amount'];
								$date = date("jS F", strtotime($donation['donated_at']));
								$time = date("g:ia", strtotime($donation['donated_at']));

								$p_style = "style='
									margin: 0;
									padding: 0;
									font-size: 10pt;
								'";

								$img_style = "style='
									border: 2px solid #004d40;
								'";

								$a_options = "
									href='profile.php?user_id=$user_id' 
									style='color: inherit;'
									class='tooltipped secondary-content' 
									data-position='left' 
									data-tooltip='Go to Profile'
								";

								echo "
									<li class='collection-item avatar'>
										<img $img_style src='$profile_picture_dirctory' alt='' class='circle'>
										<span class='title'><b>$user_name</b></span>
											<p $p_style><b>Amount: </b><text>RM$amount</text><br>											
											<p $p_style><b>Donated at: </b><text style='color: #90949c'>$date at $time</text>
											</p>
										<a $a_options >
											<i class='material-icons'>person</i>
										</a>
									</li>
								";
							}

							if (empty($donations)) {
								echo "
									<div style='padding: 20px'>No Donations.</div>
								";
							}
							?>
						</ul>
					</div>
					<div class="modal-footer">
						<div class="left" style="margin-left: 20px;"><b>Total Donations: </b><?php echo count($donations) ?></div><br/>
						<div class="left" style="margin-left: 20px; margin-bottom: 20px"><b>Funds Gathered: </b>RM<?php echo $event->getFundsGathered()?></div>
					</div>
				</div>
			</div>

			<!-- Center -->
			<div class="col s6">
				<?php $event->render($user, $active_user, "&goback=event&event_id=" . $event->getID()) ?>
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
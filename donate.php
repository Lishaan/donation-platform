<?php
session_start();

$root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/includes/dbh.inc.php');

require($root_dir . '/classes/User.php');
// require($root_dir . '/classes/Event.php');
require($root_dir . '/fragments/head.php');
require($root_dir . '/fragments/navbar.php');

$active_user;
$active_event;

if (isset($_SESSION['user_id']) and isset($_GET['event_id']) and isset($_POST['donate_button'])) {
	$active_user = new User((int) $_SESSION['user_id']);
	$active_event = new Event((int) $_GET['event_id']);

	render_head("Donate - " . $active_user->getName());
	render_navbar("Donate - " . $active_user->getName());
} else {
	echo ("
		<script type='text/javascript'> 
			window.location.href='profile.php?user_id=$_GET[user_id]'; 
		</script>
	");
}

?>

<link rel="stylesheet" href="assets/css/feed.css">
<script type="text/javascript" src="assets/js/card.js"></script>

<main>
	<div class="row" style="margin-bottom: 10px">
		<div class="col s12">
			<div class="white z-depth-1 center">
				<h5 id="explore_organisations" style="padding: 10px; margin: 0;">Donate</h5>
			</div>
		</div>
	</div>

	<!-- Content -->
	<div class="row">
		<div class="col s12">
			<!-- Left -->
			<div class='col s3 white z-depth-2' style='padding: 20px; margin: 0 0 20% 0'>
				<h5><b>Event Details</b></h5>
				<ul>
					<li>• Event by: <?php echo $active_event->getPosterUser()->getName() ?></li>
					<li>• Funds Gathered: RM<?php echo $active_event->getFundsGathered() ?></li>
					<li>• Funds Needed: RM<?php echo $active_event->getFundsNeeded() ?></li>
				</ul>
				<div class='center white z-depth-1' style='border-radius: 20px; padding: 5px; margin: 20px 0 0 0'>

					<p>You are about to <text style="color: blue">donate</text> RM<?php echo $_POST['donation_amount'] ?></p>
				</div>
			</div>

			<!-- Center -->
			<div class="col s9" style="margin: 0">
				<div class="white container z-depth-5" style="margin: 0; padding: 40px">
					<h4>Payment Window</h4>
					<div class='z-depth-1' style='margin: 20px 0 20px 0; padding: 10px 40px 10px 40px'>
						<h5 class="center" style="margin: 20px 0 20px 0">Enter card details</h5>
						<div class='card-wrapper'></div>
						<form action='event.php?event_id=<?php echo $_GET['event_id'] ?>&donation_amount=<?php echo $_POST['donation_amount']; ?>' method="POST">
							<div class="row" style="margin-top: 40px">
								<div class="input-field col s12">
									<input placeholder="eg: 8271 7272 6272 7551" id="number" name="number" type="text" />
									<label for="number"><b>Card Number</b></label>
								</div>
							</div>
							<div class="row" style="margin-top: 20px">
								<div class="input-field col s6">
									<input placeholder="eg: John" name="first-name" id="first-name" type="text" />
									<label for="first-name"><b>First Name</b></label>
								</div>
								<div class="input-field col s6">
									<input placeholder="eg: Smith" name="last-name" id="last-name" type="text" />
									<label for="last-name"><b>Last Name</b></label>
								</div>
							</div>
							<div class="row" style="margin-top: 20px">
								<div class="input-field col s6">
									<input placeholder="eg: 12/24" id="expiry" name="expiry" type="text" />
									<label for="expiry"><b>Expiry</b></label>
								</div>
								<div class="input-field col s6">
									<input placeholder="eg: 877" id="cvc" name="cvc" type="text" />
									<label for="cvc"><b>CVC</b></label>
								</div>
							</div>
							<div class="row center" style="margin-top: 40px; margin-bottom: 40px">
								<button disabled class="btn-large waves-effect blue darken-3" type="submit" id="donation_submit" name="donation_submit">Make Payment
									<i class="material-icons right">send</i>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script type="text/javascript">
	$(document).ready(() => {
		$('.modal').modal();
		$('.tooltipped').tooltip();

		$('#first-name').on("keyup", cardCheck);
		$('#last-name').on("keyup", cardCheck);
		$('#expiry').on("keyup", cardCheck);
		$('#cvc').on("keyup", cardCheck);

		function cardCheck() {
			console.log("Dssd");

			$check = ($('#first-name').val().length > 0) && ($('#last-name').val().length > 0) && ($('#expiry').val().length > 0) && ($('#cvc').val().length > 0);

			if ($check) {
				$('#donation_submit').prop("disabled", false);
			} else {
				$('#donation_submit').prop("disabled", true);
			}
		}

		var card = new Card({
		    // a selector or DOM element for the form where users will
		    // be entering their information
		    form: 'form', // *required*
		    // a selector or DOM element for the container
		    // where you want the card to appear
		    container: '.card-wrapper', // *required*

		    formSelectors: {
		        numberInput: 'input[name="number"]', // optional — default input[name="number"]
		        expiryInput: 'input[name="expiry"]', // optional — default input[name="expiry"]
		        cvcInput: 'input[name="cvc"]', // optional — default input[name="cvc"]
		        nameInput: 'input[name="first-name"], input[name="last-name"]' // optional - defaults input[name="name"]
		    },

		    // width: 200, // optional — default 350px

		    // Strings for translation - optional
		    messages: {
		        validDate: 'valid\ndate', // optional - default 'valid\nthru'
		        monthYear: 'mm/yyyy', // optional - default 'month/year'
		    },

		    // Default placeholders for rendered fields - optional
		    placeholders: {
		        number: '•••• •••• •••• ••••',
		        name: 'Full Name',
		        expiry: '••/••',
		        cvc: '•••'
		    },

		    masks: {
		        cardNumber: '•' // optional - mask card number
		    },

		    // if true, will log helpful messages for setting up Card
		    debug: true // optional - default false
		});
	});

</script> 

<?php 
require($root_dir . '/fragments/footer.php');
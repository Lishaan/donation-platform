<?php 
$root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/components/home_event.php'); 

if ($_GET['login'] === "required") {
	?>
	<script type="text/javascript">
		M.toast({html: 'You must login to perform that action'})
	</script>
	<?php
}
?>
<link rel="stylesheet" href="assets/css/home.css">

<!-- Carousel -->
<div class="carousel carousel-slider center z-depth-2">
	<div class="carousel-item teal lighten-2" href="" style="height: 20px">
		<img src="assets/img/home/panel_1.png" alt="" style="object-fit: cover;">
	</div>
	<div class="carousel-item teal lighten-2" href="" style="height: 20px">
		<img src="assets/img/home/panel_2.jpg" alt="" style="object-fit: cover;">
	</div>
	<div class="carousel-item teal lighten-2" href="" style="height: 20px">
		<img src="assets/img/home/panel_3.png" alt="" style="object-fit: cover;">
	</div>
</div>

<!-- Trending Events -->
<div class="container col s12" style="width: 70%; margin-bottom: 40px;">
	<div class="row" style="margin-top: 20px;">
		<h4 class="left"><b>Trending Events</b></h4>
	</div>
	<div class="row" style="margin-top: 20px;">
		<?php
		$connection = Database::getConnection();
		$sql = "SELECT * FROM events ORDER BY likes DESC LIMIT 6";
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$events = array();

		while ($row = mysqli_fetch_assoc($result)) {
			array_push($events, $row);
		}

		?>
		<script type="text/javascript">
			var percentages = [];
		</script>
		<?php

		$id = 0;
		foreach ($events as $event) {
			$poster_user_id = $event['poster_user_id'];


			$connection = Database::getConnection();
			$sql = "SELECT name FROM users WHERE id=$poster_user_id";
			$result = mysqli_query($connection, $sql);
			$connection->close();

			$row = mysqli_fetch_assoc($result);

			$url = "event.php?event_id=" . $event['id'];
			$title = "Event by " . $row['name'];
			$desc = $event['body'];
			$img = $event['image_directory'];
			$funds_needed = $event['fundsNeeded'];
			$funds_gathered = $event['fundsGathered'];

			render_home_event($id, $url, $img, $desc, $funds_gathered, $funds_needed, $title);
			$id++;
			?>
			<script type="text/javascript">
				percentages.push(<?php echo ($funds_gathered/$funds_needed*100) ?>);
			</script>
			<?php
		}

		?>
	</div>
</div>

<!-- Parallax -->
<div class="parallax-container">
	<div class="parallax"><img src="assets/img//sample-5.jpg"></div>
	<div class="row">
		<div class=" col s12">
			<div class="centered" style="font-weight: 700; font-size: 50px">Make Good Things Happen</div>
			<div class="centered" style="font-size: 20px; top: 70%; font-weight: 400">
				Join over 22million people supporting charity raise by NGOs
			</div>
		</div>
	</div>
</div>

<!-- Get You Started -->
<div class="section white" style="padding-top: 20px">
	<div class="row container" style="text-align: center; margin-bottom: 20px">
		<h4 style="color: black; margin: 0px">To Get You Started</h4>
		<p class="grey-text text-darken-3 lighten-3"></p>
	</div>

	<div class="row">
		<div class="col s4 section" style="outline:; padding-left:60px; padding-right: 60px" >
			<i class="material-icons" style="font-size: 70px; color: orange">account_circle</i>
			<h5>Profile</h5>
			<h6 style="color: grey">
				Create a profile that represents you, then connect with communities to post feed, pledges and make donations
			</h6>
		</div>

		<div class="col s4 section " style="outline:;padding-left:60px; padding-right: 60px">
			<i class="material-icons" style="font-size: 70px; color: green ">public</i>
			<h5>Communities</h5>
			<h6 style="color: grey">
				Stay connected with communities and organisation around the world to get the latest news and events!
			</h6>
		</div>

		<div class="col s4 section" style="outline: ;padding-left:60px; padding-right: 60px">
			<i class="material-icons" style="font-size: 70px; color: red">groups</i>
			<h5>Organisation</h5>
			<h6 style="color: grey">
				Organisation sign up for an account to post events and raise funds!
			</h6>
		</div>
	</div>
	<a href="index.php?form=signup" class="waves-effect waves-light btn" style="font-size: 15px; margin-top: 20px; margin-bottom: 40px">Sign up now!</a>
</div>

<!-- Organisations Overview -->
<div class="section grey lighten-2" style="padding-bottom: 1px;">
	<div class="row container" style="text-align: center; width: 100%;">       	
		<div class="col s12">
			<h4 style="color: black;margin-bottom: 40px">
				Follow a list of organisation in different categories on our platform
			</h4>
		</div>
		<div class="col s12 image-set">
			<img src="assets/img/wwf.png" style="width: 80px; height: 80px">
			<img src="assets/img/unicef.png" style="width: 160px; height: 80px">
			<img src="assets/img/ASPCA.png" style="width: 220px; height: 70px">
			<img src="assets/img/cancer.png" style="width: 230px; height: 80px">
			<img src="assets/img/greenpeace.png" style="width: 160px; height: 80px">
		</div>
		<div class="col s12">
			<h5 style="color: black; ; margin-top: 40px; margin-bottom: 40px">Do you work for an organisation?</h5>
		</div>

		<a href="index.php?form=signup" class="waves-effect waves-light btn" style="font-size: 15px;margin-bottom: 20px">Start Fundraising!</a>
	</div>
</div>

<script type="text/javascript">
	window.onload = () => {
		let id = 0;
		for (let p of percentages) {
			move(p, id);
			id++;
		}
	};

	function move(percentage, eventID) {
		let elem = document.getElementById("myBar" + eventID);
		let width = 10;
		let widthLimit = percentage;
		let id = setInterval(frame, 20);
		function frame() {
			if (width >= percentage) {
				clearInterval(id);
			} else {
				width += 1; 
				elem.style.width = width + '%';
				elem.innerHTML = width * 1  + '%';
			}
		}
	}

	$(document).ready(() => {
		$('.parallax').parallax();
		$('.carousel').carousel();
		$('.carousel.carousel-slider').carousel({
			fullWidth: true,
			indicators: true
		}, setTimeout(autoplay, 4500));

		function autoplay() {
			$('.carousel').carousel('next');
			setTimeout(autoplay, 4500);
		}

	});	
</script>
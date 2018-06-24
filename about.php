<?php
session_start();
$root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/classes/Database.php');
require($root_dir . '/includes/dbh.inc.php');
require($root_dir . '/fragments/head.php');
require($root_dir . '/fragments/navbar.php');

render_head("About");
render_navbar("About");
?>
<link rel="stylesheet" href="assets/css/about.css">
<body>
	<div class="bgimg-1">
		<div class="caption">
			<span class="border">GET TO KNOW US</span>
		</div>
	</div>

	<div style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
		<h3 style="text-align:center;">Who We Are</h3>
		<p style="text-align: center">We empower people and organizations to support and nurture the causes and communities they care about.</p>
	</div>

	<div class="bgimg-2">
		<div class="caption">
			<span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;">THIS IS WHY WE CARE</span>
		</div>
	</div>

	<div style="position:relative;">
		<div style="color:#ddd;background-color:#282E34;text-align:center;padding:50px 80px;text-align: justify;">
			<p>More important than the amount of money you raise in a single day, fundraising events can lead to long term donations to, awareness of, and loyalty to your nonprofit. And incorporating volunteers into your events is a great way to make the most of this relationship building potential.</p>
		</div>
	</div>

	<div class="bgimg-3">
		<div class="caption">
			<span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;">HOW WE WORK</span>
		</div>
	</div>

	<div style="position:relative;">
		<div style="color:#ddd;background-color:#282E34;text-align:center;padding:50px 80px;text-align: justify;">
			<p>A fundraiser is any event or campaign developed with the sole purpose of raising money for a specific purpose. Fund raisers are held by schools, churches, organizations, charities, and many other groups who need to raise money for their financial goals.</p>
		</div>
	</div>

	<div class="bgimg-4">
		<div class="transbox" style="border-radius: 20px; padding: 20px; left: 15%;top:5%;width: 25%;height: 40%;text-align: center">
			<h>Our Mission</h>
			<p>This Fundraising website is a catalyst for people to feel, see, and claim their power.</p>
		</div>
		<div class="transbox" style="border-radius: 20px; padding: 20px; left: 60%;top: 5%;width: 25%;height: 40%;text-align: center">
			<h>Our Promises</h>
			<p>We deliver optimistic and diverse storytelling, experiences, and points of view to our kind users.</p>
		</div>
		<div class="transbox" style="border-radius: 20px; padding: 20px; left: 15%;top: 55%;width: 25%;height: 40%;text-align: center">
			<h>Our Hopes</h>
			<p>Is to reduce sadness, helplessness, and create happiness.</p>
		</div>
		<div class="transbox" style="border-radius: 20px; padding: 20px; left: 60%;top: 55%;width: 25%;height: 40%;text-align: center">
			<h>Our Vibes</h>
			<p>At this Website, we make magic. We dream it, and then do it—together—every day reinventing what's possible.</p>
		</div>
	</div>

	<div style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
		<h3 style="text-align:center;">Inspire everybody</h3>
		<!-- <p style="text-align: center">Who Inspire</p> -->
	</div>

	<div class="bgimg-5">
		<div class="caption">
			<span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;">Join Us!</span>
		</div>
	</div>
</body>
<?php require($root_dir . '/fragments/footer.php');
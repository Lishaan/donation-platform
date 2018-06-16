<style type="text/css" media="screen">

.card-action {
	color: black;
}

.card-image > img {
	height: 200px;
}

.large {
	height: 400px !important;
}

#myProgress {
	width: 100%;
	background-color: #ddd;
	margin-bottom: 0px;
	border-radius:16px;

}

.progressBar {
	width: 0%;
	height: 30px;
	background-color: #4CAF50;
	text-align: center;
	line-height: 30px;
	color: black;
	border-radius: 16px
}
</style>

<?php function render_home_event($id = 0, $url = "#", $img = "#", $desc = "", $money_raised = 0, $money_needed = 0) { ?>
	<div class="col s4">
		<a href="<?php echo $url ?>">
			<div class="card white large hoverable z-depth-1" >
				<div class="card-image"><img src="<?php echo $img ?>"></div>

				<div class="card-content white-text" style="padding: 10px">
					<span class="card-title" style="color: black; font-weight: bold;">Charity for Tigers</span>
					<p style="color: black;"><?php echo $desc ?></p>
				</div>

				<div class="card-action" style="padding:6px; padding-top: 0px;">
					<a style="left font-size: 20px;">
						RM<?php echo $money_raised ?>
						<a style="left font-size: 15px; color: grey">
							of RM<?php echo $money_needed ?> raised
						</a>
					</a>

					<div id="myProgress"><div class="progressBar" id="myBar<?php echo $id; ?>"><b>0%</b></div></div>
				</div>
			</div>
		</a>
	</div>
<?php } ?>



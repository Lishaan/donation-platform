<div class="container z-depth-5" style="width: 40%; margin: 20px 0 20px 0; padding: 40px;">
	<h4 style="margin-bottom: 25px;">Create an account</h4>
	<div class="row" style="margin-bottom: 40px;">
		<div class="col s12 z-depth-1 hoverable" style="padding: 0;">
			<ul class="tabs">
				<li class="tab col s6"><a href="#donator" class="teal-text text-darken-4">Donator</a></li>
				<li class="tab col s6"><a href="#organisation" class="teal-text text-darken-4">Organisation</a></li>
			</ul>
		</div>
	</div>
	<!-- Donators -->
	<div id="donator" class="col s12">
		<div class="row">
			<form class="col s12" action="includes/signup.inc.php" method="POST">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">account_circle</i>
						<input placeholder="eg: John Smith" id="full_name" name="full_name" type="text" />
						<label for="full_name"><b>Full Name</b></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">email</i>
						<input placeholder="email@example.com" id="don_email" name="don_email" type="email" />
						<label for="don_email"><b>Email</b></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">lock</i>
						<input placeholder="Enter your password" id="don_password" name="don_password" type="password" />
						<label for="don_password"><b>Password</b></label>
					</div>
				</div>
				<div style="margin: 10px 0 30px 0"><a href="index.php?form=login">Already have an account? Log in!</a></div>
				<button class="btn-large waves-effect blue darken-3" type="submit" name="don_submit">Sign Up
					<i class="material-icons right">send</i>
				</button>
			</form>
		</div>
	</div>
	<!-- Organisations -->
	<div id="organisation" class="col s12">
		<div class="row">
			<form class="col s12" action="includes/signup.inc.php" method="POST">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">account_circle</i>
						<input placeholder="eg: UNICEF" name="org_name" type="text" class="validate">
						<label for="org_name"><b>Organisation Name</b></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">email</i>
						<input placeholder="email@example.com" name="org_email" type="email" class="validate">
						<label for="org_email"><b>Email</b></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">lock</i>
						<input placeholder="Enter your password" name="org_password" type="password" class="validate">
						<label for="org_password"><b>Password</b></label>
					</div>
				</div>
				<div style="margin: 10px 0 30px 0"><a href="index.php?form=login">Already have an account? Log in!</a></div>
				<button class="btn-large waves-effect blue darken-3" type="submit" name="org_submit">Sign Up
					<i class="material-icons right">send</i>
				</button>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.tabs').tabs();
	});
</script>
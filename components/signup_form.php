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
			<form class="col s12" action="includes/signup.inc.php?type=D" method="POST">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">account_circle</i>
						<input placeholder="eg: John Smith" name="name" type="text" />
						<label for="full_name"><b>Full Name</b></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">email</i>
						<input placeholder="email@example.com" name="email" type="email" />
						<label for="email"><b>Email</b></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">lock</i>
						<input placeholder="Enter your password" name="password" type="password" />
						<label for="password"><b>Password</b></label>
					</div>
				</div>
				<div style="margin: 10px 0 30px 0"><a href="index.php?form=login">Already have an account? Log in!</a></div>
				<button class="btn-large waves-effect blue darken-3" type="submit" name="submit">Sign Up
					<i class="material-icons right">send</i>
				</button>
			</form>
		</div>
	</div>
	<!-- Organisations -->
	<div id="organisation" class="col s12">
		<div class="row">
			<form class="col s12" action="includes/signup.inc.php?type=O" method="POST">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">account_circle</i>
						<input placeholder="eg: UNICEF" name="name" type="text" class="validate">
						<label for="name"><b>Organisation Name</b></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">email</i>
						<input placeholder="email@example.com" name="email" type="email" class="validate">
						<label for="email"><b>Email</b></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">lock</i>
						<input placeholder="Enter your password" name="password" type="password" class="validate">
						<label for="password"><b>Password</b></label>
					</div>
				</div>
				<div style="margin: 10px 0 30px 0"><a href="index.php?form=login">Already have an account? Log in!</a></div>
				<button class="btn-large waves-effect blue darken-3" type="submit" name="submit">Sign Up
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
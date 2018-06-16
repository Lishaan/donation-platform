<div class="container z-depth-5" style="width: 40%; margin: 20px 0 20px 0; padding: 40px;">
	<h4 style="margin-bottom: 25px;">Login</h4>
	<div id="donator" class="col s12">
		<div class="row">
			<form class="col s12" action="includes/login.inc.php" method="POST">
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
				<div style="margin: 10px 0 30px 0"><a href="index.php?form=signup">Don't have an account? Sign up!</a></div>
				<button class="btn-large waves-effect blue darken-3" type="submit" name="submit">Login
					<i class="material-icons right">send</i>
				</button>
			</form>
		</div>
	</div>
</div>
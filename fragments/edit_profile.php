<?php function render_edit_profile($active_user) { ?>
	<style type="text/css" media="screen">
	.tab_ep {
		float: left;
		background-color: #e0f2f1;
		width: 30%;
		height: 90%;
	}

	.tab_ep button {
		display: block;
		background-color: inherit;
		color: #004d40;
		padding: 22px 16px;
		width: 100%;
		border: none;
		outline: none;
		text-align: left;
		cursor: pointer;
		transition: 0.3s;
	}

	.tab_ep button:hover {
		background-color: #B7DBD8;
	}

	.tab_ep button.active {
		background-color: #B7DBD8;
	}

	.tabcontent {
		float: left;
		padding: 0px 12px;
		width: 70%;
		border-left: none;
		height: 90%;
	}

	#profile_picture_settings {
		margin-top: 50px; 
		width: 180px; 
		height: 180px;
		border-radius: 50%;
		border: solid;
		border-color: #004d40;
	}
</style>

<?php
if ($_GET['biodesc'] === "updated") {
	$biodesc = $active_user->isDonator() ? "Bio" : "Description"
	?>
	<script type="text/javascript">
		M.toast({html: 'Your <?php echo $biodesc ?> has been changed'})
	</script>
	<?php
}

if ($_GET['changes'] === "no") {
	?>
	<script type="text/javascript">
		M.toast({html: 'No changes has been made'})
	</script>
	<?php
}

if ($_GET['email'] === "updated") {
	?>
	<script type="text/javascript">
		M.toast({html: 'Your email has been changed'})
	</script>
	<?php
}

if ($_GET['upload-file'] === "success") {
	?>
	<script type="text/javascript">
		M.toast({html: 'Your profile picture has been changed'})
	</script>
	<?php
}


if ($_GET['upload-file'] === "file-size") {
	?>
	<script type="text/javascript">
		M.toast({html: 'The file size is too big'})
	</script>
	<?php
}


if ($_GET['upload-file'] === "file-error") {
	?>
	<script type="text/javascript">
		M.toast({html: 'There was an error uploading the file'})
	</script>
	<?php
}


if ($_GET['upload-file'] === "file-type") {
	?>
	<script type="text/javascript">
		M.toast({html: 'The uploaded file type is invalid. Please upload JPGs and PNGs.'})
	</script>
	<?php
}

if ($_GET['change-password'] === "mismatch") {
	?>
	<script type="text/javascript">
		M.toast({html: 'Your current password does not match the password in the database'})
	</script>
	<?php
}

if ($_GET['change-password'] === "success") {
	?>
	<script type="text/javascript">
		M.toast({html: 'Password changed successfully'})
	</script>
	<?php
}
?>


<center>
	<div class="white container z-depth-5" style=" margin: 20px 0 20px 0; padding: 40px; height: 900px">
		<p style="font-size: 25pt; text-align: left; margin: 0 0 25px 0;">Settings</p>
		<div class="tab_ep z-depth-1">
			<button class="waves-effect waves-light tablinks active" onclick="viewTab(event, 'EditProfile')"><b>Edit Profile</b></button>
			<button class="waves-effect waves-light tablinks" onclick="viewTab(event, 'ChangePassword')"><b>Change Password</b></button>
		</div>

		<div id="EditProfile" class="tabcontent z-depth-1">
			<form action="profile.php?user_id=<?php echo $active_user->getID() ?>&edit-profile=true" method="POST" enctype="multipart/form-data">
				<div class="center-align">
					<img src="../<?php echo $active_user->getProfilePictureDirectory() ?>" id="profile_picture_settings" class="circle responsive-img">
					<p style="font-size: 15pt"><?php echo $active_user->getName() ?></p>

					<div class="file-field input-field" style="margin: 40px 0 40px 0">
						<div class="btn">
							<span>Change Profile Picture</span>
							<input name="profile_picture_image" type="file">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Upload an image file (JPG and PNG only)">
						</div>
					</div>
				</div>
				<div class="row">
					<?php $biodesc = $active_user->isDonator() ? "Bio" : "Description" ?>
					<div class="input-field col s12">
						<textarea placeholder="Change Your <?php echo $biodesc ?>" autocomplete="false" name="biodesc" id="post_textarea" class="materialize-textarea" data-length="256"><?php echo $active_user->getBioDesc() ?></textarea>
						<label for="post_textarea"><?php echo $biodesc ?></label>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
						<input disabled placeholder="Change your email" name="email" value="<?php echo $active_user->getEmail() ?>" type="text" class="validate">
						<label for="name">Email</label>
					</div>
				</div>

				<div class="col s12" >
					<button class="btn-small waves-effect waves-light " type="submit" name="update_edit_profile" style="float: right">
						Update<i class="material-icons right">send</i>
					</button>
				</div>
			</form>
		</div>

		<div id="ChangePassword" class="tabcontent z-depth-1" style="display: none;">
			<form action="profile.php?user_id=<?php echo $active_user->getID() ?>&edit-profile=true" method="POST">
				<div class="row" style="margin-top: 60px;">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">lock</i>
						<input id="password_1" placeholder="Enter your current password" name="password_old" type="password" class="validate">
						<label for="password"><b>Current Password</b></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">lock</i>
						<input id="password_2" placeholder="Enter your new password" name="password_new" type="password" class="validate">
						<label for="password"><b>New Password</b></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="padding-right: 20px;">lock</i>
						<input id="password_3" placeholder="Re-enter your new password" name="password_new2" type="password" class="validate">
						<label for="password"><b>Re-enter New Password</b></label>
					</div>
				</div>
				<div class="row">
					<div class="col s12" >
						<button disabled class="btn-small waves-effect waves-light " type="submit" name="change_password" id="change_password" style="float: right">
							Change password<i class="material-icons right">send</i>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</center>

<script type="text/javascript">
	function viewTab(evt, idName) {
		var i, tabcontent, tablinks;

		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}

		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}

		document.getElementById(idName).style.display = "block";
		evt.currentTarget.className += " active";
	}

	$(document).ready(() => {
		$('#password_1').on("keyup", passwordCheck);
		$('#password_2').on("keyup", passwordCheck);
		$('#password_3').on("keyup", passwordCheck);

		function passwordCheck() {
			$check = ($('#password_1').val().length > 0) && ($('#password_2').val() == $('#password_3').val());

			console.log($('#password_1').val());

			if ($check && $('#password_2').val().length > 0) {
				$('#change_password').prop("disabled", false);
			} else {
				$('#change_password').prop("disabled", true);
			}
		}
	});
</script>
<?php }
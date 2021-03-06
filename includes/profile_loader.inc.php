<?php $root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/includes/dbh.inc.php');
require($root_dir . '/classes/User.php');

if ($_GET['login'] === "required") {
	?>
	<script type="text/javascript">
		M.toast({html: 'Please login to perform that action'})
	</script>
	<?php
}

if ($_GET['create_post'] === "success") {
	?>
	<script type="text/javascript">
		M.toast({html: 'Your post has been created'})
	</script>
	<?php
}

if ($_GET['delete_post'] === "success") {
	?>
	<script type="text/javascript">
		M.toast({html: 'Your post has been deleted'})
	</script>
	<?php
}

if ($_GET['login'] === "success") {
	?>
	<script type="text/javascript">
		M.toast({html: 'You have been logged in'})
	</script>
	<?php
}

if ($_GET['commented'] === "success" and !isset($_GET['goback'])) {
	echo ("
		<script type='text/javascript'> 
			window.location.href='profile.php?user_id=" . $_GET['user_id'] . "';
		</script>
	");
}

// Profile page
if (isset($_GET['user_id'])) {
	$user = new User((int) $_GET['user_id']);
	$active_user = new User((int) $_SESSION['user_id']);

	if (User::exists($user)) {
		$following = User::isFollowing($user, $active_user);

		// If user clicks follow button
		if (isset($_POST['follow'])) {
			if (!$following) {
				$active_user->follow($user);
			}
		}

		// If user clicks unfollow button
		if (isset($_POST['unfollow'])) {
			if ($following) {
				$active_user->unfollow($user);
			}
		}

		// Submit post
		if (isset($_POST['submit_post'])) {
			$active_user->createPost($_POST['title'], $_POST['body']);
		}

		// Delete post
		if (isset($_POST['delete_post'])) {
			$active_user->deletePost((int) $_GET['delete_post_id']);
		}

		// Submit like
		if (isset($_POST['like_post'])) {
			$active_user->likePost((int) $_GET['post_id']);
		}

		// Submit like
		if (isset($_POST['like_event'])) {
			$active_user->likeEvent((int) $_GET['event_id']);
		}

		// Submit event
		if (isset($_POST['submit_event'])) {

			if (!empty($_FILES['event_image']['tmp_name'])) {
				define('MB', 1048576);
				$user_id = $active_user->getID();

				$file = $_FILES['event_image'];

				$file_name = $file['name'];
				$file_type = $file['type'];
				$file_size = $file['size'];
				$file_error = $file['error'];
				$file_tmp_dir = $file['tmp_name'];

				$file_extension = strtolower(end(explode('.', $file_name)));

				$allowed_extensions = array('jpg', 'jpeg', 'png');

				if (in_array($file_extension, $allowed_extensions)) {
					if ($file_error === 0) {
						if ($file_size <= 5*MB) {
							$file_unique_name = sprintf("event_picture_uid_%d_id_%s", $user_id, Database::getRandomID());
							$file_name_new = "$file_unique_name.$file_extension";

							$file_destination = "assets/img/event_images/$file_name_new";
							move_uploaded_file($file_tmp_dir, $file_destination);

							$active_user->createEvent($_POST['title'], $_POST['body'], $_POST['fundsNeeded'], $file_destination);

							$link = "profile.php?user_id=$user_id&upload-file=success";

							echo ("
								<script type='text/javascript'> 
									window.location.href='$link';
								</script>
							");

						} else {
							$link = "profile.php?user_id=$user_id&upload-file=file-size";
							echo ("
								<script type='text/javascript'> 
									window.location.href='$link';
								</script>
							");
						}
					} else {
						$link = "profile.php?user_id=$user_id&upload-file=file-error";
						echo ("
							<script type='text/javascript'> 
								window.location.href='$link';
							</script>
						");
					}
				} else {
					$link = "profile.php?user_id=$user_id&upload-file=file-type";
					echo ("
						<script type='text/javascript'> 
							window.location.href='$link';
						</script>
					");
				}
			}
		}

		// Delete post
		if (isset($_POST['delete_event'])) {
			$active_user->deleteEvent((int) $_GET['delete_event_id']);
		}

		// Submit Comment
		if (isset($_POST['post_comment'])) {
			$active_user->commentPost((int) $_GET['post_id'], (string) $_POST['comment_body']);
		}

		if (isset($_POST['event_comment'])) {
			$active_user->commentEvent((int) $_GET['event_id'], (string) $_POST['comment_body']);
		}

		// Settings -> Edit Profile
		if (isset($_POST['update_edit_profile'])) {

			$user_id = $active_user->getID();
			$new_bio = $_POST['biodesc'];
			$change_bio = $new_bio !== $active_user->getBioDesc();


			if (!empty($_FILES['profile_picture_image']['tmp_name'])) {
				define('MB', 1048576);

				$file = $_FILES['profile_picture_image'];

				$file_name = $file['name'];
				$file_type = $file['type'];
				$file_size = $file['size'];
				$file_error = $file['error'];
				$file_tmp_dir = $file['tmp_name'];

				$file_extension = strtolower(end(explode('.', $file_name)));

				$allowed_extensions = array('jpg', 'jpeg', 'png');

				if (in_array($file_extension, $allowed_extensions)) {
					if ($file_error === 0) {
						if ($file_size <= 2*MB) {
							$file_unique_name = sprintf("profile_picture_uid_%d", $active_user->getID());
							$file_name_new = "$file_unique_name.$file_extension";

							$file_destination = "assets/img/profile_pictures/$file_name_new";
							move_uploaded_file($file_tmp_dir, $file_destination);
							
							if ($active_user->isDonator()) {
								$sql = "UPDATE donators_info SET profile_picture_directory='$file_destination' WHERE user_id=$user_id";
								mysqli_query($connection, $sql);
							} else {
								$sql = "UPDATE organisations_info SET profile_picture_directory='$file_destination' WHERE user_id=$user_id";
								mysqli_query($connection, $sql);
							}

							$link = "profile.php?user_id=$user_id&edit-profile=true&upload-file=success";
							echo ("
								<script type='text/javascript'> 
									window.location.href='$link';
								</script>
							");

						} else {
							$link = "profile.php?user_id=$user_id&edit-profile=true&upload-file=file-size";
							echo ("
								<script type='text/javascript'> 
									window.location.href='$link';
								</script>
							");
						}
					} else {
						$link = "profile.php?user_id=$user_id&edit-profile=true&upload-file=file-error";
						echo ("
							<script type='text/javascript'> 
								window.location.href='$link';
							</script>
						");
					}
				} else {
					$link = "profile.php?user_id=$user_id&edit-profile=true&upload-file=file-type";
					echo ("
						<script type='text/javascript'> 
							window.location.href='$link';
						</script>
					");
				}
			}

			if ($change_bio) {
				if ($active_user->isDonator()) {
					$sql = "UPDATE donators_info SET profile_bio='$new_bio' WHERE user_id=$user_id";
					mysqli_query($connection, $sql);
					echo mysqli_error($connection);
				} else {
					$sql = "UPDATE organisations_info SET profile_description='$new_bio' WHERE user_id=$user_id";
					mysqli_query($connection, $sql);
				}
				
				$link = "profile.php?user_id=$user_id&edit-profile=true&biodesc=updated";
				echo ("
					<script type='text/javascript'> 
						window.location.href='$link';
					</script>
				");
			} else {
				$link = "profile.php?user_id=$user_id&edit-profile=true&changes=no";
				echo ("
					<script type='text/javascript'> 
						window.location.href='$link';
					</script>
				");
			}
		}

		// Settings -> Change password
		if (isset($_POST['change_password'])) {

			$old_password = mysqli_real_escape_string($connection, $_POST['password_old']);
			$new_password = mysqli_real_escape_string($connection, $_POST['password_new']);
			$new_password_retyped = mysqli_real_escape_string($connection, $_POST['password_new2']);

			if ($new_password === $new_password_retyped) {

				$user_id = $_SESSION['user_id'];
				$hashed_old_password = password_hash($old_password, PASSWORD_DEFAULT);

				$result = mysqli_query($connection, "SELECT * FROM users WHERE id='$user_id'");

				if (mysqli_num_rows($result) < 1) {
					echo ("
						<script type='text/javascript'> 
							window.location.href='profile.php?user_id=$user_id&edit-profile=true'; 
						</script>
					");
				} else {

					if ($row = mysqli_fetch_assoc($result)) {
						
						$matched_password = password_verify($old_password, $row['password']);

						if ($matched_password === false) {
							echo ("
								<script type='text/javascript'> 
									window.location.href='profile.php?user_id=$user_id&edit-profile=true&change-password=mismatch'; 
								</script>
							");
						} elseif ($matched_password === true) {				


							$hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

							mysqli_query (
								$connection, 
								"UPDATE users SET password='$hashed_new_password' WHERE id='$user_id'"
							);

							echo ("
								<script type='text/javascript'> 
									window.location.href='profile.php?user_id=$user_id&edit-profile=true&change-password=success'; 
								</script>
							");
						}
					}
				}
			} else {
				echo ("
					<script type='text/javascript'> 
						window.location.href='../shop.php?change-password=mismatch'; 
						window.alert('Please retype the same password');
					</script>
				");
			}


		}

	} else {
		echo ("
			<script type='text/javascript'> 
				window.location.href='../index.php';
			</script>
		");
	}
} else {
	echo ("
		<script type='text/javascript'> 
			window.location.href='../index.php';
		</script>
	");
}

if (isset($_GET['goback'])) {
	$goback = $_GET['goback'];

	$args = "?";

	if (isset($_GET['event_id'])) {
		$args .= "event_id=" . $_GET['event_id'];

		if (isset($_GET['login'])) {
			$args .= "&login=" . $_GET['login'];
		}
	}

	if (isset($_GET['post_id'])) {
		$args .= "post_id=" . $_GET['post_id'];

		if (isset($_GET['login'])) {
			$args .= "&login=" . $_GET['login'];
		}
	}

	echo ("
		<script type='text/javascript'> 
			window.location.href='../$goback.php$args';
		</script>
	");
}

function render_profile_info(User $user, $following) {
	$bio_desc = "Description";
	$bio_desc_content = $user->getBioDesc();
	
	if ($user->getType() === 'D') {
		$bio_desc = "Bio";
	}

	$user_id = $user->getID();
	$user_name = $user->getName();
	$profile_picture_directory = $user->getProfilePictureDirectory();

	echo ("
		<div id='profile-picture'>
			<img src='$profile_picture_directory' alt='profile_picture' id='banner-image' class='circle responsive-img'>	
		</div>
		<div class='col s3 white z-depth-2' style='margin-bottom: 20%'>
			<div style='padding: 20px; padding-top: 40px'>
				<h4>$user_name</h4>
				<p><b>$bio_desc: </b>$bio_desc_content</p>
				<!-- Follow Button -->
				<form action='../profile.php?user_id=$user_id' method='POST' accept-charset='utf-8'>
	");
	if ($following and isset($_SESSION['user_id']) and $_SESSION['user_id'] !== $user_id) {
		echo ("
					<button class='btn waves-effect waves-light' style='margin-top: 40px;' type='submit' name='unfollow' value='Unfollow'>Unfollow<i class='material-icons right'>person_outline</i>
				  	</button>
		");
	} else if (!$following and isset($_SESSION['user_id']) and $_SESSION['user_id'] !== $user_id) {
		echo ("
					<button class='btn waves-effect waves-light' style='margin-top: 40px;' type='submit' name='follow' value='Follow'>Follow<i class='material-icons right'>person_add</i>
					</button>
		");
	}
	echo ("
				</form>
			</div>
		</div>
	");
}
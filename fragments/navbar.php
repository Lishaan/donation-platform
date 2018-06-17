<?php 
session_start();

function render_navbar($activepage) { ?>
	<body>
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper teal darken-2">

					<a href="index.php" class="brand-logo" style="margin-left: 10px">Logo</a>
					<ul class="left hide-on-med-and-down" style="margin-left: 100px"> 
						<li class="<?php echo $activepage === 'Home' ? "active" : '' ?>"><a href="index.php">Home</a></li>
						<li class="<?php echo $activepage === 'About' ? "active" : '' ?>"><a href="#">About</a></li>
						<li class="<?php echo substr($activepage, 0, 4) === 'Feed' ? "active" : '' ?>"><a href="feed.php">Feed</a></li>
						<li class="<?php echo substr($activepage, 0, 7) === 'Explore' ? "active" : '' ?>"><a href="#">Explore</a></li>
					</ul>

					<?php if (!isset($_SESSION['user_id'])): ?>

						<ul class="right hide-on-med-and-down">
							<li><a href="index.php?form=login">Login</a></li>
							<li><a href="index.php?form=signup">Sign Up</a></li>
						</ul>

					<?php else: ?>

						<ul id="dropdown" class="dropdown-content" style="margin-top: 50px">
							<li><a href="../profile.php?user_id=<?php echo $_SESSION['user_id']; ?>">View Profile</a></li>
							<li><a href="../profile.php?user_id=<?php echo $_SESSION['user_id']; ?>&edit-profile=true">Settings</a></li>
							<li class="divider"></li>
							<li><a href="../includes/signout.inc.php">Logout</a></li>
						</ul>
						<ul class="right hide-on-med-and-down">
							<li>
								<a class="dropdown-trigger" data-target="dropdown">
									<i class="material-icons right">arrow_drop_down</i><?php echo $_SESSION['user_name']; ?>
								</a>
							</li>
						</ul>

					<?php endif; ?>

				</div>
			</nav>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".dropdown-trigger").dropdown();
			});
		</script>

<?php }
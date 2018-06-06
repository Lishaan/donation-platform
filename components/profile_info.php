<div class="col s4 white z-depth-2">
	<div style="padding: 20px; padding-top: 40px">
		<h4><?php echo $user_name;?></h4>
		<p><b><?php echo ($user_type === 'D') ? 'Bio' : 'Description'; ?>: </b>Aenean eu ipsum vestibulum, congue ipsum sit amet, bibendum sem.</p>
		<!-- Follow Button -->
		<form action="../profile.php?user_id=<?php echo $user_id; ?>" method="POST" accept-charset="utf-8">
			<?php if ($following and $_SESSION['user_id'] !== $user_id): ?>
				    <button class="btn waves-effect waves-light" style="margin-top: 40px;" type="submit" name="unfollow" value="Unfollow">
						Unfollow<i class="material-icons right">person_outline</i>
				  	</button>
			<?php elseif ($_SESSION['user_id'] !== $user_id): ?>
				<button class="btn waves-effect waves-light" style="margin-top: 40px;" type="submit" name="follow" value="Follow">Follow
				    <i class="material-icons right">person_add</i>
				  </button>
			<?php endif; ?>
		</form>
	</div>
</div>
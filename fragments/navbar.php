<?php 
session_start();

function render_navbar($activepage) { ?>
<body>
  <div class="navbar-fixed">
    <nav>
      <div class="nav-wrapper teal darken-2">
        
        
        <a href="index.php" class="brand-logo" style="margin-left: 10px">Logo</a>
        <ul class="left hide-on-med-and-down" style="margin-left: 100px"> 
          <li class="<?php $activepage === 'Home' ? "active" : '' ?>"><a href="index.php">Home</a></li>
          <li class="<?php $activepage === 'About' ? "active" : '' ?>"><a href="#">About</a></li>
          <li class="<?php $activepage === 'Feed' ? "active" : '' ?>"><a href="#">Feed</a></li>
          <li class="<?php $activepage === 'Explore' ? "active" : '' ?>"><a href="#">Explore</a></li>
        </ul>
        
        <?php if (!isset($_SESSION['u_id'])): ?>
          <ul class="right hide-on-med-and-down">
            <li><a href="index.php?form=login">Login</a></li>
            <li><a href="index.php?form=signup">Sign Up</a></li>
          </ul>
        <?php else: ?>
          <ul class="right hide-on-med-and-down">
            <li><a href="../profile.php?user_id=<?php echo $_SESSION['u_id']; ?>">Profile</a></li>
            <li><a href="../includes/signout.inc.php">Logout</a></li>
          </ul>
        <?php endif; ?>
      </div>
    </nav>
  </div>

<?php } ?>
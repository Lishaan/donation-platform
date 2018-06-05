<?php function render_navbar($activepage) { ?>

<body style="background-color: #ffffff">
<div>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color:#ffffff;border:1px solid rgba(0,0,0,0.12);">
  <a class="navbar-brand" href="/">Donation Platform</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?=$activepage === 'Home' ? "active" : ''?>">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?=$activepage === 'About' ? "active" : ''?>">
        <a class="nav-link" href="/about.php">About</a>
      </li>
      <li class="nav-item <?=$activepage === 'Feed' ? "active" : ''?>">
        <a class="nav-link" href="/feed.php">Feed</a>
      </li>
      <li class="nav-item <?=$activepage === 'Explore' ? "active" : ''?>">
        <a class="nav-link" href="/explore.php">Explore</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Login / Sign Up</button>
    </form>
  </div>
</nav>
</div>

<?php } ?>
<!DOCTYPE html>
<html>
<head>
	<title>Organisation Statistic</title>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="assets/js/materialize.min.js"></script>

	
</head>

<style type="text/css">

	.collection .collection-item img.circle{
	width: 70px !important;
	height: 70px !important
}

i.right {
  float: right;
  margin-left: 5px;
}

.info > li > div > i {
	font-size: 45px !important;
}
</style>

<body style="background-color: #eeeeee">
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper  amber darken-3">
				
				
				<a href="#" class="brand-logo" style="margin-left: 10px">Logo</a>
				<ul class="left hide-on-med-and-down" style="margin-left: 100px">	
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Feed</a></li>
					<li><a href="#">Explore</a></li>
				</ul>
				
				<ul class="right hide-on-med-and-down">
					<li><a href="#">Login / Sign Up</a></li>
				</ul>
			</div>
		</nav>
	</div>
	<div class="container" style="width: 80%">
	<div class="row">
		<div class="col s12 center-align">
			<h5>Activity Overview</h5>
		</div>
		<div class="col s4" >
			<ul class="collection info" style="background-color: white">
    			<li class="collection-item avatar">
      				<img src="images/wwf.png" alt="" class="circle">
      				<h5 style="margin-left: 20px">Organisation Name</h5>
      				
    			</li>

    			<li class="collection-item valign-wrapper" style="padding: 5px">
    				
    				<div>
    					<i class="medium material-icons " >attach_money</i>
    				</div>
    				<div style="line-height: 10px; padding-left: 10px">
    					<p style="font-weight: bold">Total Funds Raised</p>
    					<p>RM734,584</p>
    				</div>
    					
    			</li>

    			<li class="collection-item valign-wrapper" style="padding: 5px">
    				
    				<div>
    					<i class="medium material-icons " >event</i>
    				</div>
    				<div style="line-height: 10px; padding-left: 10px">
    					<p style="font-weight: bold">Number of Events</p>
    					<p>83</p>
    				</div>
    					
    			</li>

    			<li class="collection-item valign-wrapper" style="padding: 5px">
    				
    				<div>
    					<i class="medium material-icons " >chat</i>
    				</div>
    				<div style="line-height: 10px; padding-left: 10px">
    					<p style="font-weight: bold">Number of Post</p>
    					<p>80</p>
    				</div>
    					
    			</li>
    			
    		</ul>
		</div>

		<div class="col s8" >
			<ul class="collection">
				<li class="collection-item" style="background-color: #bdbdbd">
					<a class="waves-effect waves-light btn-small">Funds Raised</a>
					<a class="waves-effect waves-light btn-small">Events Stats</a>
					<a class="waves-effect waves-light btn-small">Post Stats</a>

					<!-- Dropdown Trigger -->
  					<a class='dropdown-trigger btn' href='#' data-target='dropdown1' style="float: right;"><i class="large material-icons right">arrow_downward</i>Year</a>

  					<!-- Dropdown Structure -->
  					<ul id='dropdown1' class='dropdown-content'>
    					<li><a href="#!">2018</a></li>
    					<li><a href="#!">2017</a></li>
    					<li><a href="#!">2016</a></li>
    					
  					</ul>
				</li>

				<li class="collection-item">
					
						<canvas id ="myChart" height="200" width="400"></canvas>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
						<script src="myCharts.js"></script>
					
				</li>
			</ul>
		</div>
	</div>
</div>


<script type="text/javascript">
	$('.dropdown-trigger').dropdown();
</script>

</body>

<footer class="page-footer amber darken-3" style="margin-top: 0px; bottom: 0">
	<div class="container" style="width: 90%">
		<div class="row" ">
			<div class="col l3 " style="line-height: ">
				<h5 class="white-text">Logo</h5>
				

			</div>
			<div class="col l3 " style="text-align: left; line-height: 30px">
				<h5 class="white-text">Learn More</h5>
				<ul class="footer-list" >
					<li><a class="grey-text text-lighten-3" href="#">How It Works</a></li>
					<li><a class="grey-text text-lighten-3" href="#">Our Voice</a></li>
					<li><a class="grey-text text-lighten-3" href="#">Stories</a></li>
					<li><a class="grey-text text-lighten-3" href="#">Fundraising Tips</a></li>
					<li><a class="grey-text text-lighten-3" href="#">About Us</a></li>
				</ul>
			</div>
			<div class="col l3" style="text-align: left; line-height: 30px ">
				<h5 class="white-text">Browse Categories</h5>
				<ul class="footer-list">
					<li><a class="grey-text text-lighten-3" href="#">Clubs and communities</a></li>
					<li><a class="grey-text text-lighten-3" href="#">Environment</a></li>
					<li><a class="grey-text text-lighten-3" href="#">Hunger</a></li>
					<li><a class="grey-text text-lighten-3" href="#">Poverty</a></li>
					<li><a class="grey-text text-lighten-3" href="#">Animals</a></li>
				</ul>
			</div>

			<div class="col l3" style="text-align: left; line-height: 30px">
				<h5 class="white-text">Customer Service</h5>
				<ul class="footer-list">
					<li><a class="grey-text text-lighten-3" href="#">Help & FAQS</a></li>
					<li><a class="grey-text text-lighten-3" href="#">Terms of Service</a></li>
					<li><a class="grey-text text-lighten-3" href="#">Privacy Policy</a></li>
					<li><a class="grey-text text-lighten-3" href="#">Contact Us</a></li>
					<li><a class="grey-text text-lighten-3" href="#">Site Map</a></li>
				</ul>
			</div>


		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">© 2018 Copyright</div>
	</div>
</footer>

</html>
<!DOCTYPE html>
<html>
<head>
	<title>organisationProfile</title>
<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="assets/js/materialize.min.js"></script>

<style>
#contents{
	margin-top:1%;
}
#following{
	/*border:solid;
    border-width: 2px;*/
}
#bio{
	/*border:solid;
	border-width: 2px;*/
}
#navigation-profile{
	position:static;
}
#top-part{
	position:static;
	/*border:solid;
	border-width: 2px;*/

}
#banner-image{
	width : 100%;
	height: 100%;
	object-fit: cover;
}
#banner{
	position: relative;
	width: 100%;
	height: 250px;
	background: black;
	z-index:1;
}
#org-img{
	object-fit:cover;
	width:100px;
	height:100px;
	border:solid;
	border-radius: 100px;
	border-color: white;
}
#profile-picture{
	position: relative;
	width:200px;
	height:200px;
	margin-top:-100px;	
	margin-bottom:-100px;
	display:block;
	margin-right: auto;
	margin-left: 10%;
	border:solid;
	border-radius: 150px;
	border-color: white;
	z-index:2;
	}

* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

.container {
  width: 80% !important;

}
/* Style the tab */
.tab {
    float: left;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 30%;
    height: 835px;
}

/* Style the buttons inside the tab */
.tab button {
    display: block;
    background-color: inherit;
    color: black;
    padding: 22px 16px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    float: left;
    padding: 0px 12px;
    border: 1px solid #ccc;
    width: 70%;
    border-left: none;
    height: 835px;
    
}

#textarea1 {
    overflow-y: scroll; 
    height: 150px !important;
    border: 1px solid;
    resize: none; /* Remove this if you want the user to resize the textarea */
}

.circle {
  width: 100px;
  height: 100px
}

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
</head>

<body style="background-color:  #eeeeee">
		<!-- Nav Bar -->
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper  amber darken-3">
				
				
				<a href="#" class="brand-logo" style="margin-left: 10px">Logo</a>
				<ul class="left hide-on-med-and-down" style="margin-left: 100px">	
					<li class="active"><a href="index.html">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="feed.php">Feed</a></li>
					<li><a href="explore.html">Explore</a></li>
				</ul>
				
				<ul class="right hide-on-med-and-down">
					<li><a href="#">Login / Sign Up</a></li>
				</ul>
			</div>
		</nav>
	</div>

	<div id ="banner" >
		 <img src="banner.jpg" alt="" id = "banner-image">
	</div>
	<div id = "profile-picture">
		<img src="wtf.png" alt="" id = "banner-image" class = "circle responsive-img">	
	</div>

	<!-- 
		<div class="navbar-static" id = "navigation-profile">
			<nav>
				<div class="nav-wrapper" >

					<ul  class="tabs " style="margin-left: 350px;height: 100%;width: 100% ">
						<li class="tab col s3"><a href="#timeline" class="active">Timeline</a></li>
						<li class="tab col s3"><a href="#">Following</a></li>
						<li class="tab col s3"><a href="#">Edit Profile</a></li>
						<li class="tab col s3"><a href="#">Stats</a></li>
					</ul>
					
				</div>
		    </nav>
		</div> -->
	<div class="row" style="padding: 0px; margin-bottom: 50px">
		<div class="col s12 " style=" padding: 0px;">
			<ul  class="tabs" style="margin-left: 350px;height: 100%;width: auto;">
					<li class="tab col s3" style=""><a class="active" href="#timeline" >Timeline</a></li>
					<li class="tab col s3"><a href="#following">Following</a></li>
					<li class="tab col s3"><a href="#editProfile">Edit Profile</a></li>
					<li class="tab col s3"><a href="#stats">Stats</a></li>
			</ul>
		</div>
	</div>	


    <div class="row" id ="contents" >
		<div class="container" style = "width:80%;">
	    	<div id="timeline" class="col s12">
			    <div id="bio" class="col s4">
			    	<div class="card-panel grey lighten-5 z-depth-1">
			    	<h4>My Name Jeffffff</h4>
			    	<h5>About me</h5>
			    	<p>I like thick boiis<br>Donate to charity with prostitution money<br>Favourite Quote:<br> "Feed Hoes Instead of Fucking Them"</p> 	
			    	</div>
			    </div>
			    <div class="col s8">
			    	
			    		
		     		   <div class="card-panel grey lighten-5 z-depth-1">
		        		  <div class="row valign-wrapper">
		           		 
		           		   <span class="black-text">
		           		   	  <p><b>Title</b><br>Date<p>
		             		  I like to orem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ornare tincidunt nulla a elementum. Donec venenatis vel felis eget sollicitudin. Integer sit amet ipsum sed urna pretium accumsan. Maecenas ullamcorper gravida est sit amet fringilla. Aenean feugiat dictum elit, non finibus nisi egestas nec. Phasellus in lacus non enim hendrerit pellentesque a a magna. Cras non bibendum ex. Sed pharetra ultricies porttitor. Quisque eu venenatis turpis. In hac habitasse platea dictumst. Praesent molestie lorem nulla, nec tincidunt nibh sodales vehicula. Aenean eu ipsum vestibulum, congue ipsum sit amet, bibendum sem.
		           		   </span>
		         		  
		         		 </div>
		       		 </div>
		       		 <div class="card-panel grey lighten-5 z-depth-1">
		        		  <div class="row valign-wrapper">
		           		 
		           		   <span class="black-text">
		           		   	   <p><b>Title</b><br>Date<p>
		             		   I like to orem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ornare tincidunt nulla a elementum. Donec venenatis vel felis eget sollicitudin. Integer sit amet ipsum sed urna pretium accumsan. Maecenas ullamcorper gravida est sit amet fringilla. Aenean feugiat dictum elit, non finibus nisi egestas nec. Phasellus in lacus non enim hendrerit pellentesque a a magna. Cras non bibendum ex. Sed pharetra ultricies porttitor. Quisque eu venenatis turpis. In hac habitasse platea dictumst. Praesent molestie lorem nulla, nec tincidunt nibh sodales vehicula. Aenean eu ipsum vestibulum, congue ipsum sit amet, bibendum sem.
		           		   </span>
		         		   </div>
		         		
		       		 </div>
			  
			    </div>	
			</div>

			<div id="following" class="col s12">
				<div class="card-panel grey lighten-5 z-depth-1">
	        		  <div class="row valign-wrapper">
	           		 <div class="col s2">
	          		    <img src="wtf.png" id="org-img"alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
	         		   </div>
	         		   <div class="col s10">
	           		   <span class="black-text">
	             		   Random organisation
	           		   </span>
	         		   </div>
	         		 </div>
	       		 </div>
	       		 <div class="card-panel grey lighten-5 z-depth-1">
	        		  <div class="row valign-wrapper">
	           		 <div class="col s2">
	          		    <img src="wtf.png" id="org-img"alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
	         		   </div>
	         		   <div class="col s10">
	           		   <span class="black-text">
	             		   Random organisation
	           		   </span>
	         		   </div>
	         		 </div>
	       		 </div>
	       		 <div class="card-panel grey lighten-5 z-depth-1">
	        		  <div class="row valign-wrapper">
	           		 <div class="col s2">
	          		    <img src="wtf.png" id="org-img"alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
	         		   </div>
	         		   <div class="col s10">
	           		   <span class="black-text">
	             		   Random organisation
	           		   </span>
	         		   </div>
	         		 </div>
	       		 </div>
			</div>	

			<div id="editProfile" class="col s12">
				<div class="container ">
				    <div class="row" style="margin-top: 10px">
				      <div class="col s12">
				        <div class="tab" style="background-color: white;">
				          <button class="tablinks" onclick="openCity(event, 'updateProfile')" id="defaultOpen">Edit Profile</button>
				          <button class="tablinks" onclick="openCity(event, 'updatePassword')">Edit Password</button>
				          <button class="tablinks" onclick="openCity(event, 'updateAccount')">Edit Bank Account</button>
				        </div>


				        <div id="updateProfile" class="tabcontent" style="background-color:white; padding-bottom: 10px; padding: 10px">

				          <form>
				            <h5 style="margin-left: 10px; font-weight: bold">Edit Profile</h5>
				            <hr>
				            <div class="center-align">
				              <img src="images/donator.png" class="circle">
				              <p>Name</p>
				              <a class="waves-effect waves-light btn-small" style="margin-bottom: 20px">Edit Avatar</a>

				            </div>
				              
				              <div class="col s12 input-field" style="margin-bottom: 30px;">
				                <i class="material-icons prefix">account_circle</i>
				                <input id="first_name" type="text" class="validate">
				                <label for="first_name">Organisation Name</label>
				            
				            </div>

				            <div class="input-field col s12">
				            	<div style="margin-bottom: -20px">
				              		<i class="material-icons prefix">email</i>
				                    <input id="email" type="email" class="validate">
				                    <label for="email">Email</label>
				                    <span class="helper-text" data-error="wrong input" data-success="correct"></span>
				                </div>
				            </div>
				            <div class="input-field col s12">
				            	<i class="material-icons prefix">phone</i>
				                <input id="icon_telephone" type="tel" class="validate">
			                    <label for="icon_telephone">Contact No</label>
			                </div>

		                  	<div class="input-field col s12">
		                    	<textarea id="textarea1" class="materialize-textarea"></textarea>
		                    	<label for="textarea1" style="margin-left: 10px">About Us</label>
		                  	</div>

			                <div class="col s12" >
			                  <button class="btn-small waves-effect waves-light " type="submit" name="action" style="float: right;">
			                  Update<i class="material-icons right">send</i>
			                  </button>

			                  <a class="waves-effect waves-light btn-small" style="float: right; margin-right: 10px; ">Cancel</a>

			                </div>
				          </form>

				        </div>

				        <div id="updatePassword" class="tabcontent" style="background-color: white; padding: 10px">
				          <form>
				            <h5 style="font-weight: bold; margin-left: 10px">Edit Password</h5>
				            <hr>
				            <div class="input-field col s12">
				              <i class="material-icons prefix">lock</i>
				                <input id="Old password" type="password" class="validate">
				                <label for="Old password">Old Password</label>
				            </div>

				            <div class="input-field col s6">
				                <i class="material-icons prefix">vpn_key</i>
				                <input id="New password" type="password" class="validate">
				                <label for="New password">New Password</label>
				            </div>

				            <div class="input-field col s6">
				              <input id="Confirm password" type="password" class="validate">
				              <label for="Confirm password">Confirm Password</label>
				            </div>

				             <div class="col s12" >
				                  <button class="btn-small waves-effect waves-light " type="submit" name="action" style="float: right">
				                  Update<i class="material-icons right">send</i>
				                  </button>

				                  <a class="waves-effect waves-light btn-small" style="float: right; margin-right: 10px">Cancel</a>

				                </div>
				          </form>
				        </div>

				        <div id="updateAccount" class="tabcontent" style="background-color:white; padding-bottom: 10px; padding: 10px">
				          
				          <div class="col s12">
				            <h5 style="font-weight: bold">Add a Bank Account</h5>
				            <hr>
				          </div>

				          <div class="input-field col s12">
				            
				            <select class="browser-default">
				              <option value="" disabled selected>Country</option>
				              <option value="1">Option 1</option>
				              <option value="2">Option 2</option>
				              <option value="3">Option 3</option>
				            </select> 

				          </div>


				             <div class="col s12 input-field" style="margin-bottom: 30px;">
				                <i class="material-icons prefix">account_circle</i>
				                <input id="first_name" type="text" class="validate">
				                <label for="first_name">Bank Name</label>
				            </div>

				             <div class="col s12 input-field" style="margin-bottom: 30px;">
				                <i class="material-icons prefix">account_circle</i>
				                <input id="first_name" type="text" class="validate">
				                <label for="first_name">Account Name</label>
				            </div>

				            <div class="col s12 input-field" style="margin-bottom: 30px;">
				                <i class="material-icons prefix">account_circle</i>
				                <input id="first_name" type="text" class="validate">
				                <label for="first_name">Account Number</label>
				            </div>

				         </div>
				      </div>
				    </div>
				</div>
			</div>

			<div id="stats" >
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

							<li class="collection-item" style="height: 350px">
								
									<canvas id ="myChart" height="200" width="400"></canvas>
									<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
									<script src="myCharts.js"></script>
								
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript">
		function openCity(evt, cityName) {
    		var i, tabcontent, tablinks;
    		tabcontent = document.getElementsByClassName("tabcontent");
    		for (i = 0; i < tabcontent.length; i++) {
        		tabcontent[i].style.display = "none";
    		}
    		tablinks = document.getElementsByClassName("tablinks");
    		for (i = 0; i < tablinks.length; i++) {
        		tablinks[i].className = tablinks[i].className.replace(" active", "");
    		}
    		document.getElementById(cityName).style.display = "block";
    		evt.currentTarget.className += " active";
		}


		//var instance = M.Tabs.init(el, options);
		// Or with jQuery

    	$(document).ready(function(){
    	$('.tabs').tabs();
    	$('.dropdown-trigger').dropdown();
    	// Get the element with id="defaultOpen" and click on it
		document.getElementById("defaultOpen").click();
    	});

  	</script>
</body>
<!-- <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card-panel grey lighten-5 z-depth-1">
          <div class="row valign-wrapper">
            <div class="col s2">
              <img src="images/yuna.jpg" alt="" class="circle responsive-img"> notice the "circle" class
            </div>
            <div class="col s10">
              <span class="black-text">
                This is a square image. Add the "circle" class to it to make it appear circular.
              </span>
            </div>
          </div>
        </div>
</div> -->
<footer class="page-footer amber darken-3" style="position:relative; bottom: 0">
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

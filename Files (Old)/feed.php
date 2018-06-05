<!DOCTYPE html>
<head>
  <title>Feed</title>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="assets/js/materialize.min.js"></script>

<style type="text/css">

.container {
  margin: 0 auto;
  max-width: 1280px;
  width: 80%;
}

 .tabs .tab a{
            color:#000;
        } /*Black color to the text*/

        .tabs .tab a:hover {
            background-color:#81c784;
            color:#000;
        } /*Text color on hover*/

        .tabs .tab a.active {
            background-color:green;
            color:#000;
        } /*Background and text color when a tab is active*/

        .tabs .indicator {
            background-color:#ff3d00 ;
        } /*Color of underline*/
}

.avatar {
	size: 100px
}

.collection .collection-item img.circle{
	
	width: 70px !important;
	height: 70px !important
}

.btn-group {
  width: 100%;
}

.btn-group button {
    background-color: #ffffff; /* Green background */
    border: 1px; /* Green border */
    color: grey; /* White text */
    padding: 10px 24px; /* Some padding */
    cursor: pointer; /* Pointer/hand icon */
    float: left; /* Float the buttons side by side */
    width:33.3%; 
    outline: 1px solid #e0e0e0
}

/* Clear floats (clearfix hack) */
.btn-group:after {
    content: "";
    clear: both;
    display: table;
}

.btn-group button:not(:last-child) {
    border-right: none; /* Prevent double borders */
}

/* Add a background color on hover */
.btn-group button:hover {
    background-color: #f5f5f5;
}

.textbox {
	word-wrap: break-word;
}

.collection > img {
  max-height: 100%;
  max-width: 100%;
  width: 100%;
  height: 100%;
}

.collapsible-header{
  float: left;
}

.feedImage {
  max-width: 100%; 
  max-height: 100%; 
  width: 100%; 
  height: 100%;
}

.recentlyViewed > ul> li > div > img {
  width: 60px; 
  height: 60px;

}

.aside-content {
  background-color: #FFF;
  float: left;
  margin: 10px;
  margin-left: 0px;
  width: 65%;
   

  
}

.aside-content > p {
  background-color: #afafaf;  
  color: #FFF;
  padding: 5px;

  
  margin-top: 0px;
  margin-bottom: 2px;
  font-weight: 500
}

</style>

</head>

<body style="background-color: #eeeeee">
	
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

	
		<!--Tab-->
		
  <div class="row" style="padding: 0px; margin-bottom: 50px;">
		<div class="col s12 center-align" style="outline: 2px solid; padding: 0px;">
			<ul class="tabs green" style="position: fixed; z-index: 1; width: 100%">
      	<li class="tab col s3"><a class="active" href="#test1">Global</a></li>
    		<li class="tab col s3"><a href="#test2">Following</a></li>
    	</ul>
  	</div>
  </div>	
  
  <!--GLobal & Following Display-->
  <div class="container" >
    <div class="row">
       <div id ="test1" class="col s9">
          <ul class="collection" style="background-color: white">
            <li class="collection-item avatar">
              <img src="images/sample-1.jpg" alt="profile image" class="circle">
              <h5 style="margin-top: 10px; margin-left: 20px">Organisation Name</h5>
              <p style="color: grey; margin-left: 23px">Date: 20-MAY-2018</p>
            </li>

            <li>
               <p>post</p>
            </li>
          </ul>

          <ul class="collection" style="background-color: white">
        	  <li class="collection-item avatar">
        			<img src="images/sample-1.jpg" alt="profile image" class="circle">
      				<h5 style="margin-top: 10px; margin-left: 20px">Organisation Name</h5>
              <p style="color: grey; margin-left: 23px">Date: 20-MAY-2018</p>
      		  </li>
        		
            <li >
        			<p class="textbox" style="padding: 10px; margin: 20px">Post any status or pictures regarding to any campaign being carried out by organisation i ruaeuruh grquhp giquhrp ighripu gqpruqhpgq rughpqeriughqperughqrpeiguhpreuhg pqerhgpq eruhg pqu rhgpoeqrhgpoq eirhoi uhp h ihhp op hponavopidjv napoinjaodinvjaodvn jadjonv adnjoanjvio pdnjopasn dvoas pvo jsanpddapioi uahvriorvh aioauhviu hgiug haorighua rehgoiguhaogh oaughaoig  haoighaorihua</p>
        		</li>
        		
            <li>
        			<p style="margin: 20px; outline: 2px solid; height: 400px">
        			<img src="images/sample-1.jpg" class="feedImage">
      				</p>
    				</li>
            
            <li class="collection-item" style="padding: 0px">
      				<div class="btn-group">
  						  <button ><i class="material-icons right">cloud</i>Pledge</button>
  	   				  <button ><i class="material-icons right">comment</i>Comment</button>
  						  <button ><i class="material-icons right">cloud</i>Donate</button>
							</div>
        		</li>
        	</ul>

      		<ul class="collection" style="background-color: white">
        		<li class="collection-item avatar">
               <img src="images/sample-2.jpg" alt="profile image" class="circle">
      			   <h4 style="margin-top: 10px; padding-left: 20px">Organisation Name</h4>
               <p style="color: grey; margin-left: 23px">Date: 20-MAY-2018</p>
      			</li>
        		
            <li >
        			<p class="textbox" style="padding: 10px; margin: 20px">Post any status or pictures regarding to any campaign being carried out by organisation i ruaeuruh grquhp giquhrp ighripu gqpruqhpgq rughpqeriughqperughqrpeiguhpreuhg pqerhgpq eruhg pqu rhgpoeqrhgpoq eirhoi uhp h ihhp op hponavopidjv napoinjaodinvjaodvn jadjonv adnjoanjvio pdnjopasn dvoas pvo jsanpddapioi uahvriorvh aioauhviu hgiug haorighua rehgoiguhaogh oaughaoig  haoighaorihua
              </p>
        		</li>
            
            <li>    
              <p style="margin: 20px; outline: 2px solid; height: 400px">
              <img src="images/tigerEvent.jpg" class="feedImage">
              </p>
            </li>
        				
        		<li class="collection-item" style="padding: 0px">
              <div class="btn-group">
                <button><i class="material-icons right">cloud</i>Pledge</button>
                <button><i class="material-icons right">comment</i>Comment</button>
                <button><i class="material-icons right">cloud</i>Donate</button>
              </div>
            </li>
        	</ul>     			
   		  </div>

        <div id ="test2" class="col s9">
			 
        </div>
   		<!--Right Aside-->
			
      <div class="col s3 center-align" style="padding: 0px;">
        <div style="position: fixed;">
          <div class="aside-content">
            <p>Useful Links</p>
            <ul>
              <li>wwf.com.org</li>
              <li>aspca.com.org</li>
              <li>UNICEF.com.org</li>
            </ul>
          </div>
             
          <div class="aside-content">
            <p>Recent News</p>
            <ul>
              <li>Charity for tigers reaches 100% charity funds!</li>
            </ul>
          </div>
          
          
          <div class="aside-content" style="margin-bottom: 20px">            
            <p>Recently Viewed</p>
            
            <div class="recentlyViewed" style="overflow-y:scroll; height: 180px;">
              <ul class="collection" style="background-color: white">
                <li class="collection-item avatar">
                  <img src="images/sample-1.jpg" alt="profile image" class="circle">
                  <h6 style="margin-top: 10px; margin-left: 20px">Organisation Name</h6>
                </li>

                 <li class="collection-item avatar">
                  <img src="images/traffickingEvent.jpg" alt="profile image" class="circle">
                  <h6 style="margin-top: 10px; margin-left: 20px">Organisation Name</h6>
                </li>

                 <li class="collection-item avatar">
                  <img src="images/tigerEvent.jpg" alt="profile image" class="circle">
                  <h6 style="margin-top: 10px; margin-left: 20px">Organisation Name</h6>
                </li>
              </ul>
            </div>
          </div>
    	  </div>
			</div>
    </div>
	</div>	
   


	<script type="text/javascript">
	//var instance = M.Tabs.init(el, options);
	// Or with jQuery

    $(document).ready(function(){
    $('.tabs').tabs();

    });

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

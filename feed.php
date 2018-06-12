<?php
session_start();

$root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/includes/dbh.inc.php');

require($root_dir . '/fragments/head.php');
require($root_dir . '/fragments/navbar.php');
require($root_dir . '/fragments/sidebar.php');
require($root_dir . '/components/event_event.php');

render_head("Feed");
render_navbar("Feed");
?>

<link rel="stylesheet" href="assets/css/feed.css">

<!--Global and Following Tab -->
<div class="row" style="padding: 0px; margin-bottom: 50px;">
	<div class="col s12 center-align" style="outline: 2px solid; padding: 0px;">
		<ul class="tabs green" style="position: fixed; z-index: 1; width: 100%">
  			<li class="tab col s3"><a class="active" href="#test1">Global</a></li>
			<li class="tab col s3"><a href="#test2">Following</a></li>
		</ul>
	</div>
</div>

<!--Events and Post Display-->
<div class="container" >
	<div class="row">
	   	<div id ="test1" class="col s9">
	   		<?php
				$id = 0;
				$imgs = array(
					"assets/img/sample-2.jpg",
					"assets/img/sample-5.jpg",
					"assets/img/tigerEvent.jpg",
					"assets/img/tigerEvent.jpg",
					"assets/img/sample-1.jpg"
				);
			?>			
			
			<?php
				foreach ($imgs as $img) {
					$url = "#";
					$orgName = "Organisation Name";
					$desc = "Description";
					$date = "26-January-1997";

					render_events_event($id, $url, $img, $date, $desc, $orgName, $img);

					$id++;								
				}
			?>   			
		
		</div>

		<div id="test2" class="col s9">
			<H1>Following</H1>
		</div>

		<div>
			<?php render_sidebar();?>
		</div>
	</div>
</div>
        
<script type="text/javascript">
 	$(document).ready(function(){
    $('.tabs').tabs();
  });
     
</script> 

<?php
require($root_dir . '/fragments/footer.php');
       
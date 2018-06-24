<footer class="page-footer teal darken-2" style="margin-top: 0px; bottom: 0">
	<div class="container" style="width: 90%">
		<div class="row" ">
			<div class="col l3 " style="line-height: ">
				<img src="assets/icons/favicon.ico" style="height: 80px; width: 80px" alt="">
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
					<?php

					$categories = Database::getCategories();

					foreach ($categories as $category) {
						echo "<li><a class='grey-text text-lighten-3' href='explore.php'>$category</a></li>";
					}
					?>
				</ul>
			</div>

			<div class="col l3" style="text-align: left; line-height: 30px">
				<h5 class="white-text">Customer Service</h5>
				<ul class="footer-list">
					<li><a class="grey-text text-lighten-3" href="#">Contact Us at (017-3403044)</a></li>
					<li><a class="grey-text text-lighten-3" href="index.php?page=terms-of-service">Terms of Service</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="footer-copyright" style="padding-left: 5%">© 2018 Copyright</div>
</footer>
</body>
</html>
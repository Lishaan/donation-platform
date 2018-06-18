<?php $root_dir = $_SERVER["DOCUMENT_ROOT"];

class Event {
	private $id;
	private $poster_user;
	private $posted_at;
	private $likes;
	private $title;
	private $body;

	private $fundsNeeded;
	private $fundsGathered;
	private $total_donations;

	public function __construct(int $id) {
		$connection = Database::getConnection();
		$sql = "SELECT * FROM events WHERE id=$id";
		$result = mysqli_query($connection, $sql);
		$connection->close();

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$this->id = $row['id'];
			$this->poster_user = new User((int) $row['poster_user_id']);
			$this->posted_at = $row['posted_at'];
			$this->likes = $row['likes'];
			$this->title = $row['title'];
			$this->body = $row['body'];
			$this->fundsNeeded = $row['fundsNeeded'];
			$this->fundsGathered = $this->getFundsGathered();		
			$this->total_donations = $this->getTotalDonations();
		} else {
			die("Event unable to construct");
		}
	}

	public function render(User $user, User $active_user, $goback = "") {
		$event_id = $this->id;
		$title = $this->title;
		$body = htmlspecialchars($this->body);
		$date = date("jS F, Y", strtotime($this->posted_at));
		$time = date("g:ia", strtotime($this->posted_at));
		$total_donations = $this->total_donations;

		$poster_user_id = $this->poster_user->getID();
		$poster_user_name = $this->poster_user->getName();

		$fundsNeeded = $this->fundsNeeded;
		$fundsGathered = $this->fundsGathered;

		$like_button = Event::getLikeButton($user->getID(), $active_user->getID(), $event_id, $this->likes, $goback);
		$donate_button = Event::getDonateButton($user->getID(), $active_user->getID(), $event_id, $this->poster_user, $goback);
		$comment_button = $this->getCommentButton($user->getID(), $goback);

		$comments = $this->getComments();
		$comments_count = count($comments);

		$active_user_id = $active_user->getID();

		$event_url = "http://$_SERVER[HTTP_HOST]/event.php?event_id=$event_id";
		$uniqueID = "$event_id$poster_user_id" . Database::getRandomID();

		// Render Event
		echo ("
			<div class='row'>
				<div class='white z-depth-2' style='position: relative; padding: 30px; margin: 0 10px 30px 10px'>
		");
		
		if ($poster_user_id === $active_user->getID() and empty($goback)) {
			echo ("
					<!-- Delete Floating Button -->
					<ul id='dropdown$uniqueID' class='dropdown-content' style='left: 100%; top: 0;'>
						<div style='margin: 5px'>
							</form>
							<!-- Modal Trigger -->
							<button class='waves-effect waves-light btn modal-trigger' href='#event_url_modal$uniqueID'>
								Share<i class='material-icons right'>send</i>
							</button>
						</div>
						<div style='margin: 5px'>
							<form action='profile.php?user_id=$active_user_id&delete_event_id=$event_id' method='POST'>
							<button class='btn waves-effect waves-light btn' type='submit' name='delete_event'>
								Delete<i class='material-icons right'>send</i>
							</button>
						</div>
					</ul>

					<!-- Modal Structure -->
					<div id='event_url_modal$uniqueID' class='modal'>
						<div class='modal-content'>
							<h4>Share Event</h4>
							<p>
								<div class='input-field col s12'>
									<input disabled value='$event_url' type='text'>
									<label for='name'>Copy Event Url</label>
								</div>
							</p>
						</div>
						<div class='modal-footer'>
							<a href='' class='modal-close waves-effect waves-green btn-flat'>Close</a>
						</div>
					</div>

					<button style='position: absolute; margin-left: 85%;' class='dropdown-trigger white btn-floating' data-target='dropdown$uniqueID'>
						<i class='black-text material-icons'>more_vert</i>
					</button>
			");

		} else {
			echo ("
					<!-- Delete Floating Button -->
					<ul id='dropdown$uniqueID' class='dropdown-content' style='left: 100%; top: 0;'>
						<div style='margin: 5px'>
							</form>
							<!-- Modal Trigger -->
							<button class='waves-effect waves-light btn modal-trigger' href='#event_url_modal$uniqueID'>
								Share<i class='material-icons right'>send</i>
							</button>
						</div>
					</ul>

					<!-- Modal Structure -->
					<div id='event_url_modal$uniqueID' class='modal'>
						<div class='modal-content'>
							<h4>Share Event</h4>
							<p>
								<div class='input-field col s12'>
									<input disabled value='$event_url' type='text'>
									<label for='name'>Copy Event Url</label>
								</div>
							</p>
						</div>
						<div class='modal-footer'>
							<a href='' class='modal-close waves-effect waves-green btn-flat'>Close</a>
						</div>
					</div>

					<button style='position: absolute; margin-left: 85%;' class='dropdown-trigger white btn-floating' data-target='dropdown$uniqueID'>
						<i class='black-text material-icons'>more_vert</i>
					</button>
			");
		}

		$profile_picture_directory = $this->poster_user->getProfilePictureDirectory();

		$image_style = "style='
			height: 55px;
			width: 55px;
			border: 1px solid #004d40;
			border-radius: 50%;
			float: left;
			margin: 0 20px 0 0;
			padding: 0.2px;

			user-drag: none; 
			user-select: none;
			-moz-user-select: none;
			-webkit-user-drag: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		'";

		$profile_url = "href='profile.php?user_id=$poster_user_id'";

		$p_style = "style='
			margin: 0;
			padding: 0;
			font-size: 10pt;
		'";

		$a_options = "
			href='event.php?event_id=$event_id' 
			style='color: inherit;'
		";
		
		echo ("
					<!-- Event -->
					<span class='black-text'>
						<div>
							<a style='color: inherit;' $profile_url>
								<img $profile_url src='$profile_picture_directory' $image_style alt='profile_picture' id='banner-image' class='circle responsive-img'>
							</a>
							<h5>
								<a style='color: inherit;' $profile_url><b>Event by $poster_user_name</b></a>
							</h5>
						</div>
						<div style='margin-top: 10px'>
							<p $p_style>
								<a $a_options>
									<b>Posted at: </b><text style='color: #90949c'>$date at $time</text>
								</a>
							</p>
						</div>
						$like_button
						<div class='z-depth-1' style='margin: 20px 0 20px 0; padding: 10px 20px 10px 20px'>
							<p style='font-size: 14pt; line-height: 5px;'><b>$title</b></p>
							<p>$body</p>
						</div>
						<div class='z-depth-1' style='padding: 10px 20px 10px 20px; margin: 20px 0 20px 0'>
							<p>Total Donations: $total_donations</p>
							<p>Funds Needed: RM$fundsNeeded</p>
							<p>Funds Gathered: RM$fundsGathered</p>
							<div class='center'>$donate_button</div>
						</div>
					</span>

					<!-- Comment section-->
					<ul class='collapsible'>
						<li>
							<div class='collapsible-header'><i class='material-icons'>comment</i>Comment section ($comments_count comments)</div>
							<div class='collapsible-body'>

		");

		foreach ($comments as $comment) {
			$comment->render();
		}
		
		if (empty($comments)) {
			echo ("
								<div class='row'>
									<div class='white z-depth-1' style='padding: 20px; margin: 20px 20px 0px 20px;border-radius: 20px;'>
										<div class='center black-text' style='word-wrap: break-word;'>
											<span>
												<p>No comments.</p>
											</span>
										</div>
									</div>
								</div>
			");
		}
		echo("
							</div>
						</li>
					</ul>
					$comment_button
				</div>
			</div>
		");
	}

	public function getFundsGathered() {
		$connection = Database::getConnection();
		$sql = "SELECT * FROM events_donations WHERE event_id=" . $this->id;
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$total = 0;

		while ($row = mysqli_fetch_assoc($result)) {
			$total += (double) $row['donation_amount'];
		}

		return $total;
	}

	public function getTotalDonations() {
		$connection = Database::getConnection();
		$sql = "SELECT * FROM events_donations WHERE event_id=" . $this->id;
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$total = 0;

		while ($row = mysqli_fetch_assoc($result)) {
			$total++;
		}

		return $total;
	}

	public function getDonationsArray() {
		$connection = Database::getConnection();
		$event_id = $this->id;
		$sql = "SELECT * FROM events_donations WHERE event_id=$event_id ORDER BY donated_at DESC";
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$donations = array();

		while ($row = mysqli_fetch_assoc($result)) {
			array_push($donations, $row);
		}

		return $donations;
	}

	public function getComments() {
		$connection = Database::getConnection();
		$sql = sprintf("SELECT * FROM comments WHERE event_id=%d ORDER BY posted_at ASC", $this->id);
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$comments = array();

		while ($row = mysqli_fetch_assoc($result)) {
			array_push($comments, new Comment((int) $row['id'], (int) $this->id, false));
		}

		return $comments;
	}

	
	public function getCommentButton($user_id, $goback = "") {
		return sprintf("
			<div class='z-depth-1' style='margin-top: 40px;padding-bottom: 20px;'>
				<div style='padding: 40px'>
					<form action='profile.php?user_id=%d&event_id=%d&commented=success$goback' method='POST'>
						<div class='input-field'>
				          <textarea autocomplete='false' name='comment_body' id='comment_textarea' class='materialize-textarea' data-length='256'></textarea>
				          <label for='comment_textarea'>Your comment</label>
				        </div>

				        <button class='right btn waves-effect btn' type='submit' name='event_comment'>
						    <i class='material-icons left'>add_comment</i>Comment
						</button>
					</form>
				</div>
			</div>
		", $user_id, $this->id);
	}

	public static function getLikeButton($user_id, $liker_user_id, $event_id, $likes, $goback = "") {
		session_start();

		$style = "style='
			margin: 40px 20px 0 0; 
			float: right; 
			background-color: #e37375;
		'";


		$like_button = "
			<div style='margin-bottom: 20px;'> 
				<form action='profile.php?user_id=$user_id&event_id=$event_id$goback' method='POST'>
			        <button $style class='z-depth-2 btn teal accent-4 waves-effect' type='submit' name='like_event'>$likes
						<i style='border-radius: 10px;' class='material-icons right'>thumb_up</i>
					</button>
				</form>
			</div>
		";

		$like_button_disabled = "
			<div style='margin-bottom: 20px;'> 
				<form action='profile.php?user_id=$user_id&event_id=$event_id' method='POST'>
			        <button $style class='z-depth-2 btn waves-effect' type='submit' disabled>$likes
						<i style='border-radius: 10px;' class='material-icons right'>thumb_up</i>
					</button>
				</form>
			</div>
		";

		$unlike_button = "
			<div style='margin-bottom: 20px;'> 
				<form action='profile.php?user_id=$user_id&event_id=$event_id$goback' method='POST'>
			        <button $style class='z-depth-2 btn waves-effect' type='submit' name='like_event'>$likes
						<i style='border-radius: 10px;' class='material-icons right'>thumb_down</i>
					</button>
				</form>
			</div>
		";

		$connection = Database::getConnection();
		$sql = "SELECT * FROM events_likes WHERE event_id=$event_id AND user_id=$liker_user_id";
		$result = mysqli_query($connection, $sql);
		$connection->close();

		if (mysqli_num_rows($result) > 0) {
			$like_button = $unlike_button;
		}

		// if ($_SESSION['user_id'] === $user_id) {
		// 	$like_button = $like_button_disabled;
		// }

		return $like_button;
	}

	public static function getDonateButton($user_id, $donator_user_id, $event_id, $poster_user, $goback = "") {
		session_start();

		$poster_user_name = $poster_user->getName();

		return "
			<div style='margin-bottom: 20px;'> 
				<!-- Modal Trigger -->
		        <button href='#pledgeModal$user_id$donator_user_id$event_id' style='margin-top: 20px' class='z-depth-2 btn waves-effect modal-trigger' type='submit' name='like'>Donate Now
					<i style='border-radius: 10px;' class='material-icons right'>add_box</i>
				</button>

				<!-- Modal Structure -->
				<div id='pledgeModal$user_id$donator_user_id$event_id' class='modal'>
					<form action='profile.php?user_id=$user_id&event_id=$event_id&pledge=true$goback' method='POST'>
						<div class='modal-content'>
							<h4>Donate event</h4>
							<p style='margin-bottom: 40px;'>You are about to donate to the event posted by $poster_user_name.</p>
							<div class='input-field'>
						        <input placeholder = 'Enter donation amount' autocomplete='false'  name='donation_amount' id='event_funds_Needed' type='number' data-length='11'>
								<label for='input_text'>Amount</label>
					        </div>
						</div>
						<div class='modal-footer'>
							<button name='donate_button' class='modal-close waves-effect waves-green btn-flat'>Donate</button>
						</div>
					</form>
				</div>
			</div>
		";
	}

	public function getID() {
		return $this->id;
	}

	public function getPosterUser() {
		return $this->poster_user;
	}

	public static function exists($event) {
		$connection = Database::getConnection();
		$sql = sprintf("SELECT * FROM events WHERE id=%d", $event->getID());
		$result = mysqli_query($connection, $sql);
		$connection->close();

		return mysqli_num_rows($result) > 0;
	}
}
<?php $root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/classes/Database.php');
require($root_dir . '/classes/Comment.php');
require($root_dir . '/classes/Post.php');
require($root_dir . '/classes/Event.php');

class User {
	private $id;
	private $name;
	private $email;
	private $type;
	
	public function __construct(int $user_id) {
		$connection = Database::getConnection();
		$sql = "SELECT * FROM users WHERE id=$user_id";
		$result = mysqli_query($connection, $sql);
		$connection->close();

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);

			$this->id = $row['id'];
			$this->name = $row['name'];
			$this->email = $row['email'];
			$this->type = $row['type'];
		} else {
			if (!User::isLoggedIn()) {
				if (isset($_GET['user_id'])) {
					$this->__construct($_GET['user_id']);
				} else if (isset($_GET['event_id'])) {
					echo ("
						<script type='text/javascript'> 
							window.location.href='$_SERVER[REQUEST_URI]&login=required';
						</script>
					");
					echo "Dd";
				}
			} else {
				die("User unable to construct");
			}
		}
	}

	public function follow(User $user) {
		$connection = Database::getConnection();
		$sql = sprintf("INSERT INTO followers (user_id, follower_user_id, follow_date) VALUES (%d, %d, now())", $user->getID(), $this->id);
		mysqli_query($connection, $sql);
		$connection->close();

		$user_id = $user->getID();
		echo ("
			<script type='text/javascript'> 
			window.location.href='../profile.php?user_id=$user_id';
			</script>
			");
	}

	public function unfollow(User $user) {
		$connection = Database::getConnection();
		$sql = sprintf("DELETE FROM followers WHERE user_id=%d AND follower_user_id=%d", $user->getID(), $this->id);
		mysqli_query($connection, $sql);
		$connection->close();

		$user_id = $user->getID();
		echo ("
			<script type='text/javascript'> 
			window.location.href='../profile.php?user_id=$user_id';
			</script>
			");
	}

	public function getFollowersArray() {
		$connection = Database::getConnection();
		$sql = sprintf("SELECT * FROM followers WHERE user_id=%d ORDER BY follow_date DESC", $this->getID());
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$followers = array();

		while ($row = mysqli_fetch_assoc($result)) {
			array_push($followers, array($row['follower_user_id'], $row['follow_date']));
		}

		return $followers;
	}

	public function getPosts() {
		$connection = Database::getConnection();
		$sql = sprintf("SELECT * FROM posts WHERE poster_user_id=%d ORDER BY posted_at DESC", $this->getID());
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$posts = array();

		while ($row = mysqli_fetch_assoc($result)) {
			$post = new Post((int) $row['id']);

			array_push($posts, $post);
		}

		return $posts;
	}

	public function getPostsArray() {
		$connection = Database::getConnection();
		$sql = sprintf("SELECT * FROM posts WHERE poster_user_id=%d ORDER BY posted_at DESC", $this->getID());
		$result = mysqli_query($connection, $sql);

		$posts = array();

		while ($row = mysqli_fetch_assoc($result)) {
			array_push($posts, $row);
		}

		return $posts;
	}

	public function getEventsAndPosts() {
		$connection = Database::getConnection();
		$sql = sprintf("SELECT * FROM ( (SELECT id, poster_user_id, posted_at, NULL AS fundsNeeded FROM posts) UNION ALL (SELECT id, poster_user_id, posted_at, fundsNeeded FROM events) ) results WHERE poster_user_id=%d ORDER BY posted_at DESC", $this->getID());
		
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$eventsAndPosts = array();

		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['fundsNeeded']) {
				$event = new Event((int) $row['id']);
				array_push($eventsAndPosts, $event);

			} else {
				$post = new Post((int) $row['id']);
				array_push($eventsAndPosts, $post);
			}			
		}

		return $eventsAndPosts;
	}

	public function getEventsAndPostsFollowing() {
		$connection = Database::getConnection();
		$sql = sprintf("SELECT * FROM ((SELECT id, poster_user_id, posted_at, NULL AS fundsNeeded FROM posts) UNION ALL (SELECT id, poster_user_id, posted_at, fundsNeeded FROM events) ) results WHERE poster_user_id IN (SELECT user_id FROM followers WHERE follower_user_id= %d) ORDER BY posted_at DESC", $this->getID());

		$result = mysqli_query($connection, $sql);
		$connection->close();

		$eventsAndPosts = array();

		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['fundsNeeded']) {
				$event = new Event((int) $row['id']);
				array_push($eventsAndPosts, $event);

			} else {
				$post = new Post((int) $row['id']);
				array_push($eventsAndPosts, $post);
			}   
		}

		return $eventsAndPosts;
	}

	public function getEventsAndPostsGlobal() {
		$connection = Database::getConnection();
		$sql = sprintf("SELECT * FROM ( (SELECT id, poster_user_id, posted_at, NULL AS fundsNeeded FROM posts) UNION ALL (SELECT id, poster_user_id, posted_at, fundsNeeded FROM events) ) results ORDER BY posted_at DESC");

		$result = mysqli_query($connection, $sql);
		$connection->close();

		$eventsAndPosts = array();

		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['fundsNeeded']) {
				$event = new Event((int) $row['id']);
				array_push($eventsAndPosts, $event);

			} else {
				$post = new Post((int) $row['id']);
				array_push($eventsAndPosts, $post);
			}   
		}

		return $eventsAndPosts;
	}

	public function getEvents() {
		$connection = Database::getConnection();
		$sql = sprintf("SELECT * FROM events WHERE poster_user_id=%d ORDER BY posted_at DESC", $this->getID());
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$events = array();

		while ($row = mysqli_fetch_assoc($result)) {
			$event = new Event((int) $row['id']);

			array_push($events, $event);
		}

		return $events;
	}

	public function createPost(string $title, string $body) {
		$connection = Database::getConnection();
		$sql = sprintf("INSERT INTO posts (poster_user_id, posted_at, likes, title, body) VALUES (%d, now(), 0, '%s', '%s')", $this->id, mysqli_real_escape_string($connection, $title), mysqli_real_escape_string($connection, $body));
		mysqli_query($connection, $sql);
		$connection->close();

		$user_id = $this->id;
		echo ("
			<script type='text/javascript'> 
			window.location.href='../profile.php?user_id=$user_id&create_post=success';
			</script>
			");
	}

	public function deletePost(int $post_id) {
		$connection = Database::getConnection();
		$sql = "DELETE FROM comments WHERE post_id=$post_id";
		mysqli_query($connection, $sql);
		$sql = "DELETE FROM posts_likes WHERE post_id=$post_id";
		mysqli_query($connection, $sql);
		$sql = "DELETE FROM posts WHERE id=$post_id";
		mysqli_query($connection, $sql);

		$connection->close();

		$user_id = $this->id;
		echo ("
			<script type='text/javascript'> 
				window.location.href='../profile.php?user_id=$user_id&delete_post=success';
			</script>
		");
	}

	public function likePost(int $post_id) {
		if (isset($_SESSION['user_id'])) {
			$connection = Database::getConnection();
			$liker_user_id = $this->id;
			$sql = "SELECT * FROM posts_likes WHERE post_id=$post_id AND user_id=$liker_user_id";
			$result = mysqli_query($connection, $sql);

			if (mysqli_num_rows($result) <= 0) {
				$sql = "UPDATE posts SET likes=likes+1 WHERE id=" . $_GET['post_id'];
				mysqli_query($connection, $sql);

				$sql = "INSERT INTO posts_likes (post_id, user_id) VALUES ($post_id, $liker_user_id)";
				mysqli_query($connection, $sql);
			} else {
				$sql = "UPDATE posts SET likes=likes-1 WHERE id=" . $_GET['post_id'];
				mysqli_query($connection, $sql);

				$sql = "DELETE FROM posts_likes WHERE post_id=$post_id AND user_id=$liker_user_id";
				mysqli_query($connection, $sql);
			}
			$connection->close();
		} else {
			echo ("
				<script type='text/javascript'> 
					window.location.href='$_SERVER[REQUEST_URI]&login=required';
				</script>
			");
		}
	}

	public function commentPost(int $post_id, string $comment_body) {
		if (User::isLoggedIn() and !empty($comment_body)) {
			$connection = Database::getConnection();
			$commenter_user_id = $this->id;

			$sql = "SELECT * FROM posts WHERE id=$post_id";
			$result = mysqli_query($connection, $sql);

			if (mysqli_num_rows($result) > 0) {
				$sql = "INSERT INTO comments (post_id, commenter_user_id, comment_body, posted_at) VALUES ($post_id, $commenter_user_id, '$comment_body', now())";
				mysqli_query($connection, $sql);
			}
			$connection->close();
		} else {
			echo ("
				<script type='text/javascript'> 
					window.location.href='$_SERVER[REQUEST_URI]&login=required';
				</script>
			");
		}
	}

	public function createEvent(string $title, string $body, int $fundsNeeded, string $image_directory) {
		$connection = Database::getConnection();

		$poster_user_id = $this->id;
		$title = mysqli_real_escape_string($connection, $title);
		$fundsNeeded = mysqli_real_escape_string($connection, $fundsNeeded);

		$sql = "
			INSERT INTO events (image_directory, poster_user_id, posted_at, likes, title, body, fundsNeeded, fundsGathered) 
			VALUES ('$image_directory', $poster_user_id, now(), 0, '$title', '$body', $fundsNeeded, 0)
		";
		
		mysqli_query($connection, $sql);
		$connection->close();
		$user_id = $this->id;
		echo ("
			<script type='text/javascript'> 
			window.location.href='../profile.php?user_id=$user_id&create_event=success';
			</script>
		");
	}

	public function deleteEvent(int $event_id) {
		$connection = Database::getConnection();
		$sql = "DELETE FROM comments WHERE event_id=$event_id";
		mysqli_query($connection, $sql);
		$sql = "DELETE FROM events_likes WHERE event_id=$event_id";
		mysqli_query($connection, $sql);
		$sql = "DELETE FROM events_donations WHERE event_id=$event_id";
		mysqli_query($connection, $sql);
		$sql = "DELETE FROM events WHERE id=$event_id";
		mysqli_query($connection, $sql);

		$connection->close();

		$user_id = $this->id;
		echo ("
			<script type='text/javascript'> 
			window.location.href='../profile.php?user_id=$user_id&delete_event=success';
			</script>
			");
	}

	public function likeEvent(int $event_id) {
		if (isset($_SESSION['user_id'])) {
			$connection = Database::getConnection();
			$liker_user_id = $this->id;
			$sql = "SELECT * FROM events_likes WHERE event_id=$event_id AND user_id=$liker_user_id";
			$result = mysqli_query($connection, $sql);

			if (mysqli_num_rows($result) <= 0) {
				$sql = "UPDATE events SET likes=likes+1 WHERE id=" . $_GET['event_id'];
				mysqli_query($connection, $sql);

				$sql = "INSERT INTO events_likes (event_id, user_id) VALUES ($event_id, $liker_user_id)";
				mysqli_query($connection, $sql);
			} else {
				$sql = "UPDATE events SET likes=likes-1 WHERE id=" . $_GET['event_id'];
				mysqli_query($connection, $sql);

				$sql = "DELETE FROM events_likes WHERE event_id=$event_id AND user_id=$liker_user_id";
				mysqli_query($connection, $sql);
			}
			$connection->close();
		} else {
			$goback = "";

			if (isset($_GET['goback'])) {
				$goback = "&goback=" . $_GET['goback'];
			}

			if (isset($_GET['event_id'])) {
				$goback .= "&event_id=" . $_GET['event_id'];
			}
			echo ("
				<script type='text/javascript'> 
					window.location.href='$_SERVER[REQUEST_URI]';
				</script>
			");
		}
	}

	public function commentEvent(int $event_id, string $comment_body) {
		if (isset($_SESSION['user_id'])) {
			if (User::isLoggedIn() and !empty($comment_body)) {
				$connection = Database::getConnection();
				$commenter_user_id = $this->id;

				$sql = "SELECT * FROM events WHERE id=$event_id";
				$result = mysqli_query($connection, $sql);

				if (mysqli_num_rows($result) > 0) {
					$sql = "INSERT INTO comments (event_id, commenter_user_id, comment_body, posted_at) VALUES ($event_id, $commenter_user_id, '$comment_body', now())";
					mysqli_query($connection, $sql);
				}
				$connection->close();
			}
		} else {
			echo ("
				<script type='text/javascript'> 
					window.location.href='$_SERVER[REQUEST_URI]&login=required';
				</script>
			");
		}
	}

	public function donateEvent(int $event_id, float $donation_amount, int $user_id) {
		$connection = Database::getConnection();
		$donator_user_id = $this->id;

		$goback = "";

		if (isset($_GET['goback'])) {
			$goback = "&goback=" . $_GET['goback'];
		}

		if (isset($_GET['event_id'])) {
			$goback .= "&event_id=" . $_GET['event_id'];
		}


		if ($donation_amount > 0) {
			$sql = "INSERT INTO events_donations (event_id, donator_user_id, donation_amount, donated_at) VALUES ($event_id, $donator_user_id, $donation_amount, now())";
			mysqli_query($connection, $sql);

			$connection->close();
			echo ("
				<script type='text/javascript'> 
				window.location.href='../event.php?event_id=$event_id&donate_event=success$goback';
				</script>
				");
		} else {
			$connection->close();
			echo ("
				<script type='text/javascript'> 
				window.location.href='../event.php?event_id=$event_id&donate_event=failed$goback';
				</script>
			");
		}
	}

	public function getBioDesc() {
		if ($this->isDonator()) {
			$connection = Database::getConnection();
			$user_id = $this->id;
			$sql = "SELECT * FROM donators_info WHERE user_id=$user_id";
			$result = mysqli_query($connection, $sql);

			$row = mysqli_fetch_assoc($result);

			return $row['profile_bio'];

		} else {
			$connection = Database::getConnection();
			$user_id = $this->id;
			$sql = "SELECT * FROM organisations_info WHERE user_id=$user_id";
			$result = mysqli_query($connection, $sql);

			$row = mysqli_fetch_assoc($result);

			return $row['profile_description'];
		}
	}

	public function getCategory() {
		if (!$this->isDonator()) {
			$connection = Database::getConnection();
			$user_id = $this->id;
			$sql = "SELECT * FROM organisations_info WHERE user_id=$user_id";
			$result = mysqli_query($connection, $sql);

			$row = mysqli_fetch_assoc($result);

			return $row['category'];
		} else {
			return false;
		}
	}

	public function getProfilePictureDirectory() {
		if ($this->isDonator()) {
			$connection = Database::getConnection();
			$user_id = $this->id;
			$sql = "SELECT * FROM donators_info WHERE user_id=$user_id";
			$result = mysqli_query($connection, $sql);

			$row = mysqli_fetch_assoc($result);

			return $row['profile_picture_directory'];

		} else {
			$connection = Database::getConnection();
			$user_id = $this->id;
			$sql = "SELECT * FROM organisations_info WHERE user_id=$user_id";
			$result = mysqli_query($connection, $sql);

			$row = mysqli_fetch_assoc($result);

			return $row['profile_picture_directory'];
		}
	}

	public function getID() { return $this->id; }
	public function getName() { return $this->name; }
	public function getEmail() { return $this->email; }
	public function getType() { return $this->type; }

	public function isDonator() { return $this->type === "D" ? true : false; }

	public static function getOrganisations() {
		$connection = Database::getConnection();
		$sql = "SELECT * FROM users WHERE type='O'";
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$users = array();

		while ($row = mysqli_fetch_assoc($result)) {
			$user = new User((int) $row['id']);

			array_push($users, $user);
		}

		return $users;
	}
	
	public static function exists($user) {
		$connection = Database::getConnection();
		$sql = sprintf("SELECT * FROM users WHERE id=%d", $user->getID());
		$result = mysqli_query($connection, $sql);
		$connection->close();

		return mysqli_num_rows($result) > 0;
	}

	public static function isFollowing(User $user, User $follower_user) {
		session_start();

		if (isset($_SESSION['user_id'])) {
			$connection = Database::getConnection();
			$sql = sprintf("SELECT follower_user_id FROM followers WHERE follower_user_id=%d AND user_id=%d", $follower_user->getID(), $user->getID());
			$result = mysqli_query($connection, $sql);
			$connection->close();

			if (mysqli_num_rows($result) > 0) {
				return true;
			} else {
				return false;
			}
		} else if (!isset($_SESSION['user_id']) and isset($_GET['user_id'])) {
			return true;
		} else {
			die("Please login");
		}
	}

	public static function isLoggedIn() {
		if (isset($_SESSION['user_id'])) {
			return true;
		} else {
			return false;
		}
	}
}
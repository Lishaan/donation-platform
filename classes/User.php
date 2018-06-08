<?php $root_dir = $_SERVER["DOCUMENT_ROOT"];

require($root_dir . '/classes/Post.php');

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
			die("User unable to construct");
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
		$sql = sprintf("SELECT * FROM followers WHERE user_id=%d ORDER BY id DESC", $this->getID());
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
		$sql = "DELETE FROM comments WHERE post_id=$post_id AND commenter_user_id=" . $this->id;
		mysqli_query($connection, $sql);
		$sql = "DELETE FROM posts WHERE id=$post_id AND poster_user_id=" . $this->id;
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
	}

	public function getID() { return $this->id; }
	public function getName() { return $this->name; }
	public function getEmail() { return $this->email; }
	public function getType() { return $this->type; }

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
		} else {
			die("Please login");
		}
	}
}
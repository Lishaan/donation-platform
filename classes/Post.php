<?php $root_dir = $_SERVER["DOCUMENT_ROOT"];

class Post {
	private $id;
	private $poster_user;
	private $posted_at;
	private $likes;
	private $title;
	private $body;
	
	public function __construct(int $id) {
		$connection = Database::getConnection();
		$sql = "SELECT * FROM posts WHERE id=$id";
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
		} else {
			die("Post unable to construct");
		}
	}

	public function render(User $user, User $active_user, $goback = "") {
		$post_id = $this->id;
		$title = $this->title;
		$body = htmlspecialchars($this->body);
		$likes = $this->likes;
		$date = date("jS F, Y", strtotime($this->posted_at));
		$time = date("g:ia", strtotime($this->posted_at));

		$poster_user_id = $this->poster_user->getID();
		$poster_user_name = $this->poster_user->getName();

		$like_button = Post::getLikeButton($user->getID(), $active_user->getID(), $post_id, $likes, $goback);
		$comment_button = $this->getCommentButton($user->getID(), $goback);

		$comments = $this->getComments();
		$comments_count = count($comments);

		$active_user_id = $active_user->getID();

		// Render Post
		echo ("
			<div class='row'>
				<div class='white z-depth-2' style='position: relative; padding: 30px; margin: 0 10px 30px 10px'>
		");
		if ($poster_user_id === $active_user->getID() and empty($goback)) {
			echo ("
					<!-- Delete Floating Button -->
					<ul id='dropdown$post_id$poster_user_id' class='dropdown-content'>
						<form action='profile.php?user_id=$active_user_id&delete_post_id=$post_id' method='POST'>
							<button class='btn waves-effect waves-light btn' type='submit' name='delete_post'>
								Delete<i class='material-icons right'>send</i>
							</button>
						</form>
					</ul>
					
					<button style='position: absolute; margin-left: 85%;' class='dropdown-trigger white btn-floating' data-target='dropdown$post_id$poster_user_id'>
						<i class='black-text material-icons'>more_vert</i>
					</button>
			");
		}
		echo ("
					<!-- Post -->
					<span class='black-text'>
						<a style='color: inherit;' href='profile.php?user_id=$poster_user_id'>
							<h5 style='margin-top: 0'><b>$poster_user_name</b></h5>
						</a>
						<b>Posted at: </b><text style='color: #90949c'>$date at $time</text>
						$like_button
						<div class='z-depth-1' style='margin: 20px 0 20px 0; padding: 10px 20px 10px 20px'>
							<p style='font-size: 14pt; line-height: 5px;'><b>$title</b></p>
							<p>$body</p>
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

	public function getCommentsArray() {
		$connection = Database::getConnection();
		$sql = sprintf("SELECT * FROM comments WHERE post_id=%d ORDER BY posted_at ASC;", $this->id);
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$comments = array();

		while ($row = mysqli_fetch_assoc($result)) {
			array_push($comments, $row);
		}

		return $comments;
	}

	public function getComments() {
		$connection = Database::getConnection();
		$sql = sprintf("SELECT * FROM comments WHERE post_id=%d ORDER BY posted_at ASC", $this->id);
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$comments = array();

		while ($row = mysqli_fetch_assoc($result)) {
			array_push($comments, new Comment((int) $row['id'], (int) $this->id));
		}

		return $comments;
	}

	public function getCommentButton($user_id, $goback = "") {
		return sprintf("
			<div class='z-depth-1' style='margin-top: 40px;padding-bottom: 20px;'>
				<div style='padding: 40px'>
					<form action='profile.php?user_id=%d&post_id=%d&commented=success$goback' method='POST'>
						<div class='input-field'>
				          <textarea autocomplete='false' name='comment_body' id='comment_textarea' class='materialize-textarea' data-length='256'></textarea>
				          <label for='comment_textarea'>Your comment</label>
				        </div>

				        <button class='right btn waves-effect btn' type='submit' name='post_comment' id='comment_submit'>
						    <i class='material-icons left'>add_comment</i>Comment
						</button>
					</form>
				</div>
			</div>
		", $user_id, $this->id);
	}

	public static function getLikeButton($user_id, $liker_user_id, $post_id, $likes, $goback = "") {
		session_start();

		$like_button = "
			<div style='margin-bottom: 20px;'> 
				<form action='profile.php?user_id=$user_id&post_id=$post_id$goback' method='POST'>
			        <button style='margin-top: 20px' class='z-depth-2 btn waves-effect' type='submit' name='like_post'>$likes
						<i style='border-radius: 10px;' class='material-icons right'>thumb_up</i>
					</button>
				</form>
			</div>
		";

		$like_button_disabled = "
			<div style='margin-bottom: 20px;'> 
				<form action='profile.php?user_id=$user_id&post_id=$post_id' method='POST'>
			        <button style='margin-top: 20px' class='z-depth-2 btn waves-effect' type='submit' name='like_post' disabled>$likes
						<i style='border-radius: 10px;' class='material-icons right'>thumb_up</i>
					</button>
				</form>
			</div>
		";

		$unlike_button = "
			<div style='margin-bottom: 20px;'> 
				<form action='profile.php?user_id=$user_id&post_id=$post_id$goback' method='POST'>
			        <button style='margin-top: 20px; background-color: #e37375;' class='z-depth-2 btn waves-effect' type='submit' name='like_post'>$likes
						<i style='border-radius: 10px;' class='material-icons right'>thumb_down</i>
					</button>
				</form>
			</div>
		";

		$connection = Database::getConnection();
		$sql = "SELECT * FROM posts_likes WHERE post_id=$post_id AND user_id=$liker_user_id";
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
}
<?php class Comment {
	private $id;
	private $post_id;
	private $commenter_user;
	private $comment_body;
	private $posted_at;

	public function __construct(int $comment_id, int $post_id) {
		$connection = Database::getConnection();
		$sql = "SELECT * FROM comments WHERE id=$comment_id AND post_id=$post_id";
		$result = mysqli_query($connection, $sql);
		$connection->close();

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);

			$commenter_user = new User((int) $row['commenter_user_id']);

			$this->id = $row['id'];
			$this->post_id = $row['post_id'];
			$this->commenter_user = $commenter_user;
			$this->comment_body = $row['comment_body'];
			$this->posted_at = $row['posted_at'];
		} else {
			die("Comment unable to construct");
		}
	}

	public function render() {
		$commenter_user_id = $this->commenter_user->getID();
		$commenter_user_name = $this->commenter_user->getName();
		$comment_body = $this->comment_body;
		$date = date("jS F, Y", strtotime($this->posted_at));
		$time = date("g:ia", strtotime($this->posted_at));

		$comment_style = "style='padding: 20px; margin: 20px 20px 0px 20px;border-radius: 20px;'";

		// Render comment
		echo ("
			<div class='row'>
				<div class='white z-depth-1' $comment_style>
					<div class='black-text' style='word-wrap: break-word;'>
						<span>
							<a class='tooltipped' data-position='top' data-tooltip='Go to Profile' style='color: inherit;' href='profile.php?user_id=$commenter_user_id'>
								<b>$commenter_user_name: </b>
							</a>
						</span>
						<span>
							<p>$comment_body</p>
						</span>
					</div>
					<div>
						<text style='font-size: 9pt'>
							<b>Posted at: </b>
							<text style='color: #90949c'>$date at $time</text>
						</text>
					</div>
				</div>
			</div>
		");
	}
}
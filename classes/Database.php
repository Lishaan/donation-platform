<?php class Database {
	private static $server = "localhost";
	private static $username = "lishan";
	private static $password = "067699";
	private static $database = "donation-platform";

	public static function getConnection() {
		return mysqli_connect(self::$server, self::$username, self::$password, self::$database);
	}

	public static function getRandomID() {
		$start = rand(0, 50000);
		$end = rand(50000, 100000);

		return rand($start, $end);
	}

	public static function getCategories() {
		$connection = self::getConnection();
		$sql = "SELECT category FROM categories";
		$result = mysqli_query($connection, $sql);
		$connection->close();

		$categories = array();

		while ($row = mysqli_fetch_assoc($result)) {
			array_push($categories, $row['category']);
		}

		return $categories;
	}
}
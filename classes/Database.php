<?php class Database {

	private static $server = "localhost";
	private static $username = "lishan";
	private static $password = "067699";
	private static $database = "donation-platform";

	public static function getConnection() {
		return mysqli_connect(self::$server, self::$username, self::$password, self::$database);
	}
}
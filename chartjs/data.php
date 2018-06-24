<?php $root_dir = $_SERVER["DOCUMENT_ROOT"];
require($root_dir . '/classes/Database.php');
header('Content-Type: application/json');

$connection = Database::getConnection();

//query for funds raised by organization 
$query = sprintf("SELECT SUM(donation_amount) AS fundsGathered, CASE WHEN MONTH(donated_at)= 1 THEN 'JAN' WHEN MONTH(donated_at)=2 THEN 'FEB' WHEN MONTH(donated_at)=3 THEN 'MAR' WHEN MONTH(donated_at)=4 THEN 'APR'WHEN MONTH(donated_at)=5 THEN 'MAY'WHEN MONTH(donated_at)=6 THEN'JUN' WHEN MONTH(donated_at)=7 THEN 'JUL'WHEN MONTH(donated_at)=8 THEN 'AUG'WHEN MONTH(donated_at)=9 THEN 'SEP'WHEN MONTH(donated_at)=10 THEN 'OCT' WHEN MONTH(donated_at)=11 THEN 'NOV'WHEN MONTH(donated_at)=12 THEN 'DEC' END AS MONTH FROM events_donations, events WHERE YEAR(donated_at) = 2018 AND events_donations.event_id = events.id AND events.poster_user_id = 33 GROUP by MONTH(donated_at)");

//query for money donated by donator
//$query = sprintf("SELECT SUM(donation_amount) AS DONATION_AMOUNT, CASE WHEN MONTH(donated_at)= 1 THEN 'JAN' WHEN MONTH(donated_at)=2 THEN 'FEB' WHEN MONTH(donated_at)=3 THEN 'MAR' WHEN MONTH(donated_at)=4 THEN 'APR'WHEN MONTH(donated_at)=5 THEN 'MAY'WHEN MONTH(donated_at)=6 THEN'JUN' WHEN MONTH(donated_at)=7 THEN 'JUL'WHEN MONTH(donated_at)=8 THEN 'AUG'WHEN MONTH(donated_at)=9 THEN 'SEP'WHEN MONTH(donated_at)=10 THEN 'OCT' WHEN MONTH(donated_at)=11 THEN 'NOV'WHEN MONTH(donated_at)=12 THEN 'DEC' END AS MONTH FROM events_donations WHERE YEAR(donated_at) = 2018 AND donator_user_id = 2 GROUP BY MONTH(donated_at)")

//execute query
$result = $connection->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$connection->close();

//now print the data
print json_encode($data);
?>



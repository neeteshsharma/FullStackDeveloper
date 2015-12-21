<?php
include_once("db_connection.php");
$sql = mysql_query("select *from server_details");
$result = array();
while($data = mysql_fetch_assoc($sql)) {
	$result[] = $data;
}
$res = json_encode($result);
?>

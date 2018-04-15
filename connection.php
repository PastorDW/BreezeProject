<?php
$db_host = 'localhost';
$db_user = 'practie3_daniel';
$db_pass = 'xsw2CDE#vfr4BGT%';
$db_name = 'practie3_BREEZE';

// The database connection.
$con = mysql_connect($db_host, $db_user, $db_pass);
if(!$con) {
	die("Cannot connect. " . mysql_error());
}
// The database name selection.
$dbselect = mysql_select_db($db_name);
if(!$dbselect) {
	die("Cannot select database " . mysql_error());
}
?>

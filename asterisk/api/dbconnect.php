<?php
$host = "localhost";
$username = "root";
$password = "abc1234";
$db_name_asterisk = "asteriskcdrdb";
$db_name_log = "log";
//$db_name_asterisk_demo = "asteriskcdr-2";
# connect mySQL #
$connect = mysql_connect($host,$username,$password);
mysql_select_db($db_name_asterisk);
//mysql_select_db($db_name_asterisk_demo);

?>
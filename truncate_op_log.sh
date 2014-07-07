#!/usr/bin/php -q
<?php
# config user/pass/host to connect mySQL Server
define('DB_USER','root');
define('DP_PASS','abc1234');
define('DB_SERV','localhost');
define('DB_NAME','log');
define('DB_TABLE','log_operator');
$conn_db = mysql_connect(DB_SERV,DB_USER,DP_PASS) or die ("Can't Connect to database");
mysql_select_db(DB_NAME);

# Truncate Table command (settings crontab 1 day to truncate)
mysql_query("TRUNCATE TABLE `log_operator`");

?>
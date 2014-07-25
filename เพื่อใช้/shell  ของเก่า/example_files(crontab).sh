#!/usr/bin/php -q
<?php

define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'abc1234');
define('DB_SERVER', 'localhost');
define('DB_DATABASE', 'log');

$extensions = array("1111");

$conn = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die("Can't connect to database");
mysql_select_db(DB_DATABASE) or die("Can't select database");
mysql_query("SET NAMES UTF8");

function insertstatus($extension, $host, $port, $status) {
    global $conn;
    $strSQL = "INSERT INTO `logstatus_users`( `date`, `extension`, `host`, `port`, `status`) VALUES (NOW(),'{$extension}','{$host}','{$port}','{$status}')";
    mysql_query($strSQL, $conn);
}

foreach ($extensions as $extension) {
    $resultexec = shell_exec("/usr/sbin/asterisk -rx 'sip show peers' | grep {$extension}");
    $resultreplace =  preg_replace("/([ ]{2,})/","|",$resultexec);
    $results = explode("|", $resultreplace);
    insertstatus($extension, $results[1], $results[5], $results[6]);
}
?>
#!/usr/bin/php -q
<?PHP
# define connection for sql data
define('DB_USER','root');
define('DP_PASS','abc1234');
define('DB_SERV','localhost');
define('DB_NAME','log');

$operator_id = array("1111","2222","3333");

$conn_db = mysql_connect(DB_SERV,DB_USER,DP_PASS) or die ("Can't Connect to database");
mysql_select_db(DB_NAME);

function insertOperatorToSQL($operators, $ip_operator,$status) {
	global $conn_db;
	$insert = " INSERT INTO `logoperator_status`( `datetime`, `operator`, `ip_operator`, `status`) 
	VALUES (NOW(),'{$operators}','{$ip_operator}','{$status} ')";
	mysql_query($insert,$conn_db);
}

foreach ($operator_id as $operators) {
	# shell script to grep data 
    $resultexec = shell_exec("/usr/sbin/asterisk -rx 'sip show peers' | grep {$operators}");
    # replace gap of line ot '|'
    $resultreplace =  preg_replace("/([ ]{2,})/","|",$resultexec);
    # replace '|' to array data
    $results = explode("|", $resultreplace);
    # insert to sql via function script
    insertOperatorToSQL($operators,$results[1],$results[6]);
}

?>
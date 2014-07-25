#!/usr/bin/php -q
<?PHP
# get time zone (TH)
date_default_timezone_set('Asia/Bangkok');

# define database connection
define('DB_USER','root');
define('DP_PASS','abc1234');
define('DB_SERV','localhost');
define('DB_NAME','log');
define('DB_TABLE','log_operator');
$conn_db = mysql_connect(DB_SERV,DB_USER,DP_PASS) or die ("Can't Connect to database");
mysql_select_db(DB_NAME);

# callcenter & operators configuration
$operator_name = array("OP-1111","OP-2222","OP-3333"); # Name of Operators
$operator_number = "89000"; # CallCenter Number

# status called (don't change)
$strNotInUse = "Not in use";  # AVALIABLE
$strUnavailable = "Unavailable";  # OFFLINE
$strRinging = "Ringing"; # RINGING
$strInUse = "In use"; # BUSY

# implement server time($serv_time) is empty
$serv_time = NULL;

# insert to sql function (it will using in main of php)
function insertOperatorToSQL($operator_id, $serv_time, $status) {
	global $conn_db;
	$insert = " INSERT INTO `log_operator`( `date`, `operator_id`, `status`) 
	VALUES ('{$serv_time}','{$operator_id}','{$status}')";
	mysql_query($insert,$conn_db);
}

#main function
# get time from server via PHP code
$serv_time = date('Y-m-d h:i:s');

# for loop to find operator in array. using grep to analyse text.
foreach ($operator_name as $operator) {
	$exec = shell_exec("/usr/sbin/asterisk -rx 'queue show {$operator_number}' | grep {$operator}");
	# find position string
	$posStr = strpos($exec, $strNotInUse);
	$posStr2 = strpos($exec, $strUnavailable);
	# if($posStr == true || $posStr2 == true){
	# 	if($posStr2 == true){
	# 		echo "Operator ({$operator}) not online !! --> ";
	# 	}
	# 	else echo "Operator ({$operator}) avaliable !! --> ";
	# }else{
	# 	echo "Operator ({$operator}) busy !! --> ";
	# }
	$tmp = ($posStr)?($strNotInUse):(($posStr2)?$strUnavailable:$strInUse);
	# insert to sql using function
	insertOperatorToSQL($operator,$serv_time,$tmp);
}

?>
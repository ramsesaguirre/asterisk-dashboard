<?PHP
define('DB_USER','root');
define('DP_PASS','abc1234');
define('DB_SERV','localhost');
define('DB_NAME','log');
define('DB_TABLE','log_operator');
date_default_timezone_set('Asia/Bangkok');
$conn_db = mysql_connect(DB_SERV,DB_USER,DP_PASS) or die ("Can't Connect to database");
mysql_select_db(DB_NAME);

$operator_name = array("OP-1111","OP-2222","OP-3333");
$operator_number = "89000";

$strNotInUse = "Not in use";  # AVALIABLE
$strUnavailable = "Unavailable";  # OFFLINE
$strRinging = "Ringing"; # RINGING
$strInUse = "In use"; # BUSY

$tmpTime = NULL;
function insertOperatorToSQL($operator_id, $serv_time, $status) {
	global $conn_db;
	$insert = " INSERT INTO `log_operator`( `date`, `operator_id`, `status`) 
	VALUES ('{$serv_time}','{$operator_id}','{$status}')";
	mysql_query($insert,$conn_db);
}

function findByDate($time,$condition){
	if($condition==NULL || $condition == '') $condition = '=';
	// echo 'SELECT * FROM `log_operator` WHERE `date` {$condition} {$time}';
	$query = mysql_query('SELECT * FROM `log_operator` WHERE `date` $condition $time');
	echo $query;
	while ($row = mysql_fetch_assoc($query)){
		echo $row['operator_id'];
	}
}
$serv_time = $tmpTime = date('Y-m-d h:m:s');
foreach ($operator_name as $operator) {
	$exec = shell_exec("/usr/sbin/asterisk -rx 'queue show {$operator_number}' | grep {$operator}");
	// echo $exec;
	# find position string
	$posStr = strpos($exec, $strNotInUse);
	$posStr2 = strpos($exec, $strUnavailable);
	if($posStr == true || $posStr2 == true){
		if($posStr2 == true){
			echo "Operator ({$operator}) not online !! --> ";
		}
		else echo "Operator ({$operator}) avaliable !! --> ";
	}else{
		echo "Operator ({$operator}) busy !! --> ";
	}
	$tmp = ($posStr)?($strNotInUse):(($posStr2)?$strUnavailable:$strInUse);
	echo $tmp.' </br>';

	insertOperatorToSQL($operator,$serv_time,$tmp);
	

	// if($posStr == false)
	// if($posStr == false || $posStr2 == ){
	// 	echo "Operator ({$operator}) are busy!!".'<p>';
	// }else{
	// 	echo "Operator ({$operator}) avaliable!!".'<p>';
	// }
}
echo $tmpTime;
echo findByDate($tmpTime,'>=');

?>
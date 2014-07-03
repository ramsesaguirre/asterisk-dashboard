<?PHP
define('DB_USER','root');
define('DP_PASS','abc1234');
define('DB_SERV','localhost');
define('DB_NAME','log');

$operator_name = array("OP-1111","OP-2222","OP-3333");
$operator_number = "89000";

$strToFind = "Not in use";
$strAbsent = "Unavailable";

foreach ($operator_name as $operator) {
	$exec = shell_exec("/usr/sbin/asterisk -rx 'queue show {$operator_number}' | grep {$operator}");
	# find position string
	$posStr = strpos($exec, $strToFind);
	$posStr2 = strpos($exec, $strAbsent);

	if($posStr == true || $posStr2 == true){
		if($posStr2 == true){
			echo "Operator ({$operator}) not online !!".'<p>';
			break;
		}
		echo "Operator ({$operator}) avaliable !!".'<p>';
	}else{
		echo "Operator ({$operator}) busy !!".'<p>';
	}



	// if($posStr == false)
	// if($posStr == false || $posStr2 == ){
	// 	echo "Operator ({$operator}) are busy!!".'<p>';
	// }else{
	// 	echo "Operator ({$operator}) avaliable!!".'<p>';
	// }
}

?>
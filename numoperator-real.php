<?PHP
include 'dbconnection.php';
$operator_name = array("OP-1111","OP-2222","OP-3333");
$operator_number = "89000";

$strNotInUse = "Not in use";  # AVALIABLE
$strUnavailable = "Unavailable";  # OFFLINE
$strRinging = "Ringing"; # RINGING
$strInUse = "In use"; # BUSY

foreach ($operator_name as $operator) {
	$exec = shell_exec("/usr/sbin/asterisk -rx 'queue show {$operator_number}' | grep {$operator}");
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
}

?>
<?PHP
include "dbconnection2log.php";

function serverDate(){
	date_default_timezone_set('Asia/Bangkok');
	$varDate = date('Y-m-d H:i');
	return $varDate;
}

$realDate = serverDate();
$sqlCommand = "SELECT `date`,`operator_id`,`status` FROM `log_operator` where `date` like '{$realDate}%' group by `operator_id` order by `date`, `operator_id` ASC";
$query = mysql_query($sqlCommand);
$offline = $busy = $available = 0;
while($data = mysql_fetch_assoc($query)){
	$tmp = $data['status'];
	if ($tmp == 'Unavailable'){
		$offline++;
	}
	elseif ($tmp == 'Not in use') {
		$available++;
	}
	elseif ($tmp == 'In use'){
		$busy++;
	}
	// ($tmp == 'Unavailable')?$offline++:(($tmp == 'Not in use')?$available++:(($tmp == 'In use')?$busy++:break;));
}
echo $offline.'</p>'.$available.'</p>'.$busy.'</p>';
?>
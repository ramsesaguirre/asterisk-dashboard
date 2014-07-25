<?php
require_once 'dbconnect.php';

function timeDifferent($firstTimeInput,$lastTimeInput)
{
	$firstTimeInput = strtotime($firstTimeInput);
	$lastTimeInput = strtotime($lastTimeInput);
	$timeDifferent = $lastTimeInput - $firstTimeInput;
	return $timeDifferent;
}

function dateTime(){
    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d');
    $time = date('H:i:s');
    return $date;
}

$get_day = $_GET['day']?$_GET['day']:date('d');
$get_month = $_GET['month']?$_GET['month']:date('m');
$get_year = $_GET['year']?$_GET['year']:date('Y');
$get_alldate = $get_year.'-'.$get_month.'-'.$get_day;

$today = $get_alldate;
$sql = " SELECT * FROM `cel` WHERE (`eventtime` like '$today"."%' ) and((`eventtype` = 'ANSWER' and `appname` = 'answer') or (`eventtype` = 'bridge_start' and `appname` = 'dial')) order by `linkedid`, `eventtype` ";
$query = mysql_query($sql);
$row1 = $row2 = $averageTime = null;
$arr_number[] = array();
$arr_wait_queue[] = array();
$tag_get2=true;
$hasNext=true;
$count = 0;
while($hasNext){
	if($tag_get2){
		$hasNext=($row1 = mysql_fetch_assoc($query) and $row2 = mysql_fetch_assoc($query));
	}else{
		$hasNext=($row2 = mysql_fetch_assoc($query));
		$tag_get2=true;
	}
	if($hasNext == false) break;
	if($row1['linkedid'] == $row2['linkedid']){
		$arr_wait_queue[$count] = timeDifferent($row1['eventtime'],$row2['eventtime']);
                $arr_number[$count] = $row1['cid_num'];
//		echo 'number : '.$arr_number[$count].' Waiting on queue: '.$arr_wait_queue[$count].' Second'.'</br>';
                $count++;
	}else
	{
		$tag_get2=false;
		$row1=$row2;
	}

}
for($i = 0 ; $i<=$count ; $i++){
    $tmpAllTime += $arr_wait_queue[$i];
}
$averageTime = $tmpAllTime / $count;

$temp_arr = array("date"=>$today,"average_time"=>$averageTime,"caller"=>$count,"number"=>$arr_number);
echo json_encode(array("total_queue"=>$temp_arr));
mysql_close();
?>

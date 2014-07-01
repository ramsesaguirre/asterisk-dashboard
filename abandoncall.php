<?PHP
date_default_timezone_set('Asia/Bangkok');

function dateInputStart($dateStart){
	return $dateStart;
}
function dateInputEnd($dateEnd){
	return $dateEnd;
}

$date1 = dateInputStart("2014-06-26");
$date2 = dateInputEnd("2014-06-28");
include "dbconnection.php";
if($date1 == $date2){
	echo "Check abandon called from date : ".$date1."</p>";
	$sql = " SELECT `calldate`,`dstchannel`,`src`,`dst`,`duration` FROM cdr WHERE `calldate` LIKE '$date1"."%' AND `dstchannel` = '' AND `lastapp` = 'Queue' ";
}
else{
	echo "Check abandon called between date : ".$date1." to ".$date2."</p>";
	$sql = " SELECT `calldate`,`dstchannel`,`src`,`dst`,`duration` FROM cdr WHERE `calldate` BETWEEN '$date1"."%' AND '$date2"."%' AND `dstchannel` = '' AND `lastapp` = 'Queue' ";
}

$query = mysql_query($sql);
$sumRows = 0;
while($row = mysql_fetch_assoc($query))
	{
		$sumRows += $row['duration'];
		$callDate = $row['calldate'];
		$callSource = $row['src'];
		echo $callDate." -> ".$callSource.'</br>';

	}
$count = mysql_num_rows($query);
$average = $sumRows/$count + 0;

echo "<p>Abandon Call = $count Call(s)";
echo "<p>time to waiting called(average) = ".gmdate("i:s",$average)." Minute.";
mysql_close();
?>
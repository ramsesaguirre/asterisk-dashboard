<?PHP
function timeInput($dateStart,$dateFinal)
{
	date_default_timezone_set('Asia/Bangkok');
	$date1 = $dateStart;
	$date2 = $dateFinal;
	if($date1 == $date2){
		return $date1;
	}
	else{
		return array($date1,$date2);
	}
}

// $startDate = date('Y-m-d');
// $time = date('h:m:s');
// $endDate = date('Y-m-d');
include "dbconnection.php";
echo "Today = $date "."and time = $time <br>";
/* SELECT DB to query */
	if($startDate == $endDate)
	{
		$sql = " SELECT `calldate`,`dstchannel`,`src`,`dst`,`duration` FROM cdr WHERE `calldate` LIKE '$startDate"."%' AND `dstchannel` = '' AND `lastapp` = 'Queue' ";
	}
	else
	{
		$sql = " SELECT `calldate`,`dstchannel`,`src`,`dst`,`duration` FROM cdr WHERE `calldate` BETWEEN '$startDate"."%' AND '$endDate"."%' AND `dstchannel` = '' AND `lastapp` = 'Queue' ";
	}
$query = mysql_query($sql);
$sumRows = 0;
while($row = mysql_fetch_assoc($query))
	{
		$sumRows += $row['duration'];
		$callDate = $row['calldate'];
		echo $callDate."<br>";
	}
$count = mysql_num_rows($query);
$average = $sumRows/$count + 0;
echo "<p>Abandon Call = $count Call(s)";
echo "<p>time to waiting called(average) = $average Seconds";
mysql_close();
?>
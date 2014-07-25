


<?PHP
session_start();

date_default_timezone_set('Asia/Bangkok');

function dateInputStart($dateStart){
	return $dateStart;
}
function dateInputEnd($dateEnd){
	return $dateEnd;
}

$date1 = dateInputStart("2014");
$date2 = dateInputEnd("2014");

//check condition to connect mysql (if $date1 and $date 2 are same, sql could be find only $date1)
include "dbconnection.php";
echo mktime(10,11,35,7,15,2014);
if($date1 == $date2){
	$sql = " SELECT `calldate`,`dstchannel`,`src`,`dst`,`duration` FROM cdr WHERE `calldate` LIKE '$date1"."%' AND `dstchannel` = '' AND `lastapp` = 'Queue' ";
	echo $sql."</p>";
	echo "Check abandon called from date : ".$date1."</p>";

}
else{
	if($date1 == '0' || $date2 == '0'){
		$date1 = $date2;
	}
	echo "Check abandon called between date : ".$date1." to ".$date2."</p>";
	$sql = " SELECT `calldate`,`dstchannel`,`src`,`dst`,`duration` FROM cdr WHERE `calldate` BETWEEN '$date1"."%' AND '$date2"."%' AND `dstchannel` = '' AND `lastapp` = 'Queue' ";

}


$query = mysql_query($sql);
$sumRows = 0;
while($row = mysql_fetch_assoc($query))
	{    $duration[]=$row['duration'];
		//Output variable -> '$calldate' for showing date of abandon called and 
		//-> '$callSource' for showing number of abandoncall
		$sumRows += $row['duration'];
		$callDate[] = $row['calldate'];
		$callSource = $row['src'];
		echo 'call date : '.$row['calldate']." number -> ".$callSource.'</br>';
            $_SESSION['abadon']['duration']= $duration;
            $_SESSION['abadon']['ctime'] =$callDate;

	}
$count = mysql_num_rows($query);
$average = $sumRows/$count + 0;
          $_SESSION['abandon']['dayavg']=$average;
          $_SESSION['abandon']['datetimeavg']=$average;

echo "<p>Abandon Call = $count Call(s)";
echo "<p>time to waiting called(average) = ".gmdate("i:s",$average)." Minute.";
mysql_close();
?>
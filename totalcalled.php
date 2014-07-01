<?PHP

function timeDifferent($firstTimeInput,$lastTimeInput)
{
	$firstTimeInput = strtotime($firstTimeInput);
	$lastTimeInput = strtotime($lastTimeInput);
	$timeDifferent = $lastTimeInput - $firstTimeInput;
	return $timeDifferent;
}

// function averageTime($values)
// {
// 	$average=0;
// 	foreach ($values as $value) 
// 	{
// 		$average+=$value;
// 	}
// 	return $average/count($values);
// }

function inputDate($dateInput)
{
	date_default_timezone_set('Asia/Bangkok');
	$date = $dateInput;
	return $date;
}

include "dbconnection.php";
$date = inputDate('2014-06-26');
echo "Find Call log date : ".$date."</p>";
/* USING 'CEL' DATABASE TO ANALYSE TOTAL CALL OF USER TO OPERATOR  */
$sqlCMD = "select `eventtime`,`eventtype`,`cid_num`,`linkedid` from `cel` where (`eventtime` like '$date"."%') and (`eventtype` = 'BRIDGE_START' or `eventtype` = 'BRIDGE_END') GROUP by `eventtime` order by `eventtime` ASC ";
$query = mysql_query($sqlCMD);
$countRows = mysql_num_rows($query);
$count=0;
$sumVar = 0;
$tmp =null;
while ($rowstart = mysql_fetch_assoc($query) and $rowend = mysql_fetch_assoc($query))
{
	if ($rowstart['linkedid']==$rowend['linkedid'])
	{
		$tmp[$count] = timeDifferent($rowstart['eventtime'],$rowend['eventtime']);
		echo "Telephone number : ".$rowstart['cid_num']." call time : ".substr($rowstart['eventtime'], 10).'<br>'."Call duration : ";
		echo gmdate("i:s",$tmp[$count])." Minute".'</br>';
		$sumVar += $tmp[$count++];
	}
}
$averageTimePerDay = $sumVar / $count;
echo "<p>average time per day : ".gmdate("i:s",$averageTimePerDay)." Minute";
// echo averageTime($tmp);
// $testFirstTime = "2014-06-26 13:05:56";
// $testLastTime = "2014-06-26 13:06:11";
// echo strtotime($testFirstTime).'<br>';
// echo strtotime($testLastTime);
// echo timeDifferent($testFirstTime,$testLastTime);

?>
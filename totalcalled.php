<?PHP
//function 'timeDifferent' can be return different of time. Function process are convert time to unix and find different time.
function timeDifferent($firstTimeInput,$lastTimeInput)
{
	$firstTimeInput = strtotime($firstTimeInput);
	$lastTimeInput = strtotime($lastTimeInput);
	$timeDifferent = $lastTimeInput - $firstTimeInput;
	return $timeDifferent;
}

function inputDate($dateInput)
{
	date_default_timezone_set('Asia/Bangkok');
	$date = $dateInput;
	return $date;
}

include "dbconnection.php";
$date = inputDate('2014-07-01');

/* USING 'CEL' DATABASE TO ANALYSE TOTAL CALL OF USER TO OPERATOR  */
$sqlCMD = "select `eventtime`,`eventtype`,`cid_num`,`linkedid` from `cel` where (`eventtime` like '$date"."%') and (`eventtype` = 'BRIDGE_START' or `eventtype` = 'BRIDGE_END') GROUP by `eventtime` order by `linkedid`,`eventtype` DESC ";
$query = mysql_query($sqlCMD);
$countRows = mysql_num_rows($query);

// OPERATOR COUNT
$count=0; //count variable for number of data
$sumVar = 0; //summary of data
$tmp =null; //temp files 
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

// SHOW ON PAGES
echo "Find Call log date : ".$date."</p>";
echo "<p>average time per day : ".gmdate("i:s",$averageTimePerDay)." Minute";

?>
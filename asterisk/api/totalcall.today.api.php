<?PHP
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
//    $time = date('H:i:s');
    return $date;
}
$get_day = $_GET['day']?$_GET['day']:date('d');
$get_month = $_GET['month']?$_GET['month']:date('m');
$get_year = $_GET['year']?$_GET['year']:date('Y');
$get_alldate = $get_year.'-'.$get_month.'-'.$get_day;
$today = $get_alldate;
$sql_totalcall_today = "select `eventtime`,`eventtype`,`cid_num`,`linkedid` from `cel` where (`eventtime` like '$today"."%') and (`eventtype` = 'BRIDGE_START' or `eventtype` = 'BRIDGE_END') GROUP by `eventtime` order by `linkedid`,`eventtype` DESC ";
$query = mysql_query($sql_totalcall_today);
$countRows = mysql_num_rows($query);
$arr_called_number[] = array();
$count=0; //count variable for number of data
$sumVar = 0; //summary of data
$tmp =null; //temp files 
while ($rowstart = mysql_fetch_assoc($query) and $rowend = mysql_fetch_assoc($query))
{
	if ($rowstart['linkedid']==$rowend['linkedid'])
	{
		$tmp[$count] = timeDifferent($rowstart['eventtime'],$rowend['eventtime']);
                $arr_called_number[$count] = $rowstart['cid_num'];
		$sumVar += $tmp[$count++];
	}
}
$averageTimePerDay = $sumVar / $count;

$array_output = array("date"=>$today,"avg_time"=>$averageTimePerDay,"caller"=>$count,"number"=>$arr_called_number);
echo json_encode(array("total_called"=>$array_output));
mysql_close();
?>
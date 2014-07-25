<?php
require_once 'dbconnect.php';

function dateTime(){
    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d');
//    $time = date('H:i:s');
    return $date;
}


//get date from url
$get_day = $_GET['day']?$_GET['day']:date('d');
$get_month = $_GET['month']?$_GET['month']:date('m');
$get_year = $_GET['year']?$_GET['year']:date('Y');
$get_alldate = $get_year.'-'.$get_month.'-'.$get_day;

// return to variables
$today = $get_alldate;
$sqlCommand = "SELECT `calldate`,`dstchannel`,`src`,`dst`,`duration`,`uniqueid` FROM cdr WHERE `calldate` LIKE '$today"."%' AND `dstchannel` = '' AND `lastapp` = 'Queue' group by `uniqueid`";
$query = mysql_query($sqlCommand);
$sumRows = 0;
$caller_array[] = array();
$arrcount = 0;
while($row = mysql_fetch_assoc($query))
	{
		$sumRows += $row['duration'];
		$callDate = $row['calldate'];
                $caller_array[$arrcount] = $row['src'];
                $arrcount++;
	}
$count = mysql_num_rows($query);
$average = $sumRows/$count + 0;

// return to API
$countarr_abandon = array("date"=>$today,"call"=>$count,"average"=>$average,"src"=>$caller_array);
echo json_encode(array("abandon_today"=>$countarr_abandon));
mysql_close();
?>
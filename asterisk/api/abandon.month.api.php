<?php

require_once 'dbconnect.php';
$sql_month_cmd = "SELECT date(calldate) as cdate, avg(duration) as avgs ,substring(calldate,6,2) as m,substring(calldate,1,4) as y FROM cdr WHERE `dstchannel` = '' AND `lastapp` = 'Queue' group by date(calldate)";
$get_month = $_GET['month']?$_GET['month']:0;
$get_year = $_GET['year']?$_GET['year']:0;
$querymonth = mysql_query($sql_month_cmd);

$select_month = $get_month;
$select_year = $get_year;

$countrow = 0;
$row['m'] = 0;
$arr_month_abandon[] = array();
$arr_average_abandon[] = array();

while($rowfetch = mysql_fetch_assoc($querymonth)){
    $cdate = $rowfetch['cdate'];
    $average = $rowfetch['avgs'];
    $month = $rowfetch['m'];
    $year = $rowfetch['y'];
    
    if($year == $select_year && $month == $select_month){
        $arr_average_abandon[$countrow] = (int)$average;
        $arr_month_abandon[$countrow] = $cdate;
        $countrow++;
    }
    
}

$tmp_array = array("date"=>$arr_month_abandon,"average"=>$arr_average_abandon);
echo json_encode(array("abandon_month"=>$tmp_array));
mysql_close();
?>

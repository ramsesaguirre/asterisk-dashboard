<?php
require_once 'dbconnect.php';
// using log database
mysql_select_db($db_name_log);

$sql_month_log = "SELECT date(date) as cdate ,avg(time_duration) as avgs,substring(date,6,2) m,substring(date,1,4) as y  FROM `totalqueue` group by date(date) order by date";
$get_month = $_GET['month']?$_GET['month']:0;
$get_year = $_GET['year']?$_GET['year']:0;
$querymonth = mysql_query($sql_month_log);

$select_month = $get_month;
$select_year = $get_year;

$countrow = 0;
$row['m'] = 0;
$arr_month_totalq[] = array();
$arr_average_totalq[] = array();

while($rowfetch = mysql_fetch_assoc($querymonth)){
    $cdate = $rowfetch['cdate'];
    $average = $rowfetch['avgs'];
    $month = $rowfetch['m'];
    $year = $rowfetch['y'];
    
    if($year == $select_year && $month == $select_month){
        $arr_average_totalq[$countrow] = (float)$average;
        $arr_month_totalq[$countrow] = $cdate;
        $countrow++;
    }
    
}

$tmp_array = array("date"=>$arr_month_totalq,"average_per_month"=>$arr_average_totalq);
echo json_encode(array("total_queue_month"=>$tmp_array));
mysql_close();
?>
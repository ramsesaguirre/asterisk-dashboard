<?php
require_once 'dbconnect.php';
// using log database
mysql_select_db($db_name_log);

$sql_year_log = "SELECT MONTH(`date`) as cmonth,Year(`date`) as cyear, avg(time_duration) as avgs  FROM `totalqueue` group by month(`date`),Year(`date`) 
order by year(`date`),month(`date`) ";
$get_year = $_GET['year'];
$query_year = mysql_query($sql_year_log);
$arr_average_year[] = array();
$arr_month_per_year[] = array();
$count = 0;

while ($row2 = mysql_fetch_assoc($query_year)) {
    $callyear = $row2['cyear'];
    $callmonth = $row2['cmonth'];
    $avg = $row2['avgs'];
    if($callyear == $get_year){
        $arr_average_year[$count] = (int)$avg;
        $arr_month_per_year[$count] = $callmonth;
        $count++;
    }
}

$temp_arr_year = array("year"=>$get_year,"by_month"=>$arr_month_per_year,"average_call"=>$arr_average_year);
echo json_encode(array("totalqueue_by_year"=>$temp_arr_year));
mysql_close();
?>
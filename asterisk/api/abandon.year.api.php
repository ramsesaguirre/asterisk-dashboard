<?php
require_once 'dbconnect.php';
$sql_year_cmd = "SELECT MONTH(`calldate`) as cmonth,Year(`calldate`) as cyear,  avg(duration) as avgs FROM cdr WHERE  `dstchannel` = '' AND `lastapp` = 'Queue' 
group by month(`calldate`),Year(`calldate`) 
order by year(`calldate`),month(`calldate`) ";
$get_year = $_GET['year'];
$query_year = mysql_query($sql_year_cmd);
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

$temp_arr_year = array("year"=>$get_year,"month"=>$arr_month_per_year,"average"=>$arr_average_year);
echo json_encode(array("abandon_year"=>$temp_arr_year));
mysql_close();
?>
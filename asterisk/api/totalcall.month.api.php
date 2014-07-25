<?PHP
require_once 'dbconnect.php';
mysql_select_db($db_name_log);
$totalcall_month_sql = "SELECT date(date) as cdate ,avg(time_duration) as average,substring(date,6,2) m,substring(date,1,4) as y FROM `totalcall` group by date(date) order by date";
$query = mysql_query($totalcall_month_sql);
$get_month = $_GET['month']?$_GET['month']:0;
$get_year = $_GET['year']?$_GET['year']:0;
$select_month = $get_month;
$select_year = $get_year;
$countrow = 0;
$arr_month_totalq[] = array();
$arr_average_totalq[] = array();

while($rowfetch = mysql_fetch_assoc($query)){
    $cdate = $rowfetch['cdate'];
    $average = $rowfetch['average'];
    $month = $rowfetch['m'];
    $year = $rowfetch['y'];
    
    if($year == $select_year && $month == $select_month){
        $arr_average_totalq[$countrow] = (float)$average;
        $arr_month_totalq[$countrow] = $cdate;
        $countrow++;
    }
    
}

$tmp_array = array("date"=>$arr_month_totalq,"average_per_month"=>$arr_average_totalq);
echo json_encode(array("total_call_month"=>$tmp_array));
mysql_close();
?>
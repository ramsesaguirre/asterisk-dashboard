<?PHP
date_default_timezone_set('Asia/Bangkok');
session_start();
function part($timepart){
$time1=$time2=NULL;
switch ($timepart) {
	case '1':
		$time1="11:00:00"; $time2="08:00:00";
		break;
	case '2':
		$time1="12:00:00"; $time2="15:00:00";
		break;
	case '3':
		$time1="15:00:00"; $time2="19:00:00";
		break;		
	default:
		
		break;
}

 $serv_time=date('Y-m-d ');
		$i=0;
  		       while  ($serv_time+$time1  <= $_SESSION['abadon','ctime'] >= $serv_time+$time2 )
                {  $showtime=$_SESSION['abadon','ctime'];
                  $_SESSION['abandon',"timepart".$timepart]=$_SESSION['abadon','duration'];
                  $sum=+int($_SESSION['abandon',"timepart".$timepart]);
                  $i++; 
                }
                $avg= $sum/$i;
                return $avg;
}

//check condition to connect mysql (if $date1 and $date 2 are same, sql could be find only $date1)
include "dbconnection.php";
part(1);
  // $getdatetime=   ;
  //  $serv_time=date('Y-m-d ');
  // $datepart=1;
  // switch ($datepart) {
  // 	case '1':
  // 	part("11:00:00","8:00:00"); 
  // 		break;
  // 	case '2':
  // 		# code...
  // 		break;
  // 	case '3':
  // 		# code...
  // 		break;

  // 	default:
  // 		# code...
  // 		break;
  // }


?>
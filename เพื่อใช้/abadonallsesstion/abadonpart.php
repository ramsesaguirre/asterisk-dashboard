<?PHP
date_default_timezone_set('Asia/Bangkok');
include "dbconnection.php";
session_start();
$sum=0;
function part($timepart){

switch ($timepart) {
	case '1':
		$time1=" 08:00:00"; $time2=" 010:50:00";
		break;
	case '2':
		$time1=" 12:00:00"; $time2=" 15:00:00";
		break;
	case '3':
		$time1=" 15:00:00"; $time2=" 19:00:00";
		break;		
	default:
		
		break;
}


print_r ( $_SESSION['abadon']['duration']);

print_r ( $_SESSION['abadon']['ctime']);

 $time1="2014-07-15 10:11:30";
 $time2="2014-07-16 12:11:00";
 
		$i=0;
  		 while ( $_SESSION['abadon']['ctime']<$time2 ) 
                {  
              
              
                  
                  $i++; 
                  echo "2014s";
                
                }
              
               
                
                
              
}

//check condition to connect mysql (if $date1 and $date 2 are same, sql could be find only $date1)

part($_SESSION['timepart']);
    echo '5555555555';
   echo $_SESSION['timepart'].'</br>';  
   echo $_session['time1'].'</br>'. 
         $_SESSION['time2'];  
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
<?PHP
//function 'timeDifferent' can be return different of time. Function process are convert time to unix and find different time.

	date_default_timezone_set('Asia/Bangkok');
	



include "dbconnection2log.php";



$sqlCMD = "SELECT `date`,`operator_id`,`status` FROM `log_operator` order by `date` desc" ;
$query = mysql_query($sqlCMD);
$countRows = mysql_num_rows($query);

$o1=$o2=$o3='2100-07-03 11:14:31';

$oper1='OP-1111';
$oper2='OP-2222';
$oper3='OP-3333';
$count=0;

while ($rowstart = mysql_fetch_assoc($query) )
{  
    if($rowstart['operator_id']==$oper1)    
	   { 
	   	  if ($o1> $rowstart['date'])
	     	{
		
				echo "operator : ".$rowstart['operator_id']." status: ".$rowstart['status']." Time:".$rowstart['date'].'<br>';
		
	     	}
	   		 $o1='1000-07-03 11:14:31';
	   }
     elseif ($rowstart['operator_id']==$oper2) 
     	{
     	   if ($o2> $rowstart['date'])
	    	 {
		
				echo "operator : ".$rowstart['operator_id']." status: ".$rowstart['status']." Time:".$rowstart['date'].'<br>';
		
	    	 }
	 		$o2='1000-07-03 11:14:31';
     	# code...
    	 }
    elseif ($rowstart['operator_id']==$oper3) 
     	{
     	   if ($o3> $rowstart['date'])
	    	 {
		
				echo "operator : ".$rowstart['operator_id']." status: ".$rowstart['status']." Time:".$rowstart['date'].'<br>';
		
	    	 }
	 		$o3='1000-07-03 11:14:31';
     	# code...
    	 }
    	 
     $count++;
     if ($count==30)
     	break;


 
}

// SHOW ON PAGES


?>
<?PHP
//function 'timeDifferent' can be return different of time. Function process are convert time to unix and find different time.

	date_default_timezone_set('Asia/Bangkok');
	



include "dbconnection2log.php";



$sqlCMD = "SELECT `datetime`,`operator`,`status` FROM `logoperator_status` where `operator` ='1111' and `status` like 'ok%' order by `datetime` desc" ;
$query = mysql_query($sqlCMD);
$countRows = mysql_num_rows($query);

$o1='2100-07-03 11:14:31';
$o2='2100-07-03 11:14:31';
$o3='2100-07-03 11:14:31';
$oper1='1111';
$oper2='2222';
$oper3='3333';

while ($rowstart = mysql_fetch_assoc($query) )
{  
    if($rowstart['operator']==$oper1)    
	   { 
	   	  if ($o1> $rowstart['datetime'])
	     	{
		
				echo "operator : ".$rowstart['operator']." status: On  Time:".$rowstart['datetime'].'<br>';
		
	     	}
	   		 $o1='1000-07-03 11:14:31';
	   }
     elseif ($rowstart['operator']==$oper2) 
     	{
     	   if ($o2> $rowstart['datetime'])
	    	 {
		
				echo "operator : ".$rowstart['operator']." status: On  Time:".$rowstart['datetime'].'<br>';
		
	    	 }
	 		$o2='1000-07-03 11:14:31';
     	# code...
    	 }
    elseif ($rowstart['operator']==$oper3) 
     	{
     	   if ($o3> $rowstart['datetime'])
	    	 {
		
				echo "operator : ".$rowstart['operator']." status: On  Time:".$rowstart['datetime'].'<br>';
		
	    	 }
	 		$o3='1000-07-03 11:14:31';
     	# code...
    	 }


}

// SHOW ON PAGES


?>
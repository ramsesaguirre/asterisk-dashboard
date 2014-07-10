<?PHP
date_default_timezone_set('Asia/Bangkok');


//check condition to connect mysql (if $date1 and $date 2 are same, sql could be find only $date1)
include "dbconnection.php";

$sqldate="SELECT date(calldate) as cdate, avg(duration) as avgs ,substring(calldate,6,2) as m  FROM cdr WHERE  `dstchannel` = '' AND `lastapp` = 'Queue' 
group by date(calldate)";

$sqlmonth="SELECT MONTH(`calldate`) as cmonth,Year(`calldate`) as cyear,  avg(duration) as avgs FROM cdr WHERE  `dstchannel` = '' AND `lastapp` = 'Queue' 
group by month(`calldate`),Year(`calldate`) 
order by year(`calldate`),month(`calldate`) ";

$querydate = mysql_query($sqldate);
$i=0;
$k=0;
$compare=0;
$countrow=0;
// date per moonth
$row['m']=0;
    do{
		//Output variable -> '$calldate' for showing date of abandon called and 
		//-> '$callSource' for showing number of abandoncall
		
		$callDate = $row['cdate'];
		$avgs = $row['avgs'];
		$strDate = $row['m']+0;
               
                
                 if ($strDate!=$compare)
                {   if($compare!=0)
                        echo 'this'.$compare.'have number Abandon Call = '.$countrow.' Call(s)'.'<br>';
                    $compare = $strDate;
                    $countrow=0;
                }
               
		
		//echo $compare;
                //echo $strDate+1;
               //if($compare)
       // if ($strDate==$compare)
        /*{ $k=$i-1;
        echo 'this month have number Abandon Call = '.$i.' Call(s)';
         
        }*/echo ' date : '.$callDate." time to waiting called(average) ".$avgs.'</br>';
		
           $countrow++;
        
//
		
           
      
	}while($row = mysql_fetch_assoc($querydate));
         
                     echo 'this'.$compare.'have number Abandon Call = '.$countrow.' Call(s)'.'<br>';
                  
                
	
        
         

// month per year
$querymonth = mysql_query($sqlmonth);
  while($row2 = mysql_fetch_assoc($querymonth))
	{
		//Output variable -> '$calldate' for showing date of abandon called and 
		//-> '$callSource' for showing number of abandoncall
		$callyear = $row2['cyear'];
		$callmonth = $row2['cmonth'];
		$avg = $row2['avgs'];
		echo ' month is : '.$callmonth.'year : '.$callyear." time to waiting called(average) ".$avg.'</br>';
         
	}


mysql_close();
?>
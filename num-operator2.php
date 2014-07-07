<?PHP
//function 'timeDifferent' can be return different of time. Function process are convert time to unix and find different time.

	date_default_timezone_set('Asia/Bangkok');
	



include "dbconnection2log.php";



$sqlCMD = "SELECT `date`,`operator_id`,`status` FROM `log_operator` order by `date`, `operator_id` desc" ;
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

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">

$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'number Que - operator'
            },
            xAxis: {
                categories: ['n-operater', 'n-q']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total number'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -70,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>'+
                        'Total: '+ this.point.stackTotal;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        }
                    }
                }
            }, 

            series: [{
                name: 'available',
                data: [5]
            }, {
                name: 'offline',
                data: [20]
            }, {
                name: 'busy',
                data: [3]
            }, {
                name: 'wait Que',
                data: [0,5], 
                stack: 'nq'
            }]
        });
    });
    
</script>
	</head>
	<body>
<script src="../../js/highcharts.js"></script>
<script src="../../js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</body>
</html>

// SHOW ON PAGES


?>
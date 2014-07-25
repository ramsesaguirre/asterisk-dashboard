<?PHP
function timeDifferent($firstTimeInput,$lastTimeInput)
{
	$firstTimeInput = strtotime($firstTimeInput);
	$lastTimeInput = strtotime($lastTimeInput);
	$timeDifferent = $lastTimeInput - $firstTimeInput;
	return $timeDifferent;
}
include "dbconnection.php";

$sql = " SELECT * FROM `cel` WHERE (`eventtime` like '$date"."%' ) and((`eventtype` = 'ANSWER' and `appname` = 'answer') or (`eventtype` = 'bridge_start' and `appname` = 'dial')) order by `linkedid`, `eventtype` ";

$query = mysql_query($sql);
$row1=null;
$row2=null;
$tag_get2=true;
$hasNext=true;
$count = 0;
while($hasNext){
	if($tag_get2){
		$hasNext=($row1 = mysql_fetch_assoc($query) and $row2 = mysql_fetch_assoc($query));
	}else{
		$hasNext=($row2 = mysql_fetch_assoc($query));
		$tag_get2=true;
		// echo "222222";
	}
	if($hasNext == false) break;
	echo $row1['eventtime'].'====='.$row2['eventtime'].'<br>';
	if($row1['linkedid'] == $row2['linkedid']){
		$tmp = timeDifferent($row1['eventtime'],$row2['eventtime']);
		echo 'different => '.$tmp."<br>";
	}else
	{
		$tag_get2=false;
		$row1=$row2;
		// echo "not match <br>";
	}

}

?>
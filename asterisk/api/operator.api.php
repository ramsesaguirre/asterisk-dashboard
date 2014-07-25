<?php
$operator_name = array("OP-1111","OP-2222","OP-3333"); # Name of Operators
$operator_number = "89000"; # CallCenter Number
$offline = $busy = $available = 0;

$strNotInUse = "Not in use";  # AVALIABLE
$strUnavailable = "Unavailable";  # OFFLINE
$strInUse = "In use"; # BUSY

foreach ($operator_name as $operator) {
$exec = shell_exec("/usr/sbin/asterisk -rx 'queue show {$operator_number}' | grep {$operator}");
# find position string
$posStr = strpos($exec, $strNotInUse);
$posStr2 = strpos($exec, $strUnavailable);
if($posStr == true || $posStr2 == true){
    if($posStr2 == true) $offline++;
    else $available++;
    }
    else $busy++;
}
$sum_status = $offline + $available + $busy;
$realData = array("offline"=>$offline,"available"=>$available,"busy"=>$busy,"sum"=>$sum_status); //offline,available,busy status
$status = array($strNotInUse,$strInUse,$strUnavailable);
echo json_encode(array("realData"=>$realData));
?>
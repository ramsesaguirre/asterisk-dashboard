<?PHP
// $operator_number = "89000";
// $extension = "SIP";
// shell exec command
$tmp = "1. SIP/3000-0000000b (wait: 0:06, prio: 0)";
echo ."before : ".$tmp;
// // $resultexec = shell_exec(" /usr/sbin/asterisk -rx 'queue show {$operator_number}' | grep {$extension} ");
// // if ($resultexec == '') {
// // 	echo "no caller in queue";
// // }else{
// // 	echo $resultexec;
// // }

// // Data Output
$replace = preg_replace("/([ ])/","|",$tmp);
echo $replace;

// $resultexec = shell_exec("/usr/sbin/asterisk -rx 'sip show peers'");
// echo $resultexec;
// $resultreplace =  preg_replace("/([ ]{2,})/","|",$resultexec);
// echo .'</p>'.$resultreplace;
// $results = explode("|", $resultreplace);

?>
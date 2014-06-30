<?PHP
$queue_cmd = ' asterisk -rx "queue show 1175" | grep "SIP" ';
$command = shell_exec($queue_cmd);
$count = substr_count($command, "\n");
echo "$command<p>";
echo "line = $count";
?>
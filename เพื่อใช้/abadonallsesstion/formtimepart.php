
<!DOCTYPE html PUBLIC>
<!DOCTYPE html >
<html 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>test system</title>
</head>
<body>
<form action="index.php" method="post">
time1<br /><input type="text" name="time1" /><br />
time2<br /><input type="text" name="time2" /><br />
timepart<br /><input type="text" name="timepart" /><br />
<input type="submit" />
</form>
</body>
</html>

<?PHP
session_start();
$host = "localhost";
$username = "root";
$password = "abc1234";
$db_name = "asteriskcdrdb";
# connect mySQL #
$connect = mysql_connect($host,$username,$password);
mysql_select_db($db_name);


$_sesstion[timepart]=$_POST[timepart];
$_sesstion[time1]=$_POST[time1];
$_sesstion[time2]=$_POST[time2];

/* TEST CONNECTION */
/*
	if($connect)
	{
		echo "Database Connection Successful !!";
	}
	else
	{
		echo "Failed Connection !!";
	}
*/////
?>
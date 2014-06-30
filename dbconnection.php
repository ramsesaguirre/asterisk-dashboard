<?PHP
$host = "localhost";
$username = "root";
$password = "abc1234";
$db_name = "asteriskcdrdb";
# connect mySQL #
$connect = mysql_connect($host,$username,$password);
mysql_select_db($db_name);
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
*/
?>
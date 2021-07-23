<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();
if(isset($_SESSION['adminuser']))
	{
	header('location:admin_home.php');
	}
	else
	{	
	echo "<body>";
	echo "<div class = 'background'>";
	echo "<div class='textview'>";
	echo "<center>";
	echo "<h1>Leave Management System</h1>";
	include 'navi.php';
	echo "<h2>Admin Login</h2>";
	echo "<form name = 'login' action = 'admin_validation.php' method = 'post' onsubmit = 'check()'>";
	if(isset($_GET['err']))
		{
			echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['err'])."</u></b></div>";
		}
	echo "<table>";
	echo "<tr><td>Username :</td><td><input type = 'text' name = 'uname' class = 'textbox ' placeholder = 'Your Username'></td></tr><br/>";
	echo "<tr><td>Password :</td><td><input type = 'password' name = 'pass' class = 'textbox ' placeholder = 'Your Password'></td></tr><br/>";
	echo "</table>";
	echo "<br><input type = 'submit' value = 'Login' class = 'login-button shadow'><br/>";
    echo "</form>";
	echo "</center>";
	echo "</div>";
	echo "</div>";
	echo "</body>";
	}
?>
<html>
<head>
<title>Leave Management</title>
<link rel="stylesheet" type="text/css" href="style.css">s

<script type = "text/javascript">
function valid()
{
	var user = document.login.uname.value;
	var user = user.trim();
	var pass = document.login.pass.value;
	if (user == '')
		{
			alert("Please Enter Username !");
			return false;
		}
	else if (pass == '')
		{
			alert("Please Enter Password !");
			return false;
		}
	else
		{
			return true;
		}
}
</script>

</head>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>forgot password</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<form class="forgot_pass_form" action="forgot_pass_process.php" method="post">
		<h2 class="form-title">Reset password</h2>
		<!--enter email-->
		    <p> enter your email id which is registered </p>
			<?php

			//when data is not filled
			if(isset($_GET['un_err']))
			{
				$un_err=$_GET['un_err'];
				echo $un_err;
				echo "<br>";
			}

			//normal user errors
			if(isset($_GET['err']))
			{
				$err=$_GET['err'];
				echo '<p class="errmsg">No user found. </p>'.$err;
				echo "<br>";
			}

			//server errors
			if(isset($_GET['server_err']))
			{
				echo "<p>there is some sever error</p>";
			}

			//query time error
			if(isset($_GET['db_err']))
			{
				echo "<p>there is something wrong while querying the database <br> Please try once again using valid credentials!!!";
			}
			
			//sucess message
			if(isset($_GET['sent']))
			{
				$sent=$_GET['sent'];
				echo $sent;
				echo "<br> Kindly check your email. It can be taken 2 to 3 minutes to deliver on your email id .</p>";
			}

			//when mail is not sent
			?>
			<label>Your email address</label>
			<input type="email" name="email" class='textbox ' placeholder ='Your email id'>
			<button type="submit" name="fp_reset_form" class="login-btn">send link</button>
		
	</form>
</body>
</html>
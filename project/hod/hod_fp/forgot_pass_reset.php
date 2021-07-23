<?php 
include "../connect_db.php";
if(isset($_SESSION['hoduser']))
{
	header('location:client_home.php');
}
else
{
	?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php
	if(isset($_GET['token']))
	{
		$token=$_GET['token'];
	}
	if(isset($_POST['new_password']))
	{
	  extract($_POST);
		//querying database
		$fetchresultok = mysqli_query($connection, "SELECT email FROM pass_reset WHERE token='$token'");
		
		if($res = mysqli_fetch_array($fetchresultok))
		{
		  $email= $res['email'];
		  echo $email; 
		}
		if(isset($email) != '' ) 
		{
		  $emailtok=$email;
		  echo "<br>";
		  echo "here";
		}
		else 
		{ 
		  $error[] = 'Link has been expired or something missing ';
		  $hide=1;
		}
		if(!isset($error))
		{
		  $options = array("cost"=>4);
		  $pass_c = password_hash($new_pass,PASSWORD_BCRYPT,$options);
		  echo "<br>";
		  echo "here";
		  $resultresetpass= mysqli_query($connection, "UPDATE users SET password='$pass_c' WHERE email='$emailtok'"); 
		  if($resultresetpass)
		   { 
			 $success= "<div class='successmsg'>
						 <span style='font-size:100px;'>&#9989;</span>
						 <br> Your password has been updated successfully.. <br>
						 </div>";
			 $resultdel = mysqli_query($connection, "DELETE FROM pass_reset WHERE token='$token'");
			 $hide=1;
			}
		}
	}
	?>
	<form name="fp_reset" class="login-form" action="" method="post" onsubmit="validation()">
		<h2 class="form-title">New password</h2>
		<!-- form validation messages -->
		<?php 
        if(isset($error)){
              foreach($error as $error){
                 echo '<div class="errmsg">'.$error.'</div><br>';
              }
        }
        if(isset($success)){
         echo $success;
        }
      ?>
		<div class="form-group">
			<label>New password</label>
			<input type="password" name="new_pass"  minlength="4" maxlength="30">
		</div>
		<div class="form-group">
			<label>Confirm new password</label>
			<input type="password" name="new_pass_c"  minlength="4" maxlength="30">
		</div>
		<div class="form-group">
			<button type="submit" name="new_password" class="login-btn">Submit</button>
		</div>
	</form>

	<!-- java script for client side validation -->

	<script type="text/javascript">
	function validation()
	{
		var pass=document.fp_reset.new_pass.value;
		var pass_c=document.fp_reset.new_pass_c.value;
		if (pass=='')
		{
			alert("please enter password");
			return false;
		}
		else if(pass_c=='')
		{
			alert("please confirm your password!");
		}
		else if(pass!=pass_c)
		{
			alert("passwords are not matching!!");
			return false;
		}
		else
		{
			return true;
		}
	}
	</script>
	

</body>
</html>
<?php
}
?>
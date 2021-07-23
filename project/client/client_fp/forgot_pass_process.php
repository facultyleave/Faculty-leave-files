
<?php
session_start();
include "../connect_db.php";
if(isset($_POST['fp_reset_form']))
{
  $login_mail=$_POST['email'];
  echo "<br>";
  echo $login_mail;
  echo "<br>";
  echo "here";
  $query= "select * from users where email = '$login_mail'";
  echo "<br>";
  var_dump($query);
  echo "<br>";
  $db_query = mysqli_query($connection,$query);
  echo "<br>";
  var_dump($db_query);
  echo "<br>";
  $result= mysqli_fetch_array($db_query);
  echo "<br>";
  var_dump($result);
  echo "<br>";
  if($result)
  {
    $to_mail=$result['email'];
    $token = bin2hex(random_bytes(50));
    echo "<br>";
    echo $to_mail;
    echo "<br>";
    echo $token;
    $insert_query = "insert into pass_reset values ('','$to_mail','$token')";
    $insert_query_res = mysqli_query($connection,$insert_query);
    if($insert_query_res)
    {
      echo "<br>";
      echo "here";
      echo "<br>";
      $subject="You have received mai to reset your password";
      $FromName="leave_manager";
      $FromEmail="b19cs095@kitsw.ac.in";
      $ReplyTo="b19cs090@kitsw.ac.in";
      $credits="All rights are reserved | leave manager";
      // Set content-type header for sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= "From: ".$FromName." <".$FromEmail.">\n";
      $headers .= "Reply-To: ".$ReplyTo."\n";
      $headers .= "X-Sender: <".$FromEmail.">\n";
      $headers .= "X-Mailer: PHP\n"; 
      $headers .= "X-Priority: 1\n"; 
      $headers .= "Return-Path: <".$FromEmail.">\n";
      $msg="<pre>Hello ".$to_mail."!. 
                 You have recieved this mail as you requested to reset the password.
                 You can reset your password by clicking on this link or copying it 
                 and pasting in the new window.
                 here is your link <br>
                 http://localhost:80/project/client/client_fp/forgot_pass_reset.php?token=".$token."<br>
                 or you can click on this
                 <a href='http://localhost:80/project/client/client_fp/forgot_pass_reset.php?token=".$token."'style=' background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Click To Reset password</a>
                 <br>
                 
                 we are sorry but there is no decline option.
            </pre>
            <center>".$credits."</center>"; 
      if(mail($to_mail,$subject,$msg,$headers,$FromEmail))
      {
        header("location:forgot_password.php?sent=".urlencode('Reset link has been sent to your registered email id'));
        $hide='1';
      }
      else
      {
        header("location:forgot-password.php?db_err=1");
      }
    }
    else
    {
      header(location:"location:forgot-password.php?something_wrong=1");
    }
  }
  else
  {
    header("location:forgot-password.php?err=".$login);
  }

}
else

{
  header('location:forgot_password.php?un_err='.urlencode('please fill the form first'));
}

?>
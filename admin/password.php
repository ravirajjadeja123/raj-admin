<?php
session_start();
include ("../includes/config.inc.php");

if((isset($_POST['username']) && $_POST['username']!='' ) && (isset($_POST['password']) && $_POST['password']!=''))
{


// escape variables for security
$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);

  $query="SELECT * FROM admin WHERE username='$username' AND password='".md5($password)."' AND status=1";
  $result=mysqli_query($con,$query);
  $data=mysqli_fetch_object($result);

  if(mysqli_num_rows($result)>0)
  {
      if($username=$data->username && $password=$data->password)
      {
          if(isset($_POST['remember_me']))
          {
            setcookie("ADMIN_COOKIE_USERNAME", $data->username, time() + (86400 * 30)*60, "/");
          }
          $_SESSION["ADMIN_SESS_USERID"]=$data->id;
          $_SESSION["ADMIN_SESS_USERNAME"]=$data->username;
          $_SESSION["ADMIN_SESS_USERTYPE"]=$data->type;
          $_SESSION["ADMIN_SESS_USERPASSWORD"]=$data->password;
          location(ADMIN_URL."deskboard.php");
      }
      else
      {
          location(ADMIN_URL."index.php?pas=3");
      }
  }
  else
  {
      location(ADMIN_URL."index.php?pas=2");
  } 
}
else
{
  location(ADMIN_URL."index.php?pas=1");
}
?>
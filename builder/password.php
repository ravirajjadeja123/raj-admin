<?php
session_start();
include ("../includes/config.inc.php");

if((isset($_POST['username']) && $_POST['username']!='' ) && (isset($_POST['password']) && $_POST['password']!='') && (isset($_POST['type']) && $_POST['type']!=''))
{

// escape variables for security
$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$usertype = mysqli_real_escape_string($con, $_POST['type']);

  $query="SELECT * FROM user WHERE username='$username' AND password='".md5($password)."' AND usertype='$usertype' AND admin_builder=1 AND status=1";
  $result=mysqli_query($con,$query);
  $data=mysqli_fetch_object($result);

  if(mysqli_num_rows($result)>0)
  {
      if($username=$data->username && $password=$data->password)
      {
          if(isset($_POST['remember_me']))
          {
            setcookie("BUILDER_COOKIE_USERNAME", $data->username, time() + (86400 * 30)*60, "/");
          }
          $_SESSION["BUILDER_SESS_USERID"]=$data->id;
          $_SESSION["BUILDER_SESS_USERNAME"]=$data->username;
          $_SESSION["BUILDER_SESS_USERTYPE"]=$data->usertype;
          $_SESSION["BUILDER_SESS_USERPASSWORD"]=$data->password;
          location(BUILDER_URL."deskboard.php");
      }
      else
      {
          location(BUILDER_URL."index.php?pas=3");
      }
  }
  else
  {
      location(BUILDER_URL."index.php?pas=2");
  } 
}
else
{
  location(BUILDER_URL."index.php?pas=1");
}
?>
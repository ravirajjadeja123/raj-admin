<?php
require("../include/config.inc.php");


if((isset($_REQUEST['name']) && $_REQUEST['name']!='' ) && (isset($_REQUEST['pass']) && $_REQUEST['pass']!=''))
{

// escape variables for security
$username = mysqli_real_escape_string($con, $_REQUEST['name']);
$password = md5(mysqli_real_escape_string($con, $_REQUEST['pass']));

$query="SELECT * FROM admin WHERE username='$username' AND password='$password' AND status=1";

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
          $_SESSION["ADMIN_SESS_USERTYPE"]=$data->type;
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
<?php
if(!isset($_SESSION['ADMIN_SESS_USERID']))
{
	location(ADMIN_URL."index.php");
}
else
{


	$query="SELECT * FROM admin WHERE id='".$_SESSION["ADMIN_SESS_USERID"]."' AND password='".$_SESSION["ADMIN_SESS_USERPASSWORD"]."' AND type='".$_SESSION["ADMIN_SESS_USERTYPE"]."' AND status=1";
  	$result=mysqli_query($con,$query);
  	$data=mysqli_fetch_object($result);

	  if(mysqli_num_rows($result)>0)
	  {
	      if($username=$data->username && $password=$data->password)
	      {
	          
	      }
	      else
	      {
		        location(ADMIN_URL."logout.php");
	      }
	  }
	  else
	  {
			location(ADMIN_URL."logout.php");
	  } 
}
?>
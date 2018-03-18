<?php
if(!isset($_SESSION['BUILDER_SESS_USERID']) || !isset($_SESSION["BUILDER_SESS_USERTYPE"]))
{
	location(BUILDER_URL."index.php");
}
else
{
	$query="SELECT * FROM user WHERE id='".$_SESSION["BUILDER_SESS_USERID"]."' AND password='".$_SESSION["BUILDER_SESS_USERPASSWORD"]."' AND usertype='".$_SESSION['BUILDER_SESS_USERTYPE']."' AND admin_builder=1 AND status=1";
  	$result=mysqli_query($con,$query);
  	$data=mysqli_fetch_object($result);

	  if(mysqli_num_rows($result)>0)
	  {
	      if($username=$data->username && $password=$data->password)
	      {
	          
	      }
	      else
	      {
		        location(BUILDER_URL."logout.php");
	      }
	  }
	  else
	  {
			location(BUILDER_URL."logout.php");
	  } 
}
?>
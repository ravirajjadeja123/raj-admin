<?php
if(!isset($_SESSION['ADMIN_SESS_USERID']))
{
	location(ADMIN_URL."index.php");
}
?>
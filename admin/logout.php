<?php
include("../includes/config.inc.php");
session_start();
	unset($_SESSION["ADMIN_SESS_USERID"]);
    unset($_SESSION["ADMIN_SESS_USERTYPE"]);
    unset($_SESSION["ADMIN_SESS_USERPASSWORD"]);
  location(ADMIN_URL."index.php");
?>
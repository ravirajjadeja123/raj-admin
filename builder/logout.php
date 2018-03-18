<?php
include("../includes/config.inc.php");
session_start();
	unset($_SESSION["BUILDER_SESS_USERID"]);
    unset($_SESSION["BUILDER_SESS_USERTYPE"]);
  location(BUILDER_URL."index.php");
?>
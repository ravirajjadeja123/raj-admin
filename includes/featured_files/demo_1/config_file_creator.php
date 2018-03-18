<?php

//-----Config Creation-----//
$config_file_data='<?php 
  error_reporting(1);
  session_start();
   // 0 == warning and notification message hide 
  //compalsary start in config file
  /* for server */

  if($_SERVER["SERVER_NAME"] == "localhost") 
  {
    define("DB_HOST","localhost");
    define("DB_USER","root");
    define("DB_PASS","");
    define("DB_NAME","'.$result->database_name.'");

    define("SITE_URL","'.$result->site_url.'");
    define("ADMIN_URL",SITE_URL."adminpanel/");
    define("DIR_URL",$_SERVER["DOCUMENT_ROOT"]."/'.$result->project_name.'/");
    define("DIR_ADMIN",DIR_URL."adminpanel/");
  }
  else
  {
    define("DB_HOST","");
    define("DB_USER","");
    define("DB_PASS","");
    define("DB_NAME","");
    define("SITE_URL","");
    define("ADMIN_URL",SITE_URL."adminpanel");
    define("DIR_URL",$_SERVER["DOCUMENT_ROOT"]."/");
    define("DIR_ADMIN",DIR_URL."adminpanel/");
  }
  $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("Host Not Found.");
  /* for client */
  //browser path

  define("SITE_NAME","'.$result->project_name.'");
  define("SITE_TITLE","Welcome to '.$result->project_name.'");
  define("SITE_UPD", SITE_URL."uploads/");
  define("SITE_JS", SITE_URL."js/");  
  define("SITE_IMG", SITE_URL."images/");
  define("SITE_CSS", SITE_URL."css/");  
  define("SITE_INC", SITE_URL."includes/"); 

  //directory path
  define("DIR_IMG", DIR_URL."images/");
  define("DIR_UPD", DIR_URL."uploads/");        
  
  /* for admin */
  define("SITE_ADMIN_URL", SITE_URL."admin/");
  define("SITE_ADM_CSS", SITE_ADMIN_URL."css/");
  define("SITE_ADM_IMG", SITE_ADMIN_URL."images/");
  define("SITE_ADM_JS", SITE_ADMIN_URL."js/");
  define("SITE_ADM_UPD", SITE_ADMIN_URL."uploads/");  
  define("DIR_ADMIN_URL", DIR_URL."admin/");  

  /* SMTP Mail */
  define("SMTP_USERNAME","");
  define("SMTP_PASSWORD","");

  define("SMTP_HOST","smtp.gmail.com");
  define("SMTP_PORT","465");
  define("FROM_NM","");
  define("FROM_EMAIL","");

  /* Paypal */
  define("PAYPAL_BUSINESS", "");
  require_once("smtp/class.phpmailer.php");

  require("function.php");
  //require("functions.php");

  //require("sendmail.php");
?>';



$Config_FileName = PROJECT_STORAGE.$result->project_name."/include/config.inc.php";
$Config_FileHandle = fopen($Config_FileName, 'w') or die("can't open file");
fwrite($Config_FileHandle, $config_file_data);
fclose($Config_FileHandle);
//-----Ending Config File Creation-----//
?>
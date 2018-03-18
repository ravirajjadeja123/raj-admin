<?php 
	error_reporting(0);
	session_start();
	 // 0 == warning and notification message hide 
	//compalsary start in config file
	/* for server */

	if($_SERVER["SERVER_NAME"] == 'localhost') 
	{
		define("DB_HOST","localhost");
		define("DB_USER","root");
		define("DB_PASS","");
		define("DB_NAME","bss");

		define('SITE_URL','http://localhost/raj-admin/');
		define('ADMIN_URL',SITE_URL.'admin/');
		define('DIR_URL',$_SERVER["DOCUMENT_ROOT"].'/raj-admin/');
		define('DIR_ADMIN',DIR_URL.'admin/');

		define('BUILDER_URL',SITE_URL.'builder/');
	}
	else
	{
		define("DB_HOST","localhost");
		define("DB_USER","id4867406_db_user");
		define("DB_PASS","db_password");
		define("DB_NAME","id4867406_bss_db");
		define('SITE_URL','https://ravirajjaeja7726.000webhostapp.com/');
		define('ADMIN_URL',SITE_URL.'admin/');
		define('DIR_URL',$_SERVER["DOCUMENT_ROOT"].'/');
		define('DIR_ADMIN',DIR_URL.'admin/');

		define('BUILDER_URL',SITE_URL.'builder/');
	}

	$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Host Not Found.');
	/* for client */
	//browser path
	define('PROJECT_STORAGE',DIR_URL.'projects/');
	define("SITE_NAME","RAJ GROUP");
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
	define('SMTP_USERNAME','ncttrainingcenter@gmail.com');
	define('SMTP_PASSWORD','ncrypted123');

	define('SMTP_HOST','smtp.gmail.com');
	define('SMTP_PORT','465');
	define('FROM_NM','Foram');
	define('FROM_EMAIL','sforam007@gmail.com');

	/* Paypal */
	define("PAYPAL_BUSINESS", "tester@ncrypted.com");	
	
	require_once("smtp/class.phpmailer.php");
	include("function.php");
	include("functions.php");
?>
<?php 
  require("../include/config.inc.php");
  require("security.php");
  $LeftLinkSection = 1;
  $Error=0;
  $Message="";

$query = "SELECT * FROM admin WHERE id=".$_SESSION["ADMIN_SESS_USERID"];
$result = mysqli_query($con,$query);
$row = mysqli_fetch_object($result);

  if(isset($_POST['Submit']))
  {
     if((isset($_POST['new_password']) && $_POST['new_password']!='') && (isset($_POST['confirm_new_password']) && $_POST['confirm_new_password']!=''))
     {  
        if ($_POST['new_password']==$_POST['new_password']) {
            $name=md5($_POST['new_password']);
            $query = "UPDATE admin SET password='$name' WHERE id=".$_SESSION["ADMIN_SESS_USERID"];
            $result = mysqli_query($con,$query);
            $Message = "Password Changed Successfully"; 
        }
        else
         {
            $Message = "New Password and Confirm New Password not match Successfully!."; 
         }     
     }
     else
     {
        $Message = "Blank Now allowed."; 
     }
 }



?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <title>My Account | <?php echo SITE_NAME; ?></title>
    
    <!--[if lt IE 9]> <script src="assets/plugins/common/html5shiv.js" type="text/javascript"></script> <![endif]-->
    <script src="js/modernizr.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.3.custom.css" />
    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="assets/plugins/jquery-ui/jquery.ui.1.10.2.ie.css"/><![endif]-->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel='stylesheet' type='text/css' href="css/open-sans.css">
    
    <link href="css/main.css" rel="stylesheet" type="text/css"/>
    <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="css/style_default.css" rel="stylesheet" type="text/css"/>
    
    <link rel="icon" type="image/png" href="images/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/apple-touch-icon-144x144-precomposed.png">

 <SCRIPT language=javascript src="body.js"></SCRIPT>
<script>
function valid()
{
    if(document.addprod.name.value=="")
    {
        alert("Enter Password");
        document.addprod.name.select();
        return false;
    }
}
</script>   
    
</head>
<body>

   <?php include("top.php"); ?>

    <div id="container">    <!-- Start : container -->

       <?php include("left.php"); ?>

        <div id="content">  <!-- Start : Inner Page Content -->

            <div class="container"> <!-- Start : Inner Page container -->

                <div class="crumbs">    <!-- Start : Breadcrumbs -->
                    <ul id="breadcrumbs" class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="deskboard.php">Dashboard</a>
                        </li>
                        
                        <li class="current">My Account</li>
                    </ul>

                </div>  <!-- End : Breadcrumbs -->

                <div class="page-header">   <!-- Start : Page Header -->
                    <div class="page-title">
                        <h3>My Account</h3>                        
                    </div>
                </div>  <!-- End : Page Header -->
                <?php if($Message) { ?>
                    <div class="alert alert-danger show">
                        <button class="close" data-dismiss="alert"></button>
                        <?php echo $Message; ?>
                    </div>
                <?php  } ?>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"><i class="fa fa-bars"></i>
                                         My Account
                                </div>
                            </div>
                            <div class="portlet-body">
                                
                                <form class="form-horizontal row-border" id="validate-1" novalidate="novalidate" name=addprod  method=post enctype="multipart/form-data" onsubmit="javascript: return bss_check();">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">
                                          New Password <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="new_password" id="new_password" value="" class="form-control required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">
                                            Confirm New Password <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="confirm_new_password" id="confirm_new_password" value="" class="form-control required">
                                        </div>
                                    </div>

                                    

                                    <div class="form-actions">
                                        <input name="Submit" type="submit" value="Update" class="btn green pull-right">
                                    </div>

                                </form>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                   
                </div>

            </div>  <!-- End : Inner Page container -->

        </div>  <!-- End : Inner Page Content -->
        <a href="javascript:void(0);" class="scrollup">Scroll</a>
    </div>  <!-- End : container -->
    
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="js/jquery.event.move.js"></script>
    <script type="text/javascript" src="js/lodash.compat.js"></script>
    <script type="text/javascript" src="js/respond.min.js"></script>
    <script type="text/javascript" src="js/excanvas.js"></script>
    <script type="text/javascript" src="js/breakpoints.js"></script>
    <script type="text/javascript" src="js/touch-punch.min.js"></script>
    
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    
    <script>
        $(document).ready(function(){
            App.init();
            FormValidation.init();
        });        
    </script>
    <script language="javascript">
function bss_check()
{
    /* -------------- Category Validation --------------------- */
    if(document.getElementById("new_password").value.split(" ").join("") == "" || document.getElementById("new_password").value.split(" ").join("") == "0")
    {
        alert("Please enter New Password.");
        document.getElementById("new_password").focus();
        return false;
    }
    if(document.getElementById("confirm_new_password").value.split(" ").join("") == "" || document.getElementById("confirm_new_password").value.split(" ").join("") == "0")
    {
        alert("Please enter Confirm New Password.");
        document.getElementById("confirm_new_password").focus();
        return false;
    }
}
</script>                             
</body>
</html>
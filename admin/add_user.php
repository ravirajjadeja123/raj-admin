<?php 
  include("../includes/config.inc.php");
  include("security.php");
  
  $pagetitle="User";
if(isset($_REQUEST["id"]) && $_REQUEST["id"] > 0)
{
  $id = $_REQUEST["id"];
  $fetchquery = "SELECT * FROM `user` where id=".$id;
  $result = mysqli_query($con,$fetchquery);
  if(mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_array($result))
    {
        $firstname=mysqli_real_escape_string($con, $row['firstname']);
        $lastname=mysqli_real_escape_string($con, $row['lastname']);
        $username_a=mysqli_real_escape_string($con, $row['username']);
        $usertype=mysqli_real_escape_string($con, $row['usertype']);
        $status= mysqli_real_escape_string($con, $row['status']);
        $admin_builder= mysqli_real_escape_string($con, $row['admin_builder']);
    }
  }
}
if(isset($_REQUEST['Submit']))
{
  $id= mysqli_real_escape_string($con, $_REQUEST['user_id']);
  $firstname=mysqli_real_escape_string($con, $_REQUEST['firstname']);
  $lastname=mysqli_real_escape_string($con, $_REQUEST['lastname']);
  $username=mysqli_real_escape_string($con, $_REQUEST['username']);
  $password=mysqli_real_escape_string($con, $_REQUEST['password']);
  $usertype=mysqli_real_escape_string($con, $_REQUEST['usertype']);
  $admin_builder=mysqli_real_escape_string($con, $_REQUEST['admin_builder']);
  $status= mysqli_real_escape_string($con, $_REQUEST['status']);

  if(isset($id)>0 && $id!='')
  {
    if(GTG_is_dup_edit($con,'user','username',$username,$id))
    {
        location(ADMIN_URL."add_user.php?msg=4&id=$id&mode=edit");
      return;
    }
    if(GTG_is_dup_edit($con,'user','password',md5($password),$id))
    {
        location(ADMIN_URL."add_user.php?msg=4&id=$id&mode=edit");
      return;
    }
      $query = "UPDATE `user` SET `firstname`='$firstname',`lastname`='$lastname',`username`='$username',admin_builder='$admin_builder',`usertype`='$usertype',`status`='$status',`updated`='".date("Y-m-d H:i:s")."'";
      $query.=" WHERE id=".$id;
      mysqli_query($con,$query) or die(mysqli_error());
      location(ADMIN_URL."manage_user.php?msg=2");
  }
  else
  {
    if(GTG_is_dup_add($con,'user','username',$username))
    {
      location(ADMIN_URL."add_user.php?msg=4");
      return;
    }
    if(GTG_is_dup_add($con,'user','password',md5($username)))
    {
      location(ADMIN_URL."add_user.php?msg=4");
      return;
    }
    $query = "INSERT INTO `user` SET `firstname`='$firstname',`lastname`='$lastname',`username`='$username',`password`='".md5($password)."',admin_builder='$admin_builder',`usertype`='$usertype',`status`='$status',`created`='".date("Y-m-d H:i:s")."'";
		mysqli_query($con,$query) or die(mysqli_error());
		location(ADMIN_URL."manage_user.php?msg=1");
  }
}

if(isset($_REQUEST['mode']))
{
  switch($_REQUEST['mode'])
  {
    case 'delete' :
      $query = "DELETE FROM user WHERE id=".$_REQUEST['id'];
      mysqli_query($con,$query) or die(mysqli_error());
      location(ADMIN_URL."manage_user.php?msg=3");      
    break;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo SITE_NAME;?> | <?php echo $pagetitle; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/dist/css/skins/_all-skins.min.css">
  
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/iCheck/all.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include("includes/header.php"); ?>
  <?php include("includes/sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo (isset($_GET["id"])>0)?"Edit ":"Add "; ?><?php echo $pagetitle; ?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $pagetitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <?php if(isset($_GET["msg"])) { ?>
    <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>
  <?php
            if($_GET["msg"]==1)
                    echo "User Added Successfully.";
            elseif($_GET["msg"]==2)
                    echo "User Updated Successfully.";
            elseif($_GET["msg"]==3)
                    echo "User Deleted Successfully.";
            elseif($_GET["msg"]==4)
                    echo "User with this name is already Exist."; 
            elseif($_GET["msg"]==5)
                    echo "This User is in use. You can not delete this User.";
            elseif($_GET["msg"]==6)
                    echo "User Status Updated Successfully.";
    ?>
        </div>
<?php } ?> 
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo (isset($_GET["id"])>0)?"Edit ":"Add "; ?><?php echo $pagetitle; ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="add_user.php" method="post" name="frm" enctype="multipart/form-data" onSubmit="javascript:return validation_check();" novalidate="novalidate">
              <input type="hidden" name="user_id" class="form-control" id="user_id" value="<?php echo $id;?>">
              <div class="box-body">
                
                <div class="form-group">
                  <label>Firstname</label>
                  <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" value="<?php echo $firstname;?>">
                </div>
                
                <div class="form-group">
                  <label>Lastname</label>
                  <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name" value="<?php echo $lastname;?>">
                </div>

                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" id="username" placeholder="User Name" value="<?php echo $username_a;?>">
                </div>

<?php if(isset($_GET["id"])>0){}else{
?>
<div class="form-group">
                  <label>Password</label>
                  <input type="text" name="password" class="form-control" id="password" placeholder="Password" value="">
                </div>
<?php
}
 ?>
                

                <div class="form-group">
                  <label>Usertype</label>
                  <select class="form-control" name="usertype">
                    <option value="">Select</option>
                    <option value="developer" <?php echo ($usertype=='developer')?'selected="selected"':''; ?> >Developer</option>
                    <option value="projectmanager" <?php echo ($usertype=='projectmanager')?'selected="selected"':''; ?>>Project Manager</option>
                    <option value="hrexcutive" <?php echo ($usertype=='hrexcutive')?'selected="selected"':''; ?>>HR excutive</option>
                  </select>
                </div>



<div class="form-group">
                  <label>Builder Access</label>
                  <div class="form-group">
                <label>
                  <input type="radio" name="admin_builder" id="admin_builder" value="1" class="minimal" 
                  <?php  
                  if(isset($admin_builder))
                  {
                    if($admin_builder=='1')
                    {
                      echo 'checked="checked"';
                    }
                  }
                  ?>>
                  Active
                </label>
                <label>
                  <input type="radio" name="admin_builder" id="admin_builder" value="0" class="minimal" <?php  
                  if(isset($admin_builder))
                  {
                    if($admin_builder=='0')
                    {
                      echo 'checked="checked"';
                    }
                  }
                  ?> >
                  Deactive
                </label>
              </div>
                </div>













                <div class="form-group">
                  <label>Status</label>
                  <div class="form-group">
                <label>
                  <input type="radio" name="status" id="status" value="1" class="minimal" 
                  <?php  
                  if(isset($status))
                  {
                    if($status=='1')
                    {
                      echo 'checked="checked"';
                    }
                  }
                  ?>>
                  Active
                </label>
                <label>
                  <input type="radio" name="status" id="status" value="0" class="minimal" <?php  
                  if(isset($status))
                  {
                    if($status=='0')
                    {
                      echo 'checked="checked"';
                    }
                  }
                  ?> >
                  Deactive
                </label>
              </div>
                </div>
              </div>
              <div class="box-footer">
<?php
if(isset($_GET["id"])>0)
{
  ?>
    <input name="Submit" type="submit" value="Edit" class="btn btn-primary">
<?php
}
else
{
  ?>
    <input name="Submit" type="submit" value="Add" class="btn btn-primary">
<?php }
?>
              </div>
            </form>
          </div>

        </div>
        <!--/.col (left) -->
        <!-- right column -->
     
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include("includes/footer.php");?>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo SITE_URL; ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo SITE_URL; ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Icheck -->
<script src="<?php echo SITE_URL; ?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo SITE_URL; ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SITE_URL; ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo SITE_URL; ?>assets/dist/js/demo.js"></script>
</body>
</html>
<script type="text/javascript">
  function validateCode(name){
      var TCode = name;
      for(var i=0; i<TCode.length; i++)
      {
        var char1 = TCode.charAt(i);
        var cc = char1.charCodeAt(0);

        if((cc>47 && cc<58) || (cc>64 && cc<91) || (cc>96 && cc<123))
        {

        }
        else
        {
          return false;
        }
      }
     return true;     
   }
  function validation_check() 
  {
      /* -------------- Main Menu Validation --------------------- */
      if(document.getElementById("client_name").value.split(" ").join("") == "" || document.getElementById("client_name").value.split(" ").join("") == "0")
      {
        alert("Please Enter Client name.");
        document.getElementById("client_name").focus();
        return false;
      }
      else
      {
        if(validateCode(document.getElementById("client_name").value.split(" ").join(""))){}
        else
        {
          alert('Only Alphabatic and Numberic Value Allow in Client Name.');
          return false;
        }

      }
      var status = document.getElementsByName('status');
      if (!status[0].checked && !status[1].checked)
      {
      	alert('Please Select Status');
      	return false;
      }
  }
  $(function () {
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      radioClass: 'iradio_minimal-blue'
    });
  });
$( document ).ready(function(){
  $('.alert').fadeIn('slow', function(){
     $('.alert').delay(5000).fadeOut(); 
  });
});
</script>

<?php 
  include("../includes/config.inc.php");
  include("security.php");
  
  $pagetitle="Project";
if(isset($_REQUEST["id"]) && $_REQUEST["id"] > 0)
{
  $id = $_REQUEST["id"];
  $fetchquery = "SELECT * FROM `project` where id=".$id;
  $result = mysqli_query($con,$fetchquery);
  if(mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_array($result))
    {
		$client_id = mysqli_real_escape_string($con, $row['client_id']);
		$project_name = mysqli_real_escape_string($con, $row['project_name']);
		$database_name = mysqli_real_escape_string($con, $row['database_name']);
		$site_url = mysqli_real_escape_string($con, $row['site_url']);
		$status = mysqli_real_escape_string($con, $row['status']);
    }
  }
}
if(isset($_REQUEST['Submit']))
{
	$id = mysqli_real_escape_string($con, $_REQUEST['project_id']);
	$client_id = mysqli_real_escape_string($con, $_REQUEST['client_id']);
	$project_name = mysqli_real_escape_string($con, $_REQUEST['project_name']);
	$database_name = mysqli_real_escape_string($con, $_REQUEST['database_name']);
	$site_url = mysqli_real_escape_string($con, $_REQUEST['site_url']);
	$status = mysqli_real_escape_string($con, $_REQUEST['status']);
  if(isset($id)>0 && $id!='')
  {
    if(GTG_is_dup_edit($con,'project','project_name',$project_name,$id))
    {
      location(ADMIN_URL."add_project.php?msg=4&id=$id&mode=edit");
      return;
    }
      $query = "UPDATE `project` SET `client_id`='$client_id',`project_name`='$project_name',`database_name`='$database_name',`site_url`='$site_url',`status`='$status',`updated`='".date('Y-m-d H:i:s')."'";
      $query.=" WHERE id=".$id;
      mysqli_query($con,$query) or die(mysqli_error());
      location(ADMIN_URL."manage_project.php?msg=2");
  }
  else
  {
    if(GTG_is_dup_add($con,'project','project_name',$project_name))
    {
      location(ADMIN_URL."add_project.php?msg=4");
      return;
    }
      $query = "INSERT INTO `project` SET `client_id`='$client_id',`project_name`='$project_name',`database_name`='$database_name',`site_url`='$site_url',`status`='$status',`created`='".date('Y-m-d H:i:s')."'"; 
    	mysqli_query($con,$query) or die(mysqli_error());
    	location(ADMIN_URL."manage_project.php?msg=1");
  }
}


if(isset($_REQUEST['mode']))
{
  switch($_REQUEST['mode'])
  {
    case 'delete' :
    if(GTG_checkfordelete($con,'section','project_id',$_REQUEST['id']))
    {
      location(ADMIN_URL."manage_project.php?msg=5");
    }
    else
    {
      $query = "DELETE FROM project WHERE id=".$_REQUEST['id'];     
      mysqli_query($con,$query) or die(mysqli_error());
      location(ADMIN_URL."manage_project.php?msg=3");
    }
    break;
  } 
} 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General Form Elements</title>
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

<link rel="stylesheet" href="<?php echo SITE_URL; ?>assets//plugins/iCheck/all.css">
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
                    echo "Project Added Successfully.";
            elseif($_GET["msg"]==2)
                    echo "Project Updated Successfully.";
            elseif($_GET["msg"]==3)
                    echo "Project Deleted Successfully.";
            elseif($_GET["msg"]==4)
                    echo "Project with this name is already Exist."; 
            elseif($_GET["msg"]==5)
                    echo "This Project is in use. You can not delete this Project.";
            elseif($_GET["msg"]==6)
                    echo "Project Status Updated Successfully.";
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
            <form role="form" action="add_project.php" method="post" name="frm" enctype="multipart/form-data" onSubmit="javascript:return validation_check();" novalidate="novalidate">
              <input type="hidden" name="project_id" class="form-control" id="project_id" value="<?php echo $id;?>">
              <div class="box-body">
              	<div class="form-group">
                  <label>Client</label>
                  <select class="form-control" name="client_id" id="client_id">
                  	<option value="">Select</option>
                  	<?php
                  		$getClient=mysqli_query($con,"SELECT * FROM `client` WHERE `status`='1'");
                  		while ($result=mysqli_fetch_object($getClient)) {
                  			?>
                  			<option value="<?php echo $result->id; ?>" <?php echo ($result->id==$client_id)?'selected="selected"':''; ?> ><?php echo $result->client_name; ?></option>
                  			<?php
                  		}
                  	?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Project Name</label>
                  <input type="text" name="project_name" class="form-control" id="project_name" placeholder="Project Name" value="<?php echo $project_name;?>">
                </div>

                <div class="form-group">
                  <label>Database Name</label>
                  <input type="text" name="database_name" class="form-control" id="database_name" placeholder="Database Name" value="<?php echo $database_name;?>">
                </div>
				
				<div class="form-group">
                  <label>Site URL</label>
                  <input type="text" name="site_url" class="form-control" id="site_url" placeholder="Site URL" value="<?php echo $site_url;?>">
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
  function validation_check() 
  {
      /* -------------- Main Menu Validation --------------------- */
      if(document.getElementById("client_id").value.split(" ").join("") == "")
      {
        alert("Please Enter Client name.");
        document.getElementById("client_id").focus();
        return false;
      }
      if(document.getElementById("project_name").value.split(" ").join("") == "")
      {
        alert("Please Enter Project name.");
        document.getElementById("project_name").focus();
        return false;
      }
      if(document.getElementById("database_name").value.split(" ").join("") == "")
      {
        alert("Please Enter Database name.");
        document.getElementById("database_name").focus();
        return false;
      }
      if(document.getElementById("site_url").value.split(" ").join("") == "")
      {
        alert("Please Enter Site URL.");
        document.getElementById("site_url").focus();
        return false;
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

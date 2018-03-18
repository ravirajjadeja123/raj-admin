<?php 
  include("../includes/config.inc.php");
  include("security.php");
  $pagetitle="Section";
if(isset($_REQUEST["id"]) && $_REQUEST["id"] > 0)
{
  $id = $_REQUEST["id"];
  $fetchquery = "SELECT * FROM `section` where id=".$id;
  $result = mysqli_query($con,$fetchquery);
  if(mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_array($result))
    {
		$client_id = mysqli_real_escape_string($con, $row['client_id']);
		$project_id = mysqli_real_escape_string($con, $row['project_id']);
		$section_name = mysqli_real_escape_string($con, $row['section_name']);
		$display_order = mysqli_real_escape_string($con, $row['display_order']);
		$status = mysqli_real_escape_string($con, $row['status']);
    }
  }
}
if(isset($_REQUEST['Submit']))
{
	$id = mysqli_real_escape_string($con, $_REQUEST['section_id']);
	$client_id = mysqli_real_escape_string($con, $_REQUEST['client_id']);
	$project_id = mysqli_real_escape_string($con, $_REQUEST['project_id']);
	$section_name = mysqli_real_escape_string($con, $_REQUEST['section_name']);
	$display_order = mysqli_real_escape_string($con, $_REQUEST['display_order']);
  if(isset($id)>0 && $id!='')
  {
  	if(GTG_is_dup_edit($con,'section','section_name',$section_name,$id))
    {
        location(ADMIN_URL."add_section.php?msg=4&id=$id&mode=edit");
      	return;
    }
      $query = "UPDATE `section` SET `client_id`='$client_id',`project_id`='$project_id',
      `section_name`='$section_name',`display_order`='$display_order',`updated`='".date('Y-m-d H:i:s')."'";
      $query.=" WHERE id=".$id;
      mysqli_query($con,$query) or die(mysqli_error());
      location(ADMIN_URL."manage_section.php?msg=2");
  }
  else
  {
  	if(GTG_is_dup_add($con,'section','section_name',$section_name))
    {
      location(ADMIN_URL."add_section.php?msg=4");
      return;
    }
    $query = "INSERT INTO `section` SET `client_id`='$client_id',`project_id`='$project_id',
      `section_name`='$section_name',`display_order`='$display_order',`created`='".date('Y-m-d H:i:s')."'";
  	mysqli_query($con,$query) or die(mysqli_error());
  	location(ADMIN_URL."manage_section.php?msg=1");
  }
}


if(isset($_REQUEST['mode']))
{
  switch($_REQUEST['mode'])
  {
    case 'delete' :
    if(GTG_checkfordelete($con,'page','section_id',$_REQUEST['id']))
    {
      location(ADMIN_URL."manage_section.php?msg=5");
    }
    else
    {
      $query = "DELETE FROM section WHERE id=".$_REQUEST['id'];     
      mysqli_query($con,$query) or die(mysqli_error());
      location(ADMIN_URL."manage_section.php?msg=3");
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
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo (isset($_GET["id"])>0)?"Edit ":"Add "; ?><?php echo $pagetitle; ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="add_section.php" method="post" name="frm" enctype="multipart/form-data" onSubmit="javascript:return validation_check();" novalidate="novalidate">
              <input type="hidden" name="section_id" class="form-control" id="section_id" value="<?php echo $id;?>">
              <div class="box-body">

              	<div class="form-group">
                  <label>Client</label>
                  <select class="form-control" name="client_id" id="client_id">
                  	<option value="">SELECT CLIENT</option>
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
                  <label>Project</label>
                  <select class="form-control" name="project_id" id="project_id">
                    <option value="">SELECT PROJECT</option>
      <?php 
                    if($client_id!='')
                    {

      $query="SELECT * FROM `project` WHERE client_id=".$client_id;
      $result=mysqli_query($con,$query);
      if(mysqli_num_rows($result)>0)
      {
        while ($data=mysqli_fetch_object($result)) {
          ?>
      <option value="<?php echo $data->id; ?>" <?php echo ($project_id=$data->id)?'selected="selected"':''; ?> ><?php echo $data->project_name; ?></option>
          <?php
        }
      }
                    }
          ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Section Name</label>
                  <input type="text" name="section_name" class="form-control" id="section_name" placeholder="Section Name" value="<?php echo $section_name;?>">
                </div>

                <div class="form-group">
                  <label>Display Order</label>
                  <input type="number" name="display_order" min="0" class="form-control" id="display_order" placeholder="Display Order" onkeypress="javascript:return isNumber(event)" value="<?php echo $display_order;?>">
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
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
  function validation_check() 
  {
      /* -------------- Main Menu Validation --------------------- */
       if(document.getElementById("client_id").value.split(" ").join("") == "")
      {
        alert("Please Select Client name.");
        document.getElementById("client_id").focus();
        return false;
      }
      if(document.getElementById("project_id").value.split(" ").join("") == "")
      {
        alert("Please Select Project.");
        document.getElementById("project_id").focus();
        return false;
      }
      if(document.getElementById("section_name").value.split(" ").join("") == "")
      {
        alert("Please Enter Section name.");
        document.getElementById("section_name").focus();
        return false;
      }
      if(document.getElementById("display_order").value.split(" ").join("") == "" || document.getElementById("display_order").value.split(" ").join("") == "0")
      {
        alert("Please Enter Display Order.");
        document.getElementById("display_order").focus();
        return false;
      }
  }
  $(function () {
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      radioClass: 'iradio_minimal-blue'
    });
  });
  $('#client_id').change(function(){
    var client_id=$(this).val();
      $.ajax({
      url:"ajax/ajax_getProject.php",
      data:{id:client_id},
      method:"post",
      success:function(data){
        $("#project_id").html(data);
        }
    });
  });
$( document ).ready(function(){
  $('.alert').fadeIn('slow', function(){
     $('.alert').delay(5000).fadeOut(); 
  });
});
</script>

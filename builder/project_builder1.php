<?php 
  include("../includes/config.inc.php");
  include("security.php");

if (!isset($_REQUEST['id'])) {
  location(ADMIN_URL.'manage_project.php');
}
  $pagetitle="Client";
  $sel= "SELECT project.*,client.client_name FROM `project` INNER JOIN `client` ON `project`.`client_id`=`client`.`id` WHERE `project`.`id`=".$_REQUEST['id'];
  $sel=mysqli_query($con,$sel);
  $result=mysqli_fetch_object($sel);

  if(mysqli_num_rows($sel)<0)
  {
    echo "<script>alert('Project Not Found..');</script>";
    location(ADMIN_URL.'manage_project.php');
  }


  if (!is_dir(PROJECT_STORAGE.$result->project_name)) {
    mkdir(PROJECT_STORAGE.$result->project_name, 0777, true);
  }
  else
  {
    delete_files(PROJECT_STORAGE.$result->project_name);
    mkdir(PROJECT_STORAGE.$result->project_name, 0777, true);
  }

include("../includes/featured_files/demo_1/copy_folder.php");
 
include("../includes/featured_files/demo_1/linkvars_creator.php");

include("../includes/featured_files/demo_1/db_file_creator.php");
include("../includes/featured_files/demo_1/config_file_creator.php");
include("../includes/featured_files/demo_1/zip_creator.php");

delete_files(PROJECT_STORAGE.$result->project_name.'/');

/*header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="'.$result->project_name.'.zip'.'"');
readfile(PROJECT_STORAGE.$result->project_name.'.zip');*/


//location(ADMIN_URL.'manage_project.php');
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo SITE_NAME; ?> | <?php echo $pagetitle; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  
<?php 
    include("includes/header.php");
    include("includes/sidebar.php");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">


<?php if(isset($_GET["msg"])) { ?>
    <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times</button>
  <?php
            if($_GET["msg"]==1)
                    echo "Client Added Successfully.";
            elseif($_GET["msg"]==2)
                    echo "Client Updated Successfully.";
            elseif($_GET["msg"]==3)
                    echo "Client Deleted Successfully.";
            elseif($_GET["msg"]==4)
                    echo "Client with this name is already Exist."; 
            elseif($_GET["msg"]==5)
                    echo "This Client is in use. You can not delete this Client.";
            elseif($_GET["msg"]==6)
                    echo "Client Status Updated Successfully.";
    ?>
        </div>
<?php } ?> 
 <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-folder-open"></i>

              <h3 class="box-title">Project General Info</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Client Name : </dt>
                <dd><?php echo $result->client_name; ?></dd>
                <dt>Project Name : </dt>
                <dd><?php echo $result->project_name; ?></dd>
                <dt>Database Name : </dt>
                <dd><?php echo $result->database_name; ?></dd>
                <dt>Site URL : </dt>
                <dd><?php echo $result->site_url; ?></dd>
                <dt>Download Link : </dt>
                <dd><a href="<?php echo '../projects/'.$result->project_name.'.zip'; ?>">Downlad Zip of Project</a></dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>



          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include("includes/footer.php");?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="<?php echo SITE_URL; ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo SITE_URL; ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo SITE_URL; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo SITE_URL; ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo SITE_URL; ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo SITE_URL; ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SITE_URL; ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo SITE_URL; ?>assets/dist/js/demo.js"></script>
<!-- page script -->
<style>
     .dataTable > thead > tr > th[class*="sort"]::after{display: none}
}
</style>
<script type="text/javascript">
  function chkDelete()
  {
    return confirm("Are you sure that you want to delete the selected Clients.");
  }

  function deleteConfirm()
  {
    return confirm("Are you sure that you want to delete this Client.");
  }
  $(function () {
      $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    "wrapper":true,
    "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
    language: { search: "","lengthMenu": "_MENU_",searchPlaceholder:"Search" }
    });
  });
  $( document ).ready(function(){
  $('.alert').fadeIn('slow', function(){
     $('.alert').delay(5000).fadeOut(); 
  });
});
</script>
</body>
</html>
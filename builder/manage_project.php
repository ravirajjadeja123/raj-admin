<?php 
  include("../includes/config.inc.php");
  include("security.php");

  $pagetitle="Project";
  $sel= "SELECT `project`.*,`client`.`client_name` FROM `project` INNER JOIN `client` ON `project`.`client_id`=`client`.`id` WHERE `project`.`status`=1 ";
  if(isset($_REQUEST['client_id']) && $_REQUEST['client_id']!='')
  {
    $sel.=" AND `client_id`=".$_REQUEST['client_id'];
  }
  $sel.=" ORDER BY `id`";
  $sel=mysqli_query($con,$sel);
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
    <section class="content-header">
      <h1>
        Manage <?php echo $pagetitle; ?>
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
            <div class="box-body no-border">
              <div class="col-lg-2"></div>
              <div class="col-xs-8 col-lg-6">
                <form name="frmSearch" method="post" action="<?php echo $_SERVER['PHP_SELF']  ?>" >
                  <select class="form-control" name="client_id" id="client_id">
                    <option value="">SELECT CLIENT</option>
                    <?php
                      $getClient=mysqli_query($con,"SELECT * FROM `client` WHERE `status`='1'");
                      while ($result=mysqli_fetch_object($getClient)) {
                        ?>
                        <option value="<?php echo $result->id; ?>" <?php echo ($result->id==$_REQUEST['client_id'])?'selected="selected"':''; ?> ><?php echo $result->client_name; ?></option>
                        <?php
                      }
                    ?>
                  </select>
              </div>
              <div class="col-xs-2 col-lg-2">
                  <input name="Submit" type="submit" value="Search" class="btn btn-primary">
                  </div>
              <div class="col-lg-2"></div>
            </div>
                </form>



          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage <?php echo $pagetitle; ?></h3>
            </div>
            <!-- /.box-header -->

              <form name="frmClientList" method="post" action=""> 

            <div class="box-body table-responsive">
              <table id="example1"  class="inlist table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="text-align:center;vertical-align: middle; width: 13px !important;padding-right: 13px !important;">No</th>
                  <th>Client name</th>
                  <th>Project</th>
                  <th style="width: 1px;">Actions</th>
                </tr>
</thead><tbody>
           
<?php
  $counter=1;
  while ($data=mysqli_fetch_object($sel)) {
?>
                  <tr style="text-align: left;">
                    <td style="text-align:center;vertical-align: middle; width: 13px !important;padding-right: 13px !important;"><?php echo $counter;?></td>
                    <td><?php echo $data->client_name;?></td>
                    <td><?php echo $data->project_name;?></td>

                    <td style="text-align: center;">
                      <div class="btn-group">
                        <?php /* ?><a class="btn btn-info btn-sm" href="#" onclick="window.location.href='add_project.php?id=<?php echo $data->id; ?>&mode=edit'">
                          <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="add_project.php?id=<?php echo $data->id; ?>&mode=delete" onclick="return deleteConfirm();">
                          <i class="glyphicon glyphicon-trash"></i>
                        </a><?PHP */ ?>
                         <a class="btn btn-success btn-sm" href="#" onclick="window.location.href='project_builder1.php?id=<?php echo $data->id; ?>'">
                          BUILD</i>
                        </a>
                      </div>
                    </td>
                  </tr>
<?php
$counter++;
  }
?>
</tbody>
              </table>
              <?PHP /* ?><a href="add_project.php" role="button" class="btn btn-primary">Add New</a><?PHP */ ?>
</form>
                <div id="my-modal" class="modal fade" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Default Modal</h4>
                      </div>
                      <div class="modal-body">
                        <p>One fine body&hellip;</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  
                  <!-- /.modal-dialog -->
                  </div>
                </div>
            </div>
            <!-- /.box-body -->
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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox">
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox">
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
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
		return confirm("Are you sure that you want to delete the selected Project.");
	}
  function deleteConfirm()
  {
    return confirm("Are you sure that you want to delete this Project.");
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
    "responsive": true,
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
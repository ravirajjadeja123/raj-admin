<?php 
  include("../includes/config.inc.php");
  include("security.php");

  if(!isset($_REQUEST['page_id']) && $_REQUEST['page_id']=="")
  {
    location(ADMIN_URL."manage_page.php");
  }
  $pagetitle="Page Field";
  $sel= "SELECT * FROM `field` WHERE `page_id`=".$_REQUEST['page_id']." ORDER BY `id` ASC" ;
  $sel=mysqli_query($con,$sel);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>
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
                    echo "Field Added Successfully.";
            elseif($_GET["msg"]==2)
                    echo "Field Updated Successfully.";
            elseif($_GET["msg"]==3)
                    echo "Field Deleted Successfully.";
            elseif($_GET["msg"]==4)
                    echo "Field with this name is already Exist.";	
            elseif($_GET["msg"]==5)
                    echo "This Field is in use. You can not delete this Field.";
            elseif($_GET["msg"]==6)
                    echo "Field Status Updated Successfully.";
    ?>
        </div>
<?php } ?> 
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage <?php echo $pagetitle; ?></h3>
            </div>
            <!-- /.box-header -->
              <form name="frmClientList" method="post" action=""> 
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
          </th>
                  <th style="text-align:center;vertical-align: middle; width: 13px !important;padding-right: 13px !important;">No</th>
                  <th>Field Label</th>
                  <th>Field Id</th>
                  <th>Field Type</th>
                  <th>Actions</th>
                </tr>
</thead><tbody>
           
<?php
  $counter=1;
  while ($data=mysqli_fetch_object($sel)) {
?>
                  <tr style="text-align: left;">
                    <td style="text-align:center;vertical-align: middle; width: 13px !important;padding-right: 13px !important;"><?php echo $counter;?></td>
                    <td><?php echo $data->field_label;?></td>
                    <td><?php echo $data->field_id;?></td>
                    <td><?php echo $data->field_type;?></td>

                    <td>
                      <div class="btn-group">
                        <a class="btn btn-info btn-sm" href="#" onclick="window.location.href='add_field.php?id=<?php echo $data->id; ?>&client_id=<?php echo $_REQUEST['client_id'];?>&project_id=<?php echo $_REQUEST['project_id'];?>&section_id=<?php echo $_REQUEST['section_id'];?>&page_id=<?php echo $_REQUEST['page_id'];?>'">
                          <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <!--<a class="btn btn-info btn-sm" href="#" onclick="window.location.href='add_client.php?id=<?php echo $data->id; ?>&mode=edit'">
                          <i class="glyphicon glyphicon-pencil"></i>
                        </a>-->

                        <a class="btn btn-danger btn-sm" href="add_field.php?id=<?php echo $data->id; ?>&mode=delete&client_id=<?php echo $_REQUEST['client_id'];?>&project_id=<?php echo $_REQUEST['project_id'];?>&section_id=<?php echo $_REQUEST['section_id'];?>&page_id=<?php echo $_REQUEST['page_id'];?>" onclick="return deleteConfirm();">
                          <i class="glyphicon glyphicon-trash"></i>
                        </a>


                      </div>
                    </td>
                  </tr>
<?php $counter++;} ?>
</tbody>
              </table>

              <a href="add_field.php?client_id=<?php echo $_REQUEST['client_id'];?>&project_id=<?php echo $_REQUEST['project_id'];?>&section_id=<?php echo $_REQUEST['section_id'];?>&page_id=<?php echo $_REQUEST['page_id'];?>" role="submit" class="btn btn-primary">Add New</a>
</form>
                
               </div>
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
<!-- Icheck -->
<script src="<?php echo SITE_URL; ?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- page script -->
<style>
     .dataTable > thead > tr > th[class*="sort"]::after{display: none}
}
</style>
<script type="text/javascript">

  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
    }
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
  $(function () {
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      radioClass: 'iradio_minimal-blue'
    });
  });
  
  /*$('#add_field').click(function(){
    var frmdata=new FormData($("#frm_field")[0]);
    $.ajax({
      method:"post",
      url:"ajax/ajax_saveField.php",
      data:frmdata,
      contentType:false,
      processData:false,
      success:function(data){
        alert(data);
      },
      error:function(err,errcode){
        alert(errcord);
      }
    });
  });*/
  $( document ).ready(function(){
  $('.alert').fadeIn('slow', function(){
     $('.alert').delay(5000).fadeOut(); 
  });
});
</script>
</body>
</html>
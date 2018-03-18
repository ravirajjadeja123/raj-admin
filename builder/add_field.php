<?php 
  include("../includes/config.inc.php");
  include("security.php");
  $pagetitle="Field";
if(!isset($_REQUEST['page_id']) && $_REQUEST['page_id']=="")
  {
    location(BUILDER_URL."manage_page.php");

  }
    $client_id=$_REQUEST['client_id'];
    $project_id=$_REQUEST['project_id'];
    $section_id=$_REQUEST['section_id'];
    $page_id=$_REQUEST['page_id'];
if(isset($_REQUEST["id"]) && $_REQUEST["id"] > 0)
{
  $id = $_REQUEST["id"];
  $fetchquery = "SELECT * FROM `field` where id=".$id;
  $result = mysqli_query($con,$fetchquery);
  if(mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_array($result))
    {
      $client_id=mysqli_real_escape_string($con, $row['client_id']);
      $project_id=mysqli_real_escape_string($con, $row['project_id']);
      $section_id=mysqli_real_escape_string($con, $row['section_id']);
      $page_id=mysqli_real_escape_string($con, $row['page_id']);
      $field_label=mysqli_real_escape_string($con, $row['field_label']);
      $manage_field=mysqli_real_escape_string($con, $row['manage_field']);
      $required_field=mysqli_real_escape_string($con, $row['required_field']);
      $field_id=mysqli_real_escape_string($con, $row['field_id']);
      $display_order=mysqli_real_escape_string($con, $row['display_order']);
      $field_type=mysqli_real_escape_string($con, $row['field_type']);
      $folder_name=mysqli_real_escape_string($con, $row['folder_name']);
      $text_field=mysqli_real_escape_string($con, $row['static']);
      $relative_field=mysqli_real_escape_string($con, $row['relative_field']);
      $multi_select=mysqli_real_escape_string($con, $row['multi_select']);
    }
  }
}
if(isset($_REQUEST['Submit']))
{
  $id= mysqli_real_escape_string($con, $_REQUEST['id']);
  $client_id=mysqli_real_escape_string($con, $_REQUEST['client_id']);
  $project_id=mysqli_real_escape_string($con, $_REQUEST['project_id']);
  $section_id=mysqli_real_escape_string($con, $_REQUEST['section_id']);
  $page_id=mysqli_real_escape_string($con, $_REQUEST['page_id']);
  $field_label=mysqli_real_escape_string($con, $_REQUEST['field_label']);
  $manage_field=mysqli_real_escape_string($con, $_REQUEST['manage_field']);
  $required_field=mysqli_real_escape_string($con, $_REQUEST['required_field']);
  $field_id=mysqli_real_escape_string($con, $_REQUEST['field_id']);
  $display_order=mysqli_real_escape_string($con, $_REQUEST['display_order']);
  $field_type=mysqli_real_escape_string($con, $_REQUEST['field_type']);
  $folder_name=mysqli_real_escape_string($con, $_REQUEST['folder_name']);
  $text_field=mysqli_real_escape_string($con, $_REQUEST['text_field']);
  $relative_field=mysqli_real_escape_string($con, $_REQUEST['relative_field']);
  $multi_select=mysqli_real_escape_string($con, $_REQUEST['multi_select']);
  $created=date("Y-m-d H:i:s");
  if(isset($id)>0 && $id!='')
  {
    if(GTG_is_dup_edit($con,'field',' field_id',$field_id,$id))
      {
          location(BUILDER_URL."add_field.php?msg=4&id=$id&mode=edit&client_id=$client_id&project_id=$project_id&section_id=$section_id&page_id=$page_id");
        return;
      }
      $query = "UPDATE `field` SET `client_id`='$client_id', `project_id`='$project_id', `section_id`='$section_id',`manage_field`=$manage_field, `page_id`='$page_id', `field_label`='$field_label', `field_id`='$field_id', `display_order`='$display_order', `required_field`='$required_field', `field_type`='$field_type', `folder_name`='$folder_name', `static`='$text_field', `relative`='$relative_field', `multiselect`='$multi_select',`created`='$created'"; 
      $query.=" WHERE id=".$id;
      mysqli_query($con,$query) or die(mysqli_error());
      location(BUILDER_URL."manage_field.php?client_id=$client_id&project_id=$project_id&section_id=$section_id&page_id=$page_id&msg=2");
  }
  else
  {
    if(GTG_is_dup_add($con,'field','field_id',$field_id))
    {
      location(BUILDER_URL."add_field.php?msg=4&client_id=$client_id&project_id=$project_id&section_id=$section_id&page_id=$page_id");
      return;
    }
    $query = "INSERT INTO `field` SET `client_id`='$client_id', `project_id`='$project_id', `section_id`='$section_id',`manage_field`=$manage_field, `page_id`='$page_id', `field_label`='$field_label', `field_id`='$field_id', `display_order`='$display_order', `required_field`='$required_field', `field_type`='$field_type', `folder_name`='$folder_name', `static`='$text_field', `relative`='$relative', `multiselect`='$multi_select',`created`='$created'";
		mysqli_query($con,$query) or die(mysqli_error());
		location(BUILDER_URL."manage_field.php?client_id=$client_id&project_id=$project_id&section_id=$section_id&page_id=$page_id&msg=2");
  }
}


if(isset($_REQUEST['mode']))
{
  switch($_REQUEST['mode'])
  {
    case 'delete' :
      $query = "DELETE FROM field WHERE id=".$_REQUEST['id'];     
      mysqli_query($con,$query) or die(mysqli_error());
      location(BUILDER_URL."manage_field.php?client_id=$client_id&project_id=$project_id&section_id=$section_id&page_id=$page_id&msg=3");
    break;
  } 
} 
$get_relative_field=mysqli_query($con,"SELECT * FROM `page` WHERE client_id='".$_REQUEST['client_id']."' AND project_id='".$_REQUEST['project_id']."' AND section_id='".$_REQUEST['section_id']."' AND id!='".$_REQUEST['page_id']."' AND pagetype!='static'");
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
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo (isset($_GET["id"])>0)?"Edit ":"Add "; ?><?php echo $pagetitle; ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="add_field.php" method="post" name="frm" enctype="multipart/form-data" onSubmit="javascript:return validation_check();" novalidate="novalidate">
          <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $id;?>">

<input type="hidden" name="client_id" class="form-control" id="client_id" value="<?php echo $client_id;?>">
<input type="hidden" name="project_id" class="form-control" id="project_id" value="<?php echo $project_id;?>">
<input type="hidden" name="section_id" class="form-control" id="section_id" value="<?php echo $section_id;?>">
<input type="hidden" name="page_id" class="form-control" id="page_id" value="<?php echo $page_id;?>">
              <div class="box-body">
               
 <div class="form-group">
                    <label>Field Label</label> 
                    <input type="text" name="field_label" class="form-control" id="field_label" placeholder="Field Label" value="<?php echo $field_label;?>">
                </div>

                <div class="form-group">
                    <label>Field ID</label>  
                    <input type="text" name="field_id" class="form-control" id="field_id" placeholder="Field ID" value="<?php echo $field_id;?>">
                </div>
                
                <div class="form-group">
                    <label>Display In Manage Field</label>  
                     <div class="form-group">
                    <input type="radio" name="manage_field" class="minimal" id="manage_field" value="1" <?php echo ($manage_field=="1")?'checked="checked"':''; ?> >Yes
                    <input type="radio" name="manage_field" class="minimal" id="manage_field" value="0" <?php echo ($manage_field=="0")?'checked="checked"':''; ?> >No
                  </div>
                </div>


                <div class="form-group">
                    <label>Required Field</label>  
                     <div class="form-group">
                    <input type="radio" name="required_field" class="minimal" id="required_field" value="1" <?php echo ($required_field=="1")?'checked="checked"':''; ?> >Yes
                    <input type="radio" name="required_field" class="minimal" id="required_field" value="0" <?php echo ($required_field=="0")?'checked="checked"':''; ?> >No
                  </div>
                </div>
                
                <div class="form-group">
                    <label>Display Order</label>  
                    <input type="number" onkeypress="javascript:return isNumber(event)" name="display_order" class="form-control" id="display_order" min="0" placeholder="Display Order" value="<?php echo $display_order;?>" onkeypress="javascript:return isNumber(event);">
                </div>


                <div class="form-group">
                    <label>Field Type</label>  
                    <select name="field_type" class="form-control" id="field_type" placeholder="Field Type">
                      <option value="">Select</option>
  <option value="textbox" <?php echo ($field_type=="textbox")?'selected="selected"':''; ?>>Textbox</option>
  <option value="textarea" <?php echo ($field_type=="textarea")?'selected="selected"':''; ?>>textarea</option>  
  <option value="fck" <?php echo ($field_type=="fck")?'selected="selected"':''; ?>>FCK</option>  
  <option value="image" <?php echo ($field_type=="image")?'selected="selected"':''; ?>>Image</option>  
  <option value="date" <?php echo ($field_type=="date")?'selected="selected"':''; ?>>Date</option>  
  <option value="combobox" <?php echo ($field_type=="combobox")?'selected="selected"':''; ?>>Combobox</option> 
  <option value="radio" <?php echo ($field_type=="radio")?'selected="selected"':''; ?>>Radio</option>   
  <option value="checkbox" <?php echo ($field_type=="checkbox")?'selected="selected"':''; ?>>Checkbox</option>   
                    </select>
                </div>
<style type="text/css">.disp{display: none;}.disp_block{display: block;}</style>
                <div class="form-group combo_image_select <?php echo ($field_type=="checkbox")?'disp_block':'disp'; ?>">
                    <label>Image Folder Name</label>  
                    <input type="text" name="folder_name" class="form-control" id="folder_name" placeholder="Image Folder Name" value="<?php echo $folder_name;?>">
                </div>
                <div class="for_combobox <?php echo ($field_type=="combobox" || $field_type=="radio" || $field_type=="checkbox")?'disp_block':'disp'; ?>">
                <div class="form-group">
                    <label>Static</label>  
                    <input type="text" name="text_field" class="form-control" id="text_field" placeholder="Static Field" value="<?php echo $text_field;?>">
                </div>
               
                <div class="form-group">
                    <label>Relative</label>  
                    <select name="relative_field" id="relative_field" class="form-control">
                      <option value="">Select</option>
                      <?php
                      if(mysqli_num_rows($get_relative_field)>0)
                      {
                        while ($data=mysqli_fetch_object($get_relative_field)) { 
                        ?>
                          <option value="<?php echo $data->id; ?>"><?php echo $data->pagetitle; ?></option>
                      <?php
                        }
                    }
                      ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Multiselect</label>  
                     <div class="form-group">
                    <input type="radio" name="multi_select" class="minimal" id="multi_select" value="0">OFF
                    <input type="radio" name="multi_select" class="minimal" id="multi_select" value="1">ON
                  </div>
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
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
    }
  function validateCode(name){
      var TCode = name;
      for(var i=0; i<TCode.length; i++)
      {
        var char1 = TCode.charAt(i);
        var cc = char1.charCodeAt(0);

        if((cc>47 && cc<58) || (cc>64 && cc<91) || (cc>96 && cc<123))
        {

        }
         else {
         return false;
         }
      }
     return true;     
   }
  function validation_check() 
  {
      /* -------------- Main Menu Validation --------------------- */
      if(document.getElementById("field_label").value.split(" ").join("") == "" || document.getElementById("field_label").value.split(" ").join("") == "0")
      {
        alert("Please Enter Field Label.");
        document.getElementById("field_label").focus();
        return false;
      }
      else
      {
        if(validateCode(document.getElementById("field_label").value.split(" ").join(""))){}
        else
        {
          alert('Only Alphabatic and Numberic Value Allow in Field Label.');
          return false;
        }

      }
      

      if(document.getElementById("field_id").value.split(" ").join("") == "" || document.getElementById("field_id").value.split(" ").join("") == "0")
      {
        alert("Please Enter Field ID.");
        document.getElementById("field_id").focus();
        return false;
      }
      
      var f_manage_field = document.getElementsByName('manage_field');
      if (!f_manage_field[0].checked && !f_manage_field[1].checked)
      {
        alert('Please Select Manage Field');
        return false;
      }
      var f_required_field = document.getElementsByName('required_field');
      if (!f_required_field[0].checked && !f_required_field[1].checked)
      {
        alert('Please Select Required Field');
        return false;
      }
      
      if(document.getElementById("display_order").value.split(" ").join("") == "" || document.getElementById("display_order").value.split(" ").join("") == "0")
      {
        alert("Please Enter Display Order.");
        document.getElementById("display_order").focus();
        return false;
      }

      if(document.getElementById("field_type").value.split(" ").join("") == "" || document.getElementById("field_type").value.split(" ").join("") == "0")
      {
        alert("Please Enter Field Type.");
        document.getElementById("field_type").focus();
        return false;
      }

      var f_field_type=document.getElementById("field_type").value.split(" ").join("");

      if(f_field_type=='textbox' || f_field_type=='textarea' || f_field_type=='fck' && f_field_type=='date')
      {
      }
      else if(f_field_type=='image')
      {
        if(document.getElementById("folder_name").value.split(" ").join("") == "" || document.getElementById("folder_name").value.split(" ").join("") == "0")
        {
          alert("Please Enter Folder Name For Save Images.");
          document.getElementById("folder_name").focus();
          return false;
        }
      }
      else if(f_field_type=="combobox" || f_field_type=="radio" || f_field_type=="checkbox")
      {
        var f_multi_select = document.getElementsByName('multi_select');
        if (!f_multi_select[0].checked && !f_multi_select[1].checked)
        {
          alert('Please Select Multi select');
          return false;
        }
      }
  }
  $(function () {
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      radioClass: 'iradio_minimal-blue'
    });
  });
$(document).ready(function(){
    $('#field_type').change(function(){
      var fi_type=$(this).val();
      if(fi_type=="image")
      {
        $('.combo_image_select').css("display", "block");
      }
      else
      {
       $('.combo_image_select').css("display", "none"); 
      }
      if(fi_type=="combobox")
      {
        $('.for_combobox').css("display", "block");
      }
      else if(fi_type=="radio")
      {
        $('.for_combobox').css("display", "block");
      }
      else if(fi_type=="checkbox")
      {
        $('.for_combobox').css("display", "block");
      }
      else
      {
        $('.for_combobox').css("display", "none");
      }

    });
  });
$( document ).ready(function(){
  $('.alert').fadeIn('slow', function(){
     $('.alert').delay(5000).fadeOut(); 
  });
});
</script>

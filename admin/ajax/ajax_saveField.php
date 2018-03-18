<?php 
  include("../../includes/config.inc.php");
  include("../../includes/security.php");
if (isset($_REQUEST['field_label']) && $_REQUEST['field_label']!="")
{
	
	if(isset($_REQUEST['id']) && $_REQUEST['id']=="")
	{
		echo $query="INSERT INTO `field` SET `client_id`='$client_id', `project_id`='$project_id', `section_id`='$section_id', `page_id`='$page_id', `field_label`='$field_label', `field_id`='$field_id', `display_order`='$display_order', `required_field`='$required_field', `field_type`='$field_type', `folder_name`='$folder_name', `static`='$text_field', `relative`='$relative_field', `multiselect`='$multi_select',`created`='$created'";
		$result=mysqli_query($con,$query);
		if($result)
			location(ADMIN_URL."manage_field.php?client_id=$client_id&project_id=$project_id&section_id=$section_id&page_id=$page_id&msg=1");
	}
	else
	{
		echo $query="UPDATE `field` SET `client_id`='$client_id', `project_id`='$project_id', `section_id`='$section_id', `page_id`='$page_id', `field_label`='$field_label', `field_id`='$field_id', `display_order`='$display_order', `required_field`='$required_field', `field_type`='$field_type', `folder_name`='$folder_name', `static`='$text_field', `relative`='$relative_field', `multiselect`='$multi_select',`created`='$created'";
		$query.=" WHERE `id`=".$_REQUEST['id'];
		$result=mysqli_query($con,$query);
		if($result)
			location(ADMIN_URL."manage_field.php?client_id=$client_id&project_id=$project_id&section_id=$section_id&page_id=$page_id&msg=2");
	}
}
?>
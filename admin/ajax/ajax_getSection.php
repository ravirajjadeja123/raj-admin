<?php 
  include("../../includes/config.inc.php");
  include("../../includes/security.php");

  if(isset($_REQUEST['id']) && $_REQUEST['id']!='')
  {
  		$query="SELECT * FROM `section` WHERE project_id=".$_REQUEST['id'];
  		$result=mysqli_query($con,$query);
  		if(mysqli_num_rows($result)>0)
  		{
  			echo '<option value="">SELECT SECTION</option>';
  			while ($data=mysqli_fetch_object($result)) {
  				?>
			<option value="<?php echo $data->id; ?>"><?php echo $data->section_name; ?></option>
  				<?php
  			}
  		}
      else
      {
        echo '<option value="">SELECT SECTION</option>';
      }
  }
  else
  {
    echo '<option value="">SELECT SECTION</option>';
  }
?>
<?php

  $get_sections="SELECT * FROM section WHERE project_id=".$result->id." AND client_id=".$result->client_id." ORDER BY display_order ASC";
 $get_sections_result=mysqli_query($con,$get_sections);
 if(mysqli_num_rows($get_sections_result)>0)
 {
  $section_arr_counter=1;
  $temp_linkvars_sub_section='<?php 

';
  $temp_linkvars_header_section='$HeadLinksArray = array (
';
    while ($section=mysqli_fetch_object($get_sections_result)) {
        $a_get_page=mysqli_query($con,"SELECT * FROM page WHERE client_id=".$section->client_id." AND project_id=".$section->project_id." AND section_id=".$section->id." ORDER BY display_order ASC;");
        if(mysqli_num_rows($a_get_page)>0)
      {
        $temp_linkvars_header_section.='    array("'.$section->section_name.'","fa fa-desktop",count($section_arr'.$section_arr_counter.'),$section_arr'.$section_arr_counter.',""), 
';
        $temp_linkvars_sub_section.='$section_arr'.$section_arr_counter.'=array(';
        while($page_temp=mysqli_fetch_object($a_get_page))
        {
          if($page_temp->pagetype=='static')
          {

			$temp_linkvars_sub_section.='
    array ("'.$page_temp->pagetitle.'","fa fa-circle-o","staticpage.php?slug='.strtolower(str_replace(' ', '-', $page_temp->pagetitle)).'"),';
          }
          
          if($page_temp->pagetype=='general')
          {
            $temp_linkvars_sub_section.='
    array ("'.$page_temp->pagetitle.'","fa fa-circle-o","'.$page_temp->manage_page_url.'.php"),';
        }
        }
  $section_arr_counter++;
        $temp_linkvars_sub_section.='
);

';
      }
        //echo "SELECT * FROM page WHERE client_id=".$section->client_id." AND project_id=".$section->project_id." AND section_id=".$section->id;
        
    }
  $temp_linkvars_header_section.=');

?>';
 } 
 
$Linkvars_FileName = PROJECT_STORAGE.$result->project_name."/adminpanel/linkvars.php";
$Linkvars_FileHandle = fopen($Linkvars_FileName, 'w') or die("can't open file");
fwrite($Linkvars_FileHandle, $temp_linkvars_sub_section.$temp_linkvars_header_section);
fclose($Linkvars_FileHandle);
?>

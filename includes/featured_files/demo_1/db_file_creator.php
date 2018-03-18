<?php
$temp.='CREATE DATABASE '.$result->database_name.'; USE '.$result->database_name.'; ';
  $temp.='
  CREATE TABLE admin (id INT NOT NULL AUTO_INCREMENT,PRIMARY KEY(id), `username` TEXT(80) NOT NULL,`password` TEXT NOT NULL,`type` TEXT NOT NULL,`email` TEXT NOT NULL,`created` datetime NOT NULL,`updated` datetime NOT NULL,`status` int(11) NOT NULL); 
INSERT INTO `admin` (`username`, `password`, `type`, `email`, `created`, `status`) VALUES
("admin", "21232f297a57a5a743894a0e4a801fc3", "admin", "admin@gmail.com", "'.date("Y-m-d H:i:s").'", 1);

CREATE TABLE IF NOT EXISTS staticpage (id INT NOT NULL AUTO_INCREMENT, 
  PRIMARY KEY(id),
  page_header TEXT NOT NULL,
  image_path TEXT NOT NULL,
  content TEXT NOT NULL,
  meta_keywords TEXT NOT NULL,
  meta_discription TEXT NOT NULL,
  title TEXT NOT NULL,
  alt TEXT NOT NULL,display_order TEXT NOT NULL); ';
  $Get_page=mysqli_query($con,"SELECT * FROM `page` WHERE `project_id`=".$_REQUEST['id']." ORDER BY display_order ASC,id ASC");
  if(mysqli_num_rows($Get_page)>0)
  {
    while ($result_page = mysqli_fetch_object($Get_page)) {
      if ($result_page->pagetype=='general') {
      
      $Get_field=mysqli_query($con,"SELECT * FROM `field` WHERE `page_id`=".$result_page->id." ORDER BY display_order ASC,id ASC");
      if(mysqli_num_rows($Get_field)>0)
      {
        $temp.=' CREATE TABLE '.$result_page->table_name.'( id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id)';
        while ($result_field = mysqli_fetch_object($Get_field)) {        

          $temp.=', '.$result_field->field_id;

            if ($result_field->field_type=='textbox' || $result_field->field_type=='textarea' || $result_field->field_type=='fck' || $result_field->field_type=='image' || $result_field->field_type=='combobox' || $result_field->field_type=='checkbox') 
            {
              $temp.=' TEXT NOT NULL ';
            }
            elseif($result_field->field_type=='date')
            {
              $temp.=' timestamp NULL DEFAULT NULL ';
            }
            elseif($result_field->field_type=='radio')
            {
              $temp.=' INT NOT NULL ';
            }

        }
             $temp.=' ,display_order INT );';
      }
    }
    if($result_page->pagetype=='static')
    {
      $temp.=" INSERT INTO staticpage (id,title,content,alt)VALUES (NULL ,'".$result_page->pagetitle."','','".strtolower(str_replace(' ', '-', $result_page->pagetitle))."');";
    }  
      }
  }

  if (!is_dir(PROJECT_STORAGE.$result->project_name.'/DB')) {
    mkdir(PROJECT_STORAGE.$result->project_name.'/DB', 0777, true);

    if(file_exists(PROJECT_STORAGE.$result->project_name."/DB/".$result->project_name."sql"))
    {
      unlink(PROJECT_STORAGE.$result->project_name."/DB/".$result->project_name."sql");
    }
    else
    {

    }
  }
  else
  {
    delete_files(PROJECT_STORAGE.$result->project_name);
    mkdir(PROJECT_STORAGE.$result->project_name.'/DB', 0777, true);
  }

$ourFileName = PROJECT_STORAGE.$result->project_name."/DB/".$result->project_name.".sql";
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
fwrite($ourFileHandle, $temp);
fclose($ourFileHandle);
?>
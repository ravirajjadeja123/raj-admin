<?php

function get_main_menu($con,$table_name)

{

    $query="SELECT * FROM `$table_name` ORDER BY display_order ASC";

    $result=mysqli_query($con,$query);

    $data=mysqli_fetch_object($result);

    return $data;

}

function location($path)
    {
        echo "<script>window.location.assign('".$path."');</script>";

    }

function ads($str)
{
    return $newstr=htmlentities($str,ENT_QUOTES);
}

function GTG_is_dup_add($con,$table,$field,$value)
    {
        $q = "select ".$field." from ".$table." where ".$field." = '".ads($value)."'"; 
        $r = mysqli_query($con,$q);
        if(mysqli_num_rows($r) > 0)
            return true;
        else
            return false;
    }
function GTG_is_dup_edit($con,$table,$field,$value,$id)
    {
        $query = "select ".$field." from ".$table." where ".$field." = '".$value."' and id != ".$id; 
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result) > 0)
            return true;
        else
            return false;
    }

function file_upload($folder_name,$file_name,$file_temp_name)

    {

        $ext = pathinfo($file_name,PATHINFO_EXTENSION);

        $new_name = time();

        $new_name = $new_name.'.'.$ext;



        $target_dir = $folder_name;

        $target_file = $folder_name.basename($new_name);    

        $uploadOk = 1;

        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image

        if(isset($_POST["submit"])) {

            $check = getimagesize($file_temp_name);

            if($check !== false) {

           //     echo "File is an image - " . $check["mime"] . ".";

                $uploadOk = 1;

            } else {

           //     echo "File is not an image.";

                $uploadOk = 0;

            }

        }



        // Check if file already exists

        if (file_exists($target_file)) {

           // echo "Sorry, file already exists.";

            $uploadOk = 0;

        }



        // Check file size

     //   if ($_FILES["fileToUpload"]["size"] > 500000) {

          //  echo "Sorry, your file is too large.";

     //       $uploadOk = 0;

    //    }



        // Allow certain file formats

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"

        && $imageFileType != "gif" ) {

          //  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

            $uploadOk = 0;

        }



        // Check if $uploadOk is set to 0 by an error

        if ($uploadOk == 0) {

          //  echo "Sorry, your file was not uploaded.";



        // if everything is ok, try to upload file

        } 

        else 

        {

            if (move_uploaded_file($file_temp_name,$target_file)) 

            {

               // echo "The file ". basename($file_name). " has been uploaded.";

                return basename ($new_name);

            } 

            else 

            {

             //   echo "Sorry, there was an error uploading your file.";

            }

        }

    }



    function sendMail($to,$subject,$message) {

    

    $from_nm=FROM_NM;

    $from_email=FROM_EMAIL; 

    

    $subject = $subject;

    $mailbody = $message;





    $mail = new PHPMailer(); // create a new object

    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only

    $mail->SMTPAuth = true; // authentication enabled

    //mail via gmail



    $mail->SMTPSecure = 'ssl'; //https = ssl site

    $mail->Host = SMTP_HOST;

    $mail->Port = SMTP_PORT;





    $mail->IsHTML(true);

    $mail->Username = SMTP_USERNAME;

    $mail->Password = SMTP_PASSWORD;

    $mail->SetFrom($from_email);

    $mail->AddReplyTo($from_email, $from_nm);

    $mail->Subject = $subject;

    $mail->Body = $mailbody;

    $mail->AddAddress($to);

    

    $result = true;

    if(!$mail->Send()){

        $result = false;

    }

    //echo "Mailer Error: " . $mail->ErrorInfo;

    return $result;

}

function delete_files($target) {

    if(is_dir($target)){

        $files = glob( $target . '*', GLOB_MARK ); 

        //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file )

        {

            delete_files( $file );      

        }

      

        rmdir( $target );

    } elseif(is_file($target)) {

        unlink( $target );  

    }

}



?>      
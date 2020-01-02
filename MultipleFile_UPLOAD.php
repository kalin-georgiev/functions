<form action="" method="post" enctype="multipart/form-data">
  <label> Select Files: </label>
  <input type="file" name="pictures[]" multiple>
  <input type="submit" name="Submit" value="Upload" >
</form>

<?php

$uploads_dir = './';

foreach ($_FILES["pictures"]["error"] as $key => $error) {
   
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];

        $name = basename($_FILES["pictures"]["name"][$key]);
        
        move_uploaded_file($tmp_name, "$uploads_dir/$name");
    }
}


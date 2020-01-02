<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
?>

<!DOCTYPE html>
<html>
<title>File Upload</title>    
<body>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>

<?php

$target_dir = "./";
$uploadOk = 1;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = $_FILES["fileToUpload"]["tmp_name"];
    if($check !== false) {
        echo "File is ok. ";
        $uploadOk = 1;
        
        // Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

$fileTypes = ['jpg','png','jpeg','gif','mp3'];
if(!in_array($imageFileType,$fileTypes)) {
    echo "Sorry, this file type is not suported.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file <strong><img src='". basename( $_FILES["fileToUpload"]["name"]). "'></strong> has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

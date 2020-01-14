<?php

$removed = ['..','.','.DS_Store'];
$dir = array_diff(scandir('images'),$removed);
$fileTypes = ['jpg','png','jpeg','gif','mp3'];

foreach($dir as $image) {

echo <<<FORM
    
    <img src='images/$image' alt='$image'>
    <form method='post'>
    <input type='hidden' name='d' value='images/$image'>
    <br>
    <input type='submit' value='Delete'>
    </form>
    <hr>
FORM;
}

if(isset($_POST['d'])) {
    if(unlink($_POST['d'])) {
        unset($_POST);
        header("Location: post.php");
    }
}
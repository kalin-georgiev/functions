<?php
ini_set("display_errors",1);
error_reporting(E_ALL);

$remote_img = 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg';
$img = imagecreatefromjpeg($remote_img);
$path = 'image.jpg';
//imagejpeg($img, $path);

function save_image($img,$fullpath){
	$ch = curl_init ($img);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	$rawdata=curl_exec($ch);
	curl_close ($ch);
	if(file_exists($fullpath)){
		unlink($fullpath);
	}
	$fp = fopen($fullpath,'x');
	fwrite($fp, $rawdata);
	fclose($fp); 
}


save_image('https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg','images/image.jpg');
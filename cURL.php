<?php
$url = 'http://www.ericgiguere.com/tools/http-header-viewer.html';

// disguises the curl using fake headers and a fake user agent.
function disguise_curl($url)
{
    $curl = curl_init();

    // Setup headers - I used the same headers from Firefox version 2.0.0.6
    // below was split up because php.net said the line was too long. :/
    $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5,";
    $header[] = "Cache-Control: max-age=0";
    $header[] = "Connection: keep-alive";
    $header[] = "Keep-Alive: 300";
    $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $header[] = "Accept-Language: en-us,en;q=0.5";
    $header[] = "Pragma: "; // browsers keep this blank.

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_REFERER, 'http://www.google.com');
    curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
    curl_setopt($curl, CURLOPT_AUTOREFERER, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);

    $html = curl_exec($curl); // execute the curl command
    curl_close($curl); // close the connection

    return $html; // and finally, return $html
}

// uses the function and displays the text off the website
$text = disguise_curl($url);
echo $text;


// SAVING REQUESTED IMAGES

$remote_img = 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg';
$img = imagecreatefromjpeg($remote_img);
$path = 'image.jpg';
//imagejpeg($img, $path);

// SAVING IMAGES METHOD 2 (cURL)

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

save_image('https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg','image.jpg');
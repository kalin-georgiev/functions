<?php

// PHP Bot for WINTUB.COM and may be user for other sites as well with small modifications ;)
/*
  Tip: You can copy this file multiple times and ser different
  user credentials.
  Then you can add a bookmarks for all of them, and with one click
  in the bookmarks option in the browser, you can open them all and
  then wait for completion.
*/

//The username or email address of the account.
define('USERNAME', 'your_username');
define('PASSWORD', 'your_password');


$sUrl = "https://wintub.com";
$server = '';
$activeNumber = '';

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $sUrl);
curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$s = curl_exec($curl);

if (preg_match("/s[1-6]/", $s, $match)) { 
  $server = $match[0];
} else { die('ERROR FINDING SERVER!'); }

//Set a user agent. This basically tells the server that we are using Chrome ;)
define('USER_AGENT', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36');
 
//Where our cookie information will be stored (needed for authentication).
define('COOKIE_FILE', 'cookie.rtf');
 
//URL of the login form.
define('LOGIN_FORM_URL', "https://".$server.".wintub.com/login.php");
 
//Login action URL. Sometimes, this is the same URL as the login form.
define('LOGIN_ACTION_URL', "https://".$server.".wintub.com/login.php");
 
 
//An associative array that represents the required form fields.
//You will need to change the keys / index names to match the name of the form
//fields.
$postValues = array(
    'email' => USERNAME,
    'password' => PASSWORD
);
 
//Set the URL that we want to send our POST request to. In this
//case, it's the action URL of the login form.
curl_setopt($curl, CURLOPT_URL, LOGIN_ACTION_URL);
 
//Tell cURL that we want to carry out a POST request.
curl_setopt($curl, CURLOPT_POST, true);
 
//Set our post fields / date (from the array above).
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postValues));
 
//We don't want any HTTPS errors.
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
 
//Where our cookie details are saved. This is typically required
//for authentication, as the session ID is usually saved in the cookie file.
curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);
 
//Sets the user agent. Some websites will attempt to block bot user agents.
//Hence the reason I gave it a Chrome user agent.
curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);
 
//Tells cURL to return the output once the request has been executed.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
//Allows us to set the referer header. In this particular case, we are 
//fooling the server into thinking that we were referred by the login form.
curl_setopt($curl, CURLOPT_REFERER, LOGIN_FORM_URL);
 
//Do we want to follow any redirects?
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
 
//Execute the login request.
curl_exec($curl);

//Check for errors!
if(curl_errno($curl)){
    throw new Exception(curl_error($curl));
}

// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => "https://".$server.".wintub.com/dashboard.php",
    CURLOPT_USERAGENT => USER_AGENT
]);

// Extract active number
$pageContent = curl_exec($curl);
if (preg_match("/[0-9]{10}/", $pageContent, $matches)) { 
   $activeNumber = $matches[0];
}  else { die('ERROR FINDING activeNumber!'); }

// Visit all 5 links + 3-rd link once more, because it becomes twise active :)
for($i = 1; $i <= 6; $i++) {
    
    if($i == 6) {  
      $i = 3;
      curl_setopt($curl, CURLOPT_URL, "https://".$server.".wintub.com/dashboard.php?v=$i&active=$activeNumber");
      curl_exec($curl);
    break;
  }
  
  curl_setopt($curl, CURLOPT_URL, "https://".$server.".wintub.com/dashboard.php?v=$i&active=$activeNumber");
  curl_exec($curl);

  }
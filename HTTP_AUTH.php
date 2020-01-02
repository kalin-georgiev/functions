<?php
session_start();

$valid_passwords = ["kalin" => "kalin",'niki'=>'niki'];
$valid_users = array_keys($valid_passwords);

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) {
  header('WWW-Authenticate: Basic realm="My Realm"');
  header('HTTP/1.0 401 Unauthorized');
  die ("Not authorized");
}

$_SESSION['user'] = $user;
$_SESSION['password'] = $pass;

header("Location: test.php");



<?php
session_start();

$_SESSION = array();

if (isset($_COOKIE[session_name()])) { //session_name()は、セッションID名を返す関数
  setcookie(session_name(), '', time() - 42000, '/');
}

session_destroy();

header('Location:u_login.php');
exit();

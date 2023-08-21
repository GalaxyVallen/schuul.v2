<?php
session_start();

$_SESSION[] = null;

if (isset($_COOKIE[session_name()])) {
  setcookie(session_name(), '', time() - 3600, '/');
}

session_unset();
session_destroy();

header("Location: auth/login.php");
exit;

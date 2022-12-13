<?php
//Trying to make a single php to check for logged in status

session_start();
// Check if logged in
if (!isset($_SESSION['username'])) {
  $_SESSION['referrer'] = $_SERVER['REQUEST_URI'];
  header('Location: login.php');
  exit;
}
if (isset($_SESSION['expires_by'])) {
  $expires_by = intval($_SESSION['expires_by']);
  if (time() < $expires_by) {
    $_SESSION['expires_by'] = time() + intval($_SESSION['expires_timeout']);
  } else {
    unset($_SESSION['username']);
    unset($_SESSION['expires_by']);
    unset($_SESSION['expires_timeout']);
    $_SESSION['referrer'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php');
    exit;
  }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'logoutform') {
  unset($_SESSION['username']);
  unset($_SESSION['fullname']);
  session_destroy();
  session_write_close();
  header('Location: login.php');
  exit;
}
//Connection to the database
require __DIR__ . '/credentials/db_credentials.php';

try {
  $con = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo 'connected';
} catch (PDOException $e) {
  echo '<br>Connection Failed' . $e->getMessage();
}
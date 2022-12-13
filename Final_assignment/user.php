<?php
session_start();
if (!isset($_SESSION['username'])) {
   $_SESSION['referrer'] = $_SERVER['REQUEST_URI'];
   header('Location: index.php');
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
      header('Location: index.php');
      exit;
   }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'logoutform') {
   unset($_SESSION['username']);
   unset($_SESSION['fullname']);
   header('Location: ./login.php');
   exit;
}
?>
<!doctype html>
<html>

<head>
   <meta charset="utf-8">
   <title>Untitled Page</title>
   <link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
   <link href="css/login.css" rel="stylesheet">
   <link href="css/user.css" rel="stylesheet">
   <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
</head>

<body>
   <div id="image1" style="position:absolute;left:0px;top:47px;width:970px;height:617px;z-index:0;">
      <div id="wb_Logout1" style="position:absolute;left:153px;top:322px;width:94px;height:23px;text-align:center;z-index:3;">
         <form name="logoutform" method="post" action="<?php echo basename(__FILE__); ?>" id="logoutform">
            <input type="hidden" name="form_name" value="logoutform">
            <button type="submit" name="logout" value="Logout" id="Logout1">Logout</button>
         </form>
      </div>
      <div id="text1" style="position:absolute;left:81px;top:274px;width:467px;height:24px;z-index:4;">
         <span style="color:#000000;font-family:Arial;font-size:27px;">You are logged in</span>
      </div>
</body>

</html>
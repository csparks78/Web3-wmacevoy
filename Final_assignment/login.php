<?php
session_start();
require __DIR__ . '/credentials/amanda_cred.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'loginform') {
   $success_page = './add_cust.php';
   $error_page = './error_login.php';
   $crypt_pass = md5($_POST['password']);
   $found = false;
   $db_email = '';
   $db_fullname = '';
   $db_username = '';
   $db_role = '';
   $db_avatar = '';
   $session_timeout = 600;
   $db = mysqli_connect($mysql_server, $mysql_username, $mysql_password, $mysql_database);
   if (!$db) {
      die('Failed to connect to database server!<br>' . mysqli_error($db));
   }
   mysqli_select_db($db, $mysql_database) or die('Failed to select database<br>' . mysqli_error($db));
   mysqli_set_charset($db, 'utf8');
   $sql = "SELECT * FROM " . $mysql_table . " WHERE username = '" . mysqli_real_escape_string($db, $_POST['username']) . "'";
   $result = mysqli_query($db, $sql);
   if ($data = mysqli_fetch_array($result)) {
      if ($crypt_pass == $data['password'] && $data['active'] != 0) {
         $found = true;
         $db_email = $data['email'];
         $db_fullname = $data['fullname'];
         $db_username = $data['username'];
         $db_role = $data['role'];
         $folder = substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/') + 1);
         $db_avatar = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$folder" . "avatars/" . $data['avatar'];
      }
   }
   mysqli_close($db);
   if ($found == false) {
      header('Location: ' . $error_page);
      exit;
   } else {
      $_SESSION['email'] = $db_email;
      $_SESSION['fullname'] = $db_fullname;
      $_SESSION['username'] = $db_username;
      $_SESSION['role'] = $db_role;
      $_SESSION['avatar'] = $db_avatar;
      $_SESSION['expires_by'] = time() + $session_timeout;
      $_SESSION['expires_timeout'] = $session_timeout;
      $rememberme = isset($_POST['rememberme']) ? true : false;
      if ($rememberme) {
         setcookie('username', $db_username, time() + 3600 * 24 * 30);
         setcookie('password', $_POST['password'], time() + 3600 * 24 * 30);
      }
      header('Location: ' . $success_page);
      exit;
   }
}
$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
?>
<!doctype html>
<html>

<head>
   <meta charset="utf-8">
   <title>Amanda's Grooming</title>
   <link rel="icon" type="image/x-icon" href="img\dogBath.png">
   <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
   <link href="css/Login.css" rel="stylesheet">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
   <div id="container">

      <div id="wb_Login1" style="position:absolute;left:341px;top:171px;width:289px;height:430px;z-index:1;">

         <form name="loginform" method="post" accept-charset="UTF-8" action="<?php echo basename(__FILE__); ?>" id="loginform">
            <input type="hidden" name="form_name" value="loginform">
            <table id="Login1">
               <tr>
                  <td class="header">Log In</td>
               </tr>
               <tr>
                  <td class="label"><label for="username">User Name</label></td>
               </tr>
               <tr>
                  <td class="row"><input class="input" name="username" type="text" id="username" value="<?php echo $username; ?>"></td>
               </tr>
               <tr>
                  <td class="label"><label for="password">Password</label></td>
               </tr>
               <tr>
                  <td class="row"><input class="input" name="password" type="password" id="password" value="<?php echo $password; ?>"></td>
               </tr>
               <tr>
                  <td class="row"><input id="rememberme" type="checkbox" name="rememberme"><label for="rememberme">Remember me</label></td>
               </tr>
               <tr>
                  <td style="text-align:center;vertical-align:bottom"><input class="button" type="submit" name="login" value="Log In" id="login"></td>
               </tr>
               <tr>
               <td style="text-align:center;vertical-align:bottom"><input class="button" type="submit" name="Create account" onclick="window.location.href='./create_account.php';return false;" value="Create account" id="Create account"></td>
               </tr>
               <!-- TODO-->

               <!-- <input type="submit" id="Button1" onclick="window.location.href='./create_account.php';return false;" name="" value="Create Account" style="position:absolute;left:400px;top:523px;width:170px;height:25px;z-index:2;"> -->


            </table>
         </form>
      </div>
      <div id="wb_Text1" style="position:absolute;left:0px;top:33px;width:970px;height:59px;text-align:center;z-index:3;">
         <span style="color:#000000;font-family:'Comic Sans MS';font-size:53px;">Amanda's Grooming Clients</span>
      </div>
   </div>
</body>

</html>
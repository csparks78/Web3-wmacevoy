<?php
require __DIR__ . '/credentials/amanda_cred.php';
$success_page = 'login.php';
$error_message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'signupform') {
   $newusername = $_POST['username'];
   $newemail = $_POST['email'];
   $newpassword = $_POST['password'];
   $confirmpassword = $_POST['confirmpassword'];
   $newfullname = $_POST['fullname'];
   $code = 'NA';
   if ($newpassword != $confirmpassword) {
      $error_message = 'Password and Confirm Password are not the same!';
   } else
   if (!preg_match("/^[A-Za-z0-9-_!@$]{1,50}$/", $newusername)) {
      $error_message = 'Username is not valid, please check and try again!';
   } else
   if (!preg_match("/^[A-Za-z0-9-_!@$]{1,50}$/", $newpassword)) {
      $error_message = 'Password is not valid, please check and try again!';
   } else
   if (!preg_match("/^[A-Za-z0-9-_!@$]{1,50}$/", $newfullname)) {
      $error_message = 'Fullname is not valid, please check and try again!';
   } else
   if (!preg_match("/^.+@.+\..+$/", $newemail)) {
      $error_message = 'Email is not a valid email address. Please check and try again.';
   }
   if (empty($error_message)) {
      $db = mysqli_connect($mysql_server, $mysql_username, $mysql_password);
      if (!$db) {
         die('Failed to connect to database server!<br>' . mysqli_error($db));
      }
      mysqli_select_db($db, $mysql_database) or die('Failed to select database<br>' . mysqli_error($db));
      mysqli_set_charset($db, 'utf8');
      $sql = "SELECT username FROM " . $mysql_table . " WHERE username = '" . $newusername . "'";
      $result = mysqli_query($db, $sql);
      if ($data = mysqli_fetch_array($result)) {
         $error_message = 'Username already used. Please select another username.';
      }
   }
   if (empty($error_message)) {
      $crypt_pass = md5($newpassword);
      $newusername = mysqli_real_escape_string($db, $newusername);
      $newemail = mysqli_real_escape_string($db, $newemail);
      $newfullname = mysqli_real_escape_string($db, $newfullname);
      $sql = "INSERT `" . $mysql_table . "` (`username`, `password`, `fullname`, `email`, `active`, `code`, `role`) VALUES ('$newusername', '$crypt_pass', '$newfullname', '$newemail', 1, '$code', '')";
      $result = mysqli_query($db, $sql);
      mysqli_close($db);
      $subject = 'Your new account';
      $message = 'A new account has been setup.';
      $message .= "\r\nUsername: ";
      $message .= $newusername;
      $message .= "\r\nPassword: ";
      $message .= $newpassword;
      $message .= "\r\n";
      $header  = "From: webmaster@yourwebsite.com" . "\r\n";
      $header .= "Reply-To: webmaster@yourwebsite.com" . "\r\n";
      $header .= "MIME-Version: 1.0" . "\r\n";
      $header .= "Content-Type: text/plain; charset=utf-8" . "\r\n";
      $header .= "Content-Transfer-Encoding: 8bit" . "\r\n";
      $header .= "X-Mailer: PHP v" . phpversion();
      //mail($newemail, $subject, $message, $header);
      header('Location: ' . $success_page);
      exit;
   }
}
?>
<!doctype html>
<html>

<head>
   <meta charset="utf-8">
   <title>create_account</title>
   <meta name="generator" content="WYSIWYG Web Builder 17 Trial Version - https://www.wysiwygwebbuilder.com">
   <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
   <link href="css/login.css" rel="stylesheet">
   <link href="css/create_account.css" rel="stylesheet">
</head>

<body>
   <div id="container">
      <div id="text1" style="position:absolute;left:203px;top:28px;width:565px;height:59px;text-align:center;z-index:1;">
         <span style="color:#000000;font-family:'Comic Sans MS';font-size:53px;">Amanda's Grooming Clients</span>
      </div>
      <div id="wb_Signup1" style="position:absolute;left:329px;top:219px;width:313px;height:478px;z-index:2;">
         <form name="signupform" method="post" accept-charset="UTF-8" action="<?php echo basename(__FILE__); ?>" id="signupform">
            <input type="hidden" name="form_name" value="signupform">
            <table id="Signup1">
               <tr>
                  <td class="header">Sign up for a new account</td>
               </tr>
               <tr>
                  <td class="label"><label for="fullname">Full Name</label></td>
               </tr>
               <tr>
                  <td class="row"><input class="input" name="fullname" type="text" id="fullname"></td>
               </tr>
               <tr>
                  <td class="label"><label for="username">User Name</label></td>
               </tr>
               <tr>
                  <td class="row"><input class="input" name="username" type="text" id="username"></td>
               </tr>
               <tr>
                  <td class="label"><label for="password">Password</label></td>
               </tr>
               <tr>
                  <td class="row"><input class="input" name="password" type="password" id="password"></td>
               </tr>
               <tr>
                  <td class="label"><label for="confirmpassword">Confirm Password</label></td>
               </tr>
               <tr>
                  <td class="row"><input class="input" name="confirmpassword" type="password" id="confirmpassword"></td>
               </tr>
               <tr>
                  <td class="label"><label for="email">E-mail</label></td>
               </tr>
               <tr>
                  <td class="row"><input class="input" name="email" type="text" id="email"></td>
               </tr>
               <tr>
                  <td><?php echo $error_message; ?></td>
               </tr>
               <tr>
                  <td style="text-align:center;vertical-align:bottom"><input class="button" type="submit" name="signup" value="Create User" id="signup"></td>
               </tr>
            </table>
         </form>
      </div>
      <input type="submit" id="Button1" onclick="window.location.href='./login.php';return false;" name="" value="Cancel" style="position:absolute;left:437px;top:711px;width:96px;height:25px;z-index:3;">
   </div>
</body>

</html>
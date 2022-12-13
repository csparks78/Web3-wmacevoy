<!DOCTYPE html>
<html>
    <head>
    <link rel="icon" type="image/x-icon" href="img\dogBath.png">
    <title>Amanda's Grooming</title>
    </head>
<body>
 
<?php
 
    echo "Logged out successfully";
 
    session_start();
    session_destroy();
 
?>
 <button id="login" input type="login" name="login" onclick="window.location.href='login.php';return false;">Log back in!</button>
</body>
</html>
<?php

require __DIR__ . '\credentials\db_credentials.php';

try {
    $con = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'connected';
} catch (PDOException $e) {
    echo '<br>Connection Failed' . $e->getMessage();
}


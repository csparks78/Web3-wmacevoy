<?php
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
    header('Location: ./login.php');
    exit;
}
//Connection to the database
require __DIR__ . '/../credentials/db_credentials.php';

try {
    $con = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'connected';
} catch (PDOException $e) {
    echo '<br>Connection Failed' . $e->getMessage();
}

?>

<!doctype html>
<html>

<head>
    <link rel="Stylesheet" type="text/css" href="css/customers.css" />
    <title>Customers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
</head>

<body id="body">
    <div class="formContainer">
        <fieldset>
            <center>
                <legend>
                    <h2><u>Customer information</u></h2>
                </legend>

                <form action="action.php" method="POST">
                    <p>
                        <label for="firstName">First name: </label>
                        <input type="text" name="firstName" id="firstName">
                    </p>
                    <p>
                        <label for="lastName">Last name: </label>
                        <input type="text" name="lastName" id="lastName">
                    </p>
                    <p>
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone">
                    </p>
                    <p>
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email">
                    </p>
                    <p>
                        <label for="dogName">Dog's name: </label>
                        <input type="text" name="dogName" id="dogName">
                    </p>
                    <p>
                        <label for="date">Date of appointment: </label>
                        <input type="text" name="date" id="date">
                    </p>
                    <p>
                        <label for="gender">Gender:</label>
                        <select class="gender" name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </p>
                    <p>
                        <label for="breed">Dog's breed:</label>
                        <input type="text" name="breed" id="breed">
                    </p>
                    <p> Comment: </p>
                    <p><textarea name="comments" rows="8" cols="40"></textarea></p>
                    <!-- <p>&nbsp;</p> -->

                    <!-- <input type="submit"> -->
                    <input type="submit" name="Submit" id="Submit" value="Submit">

                    <button class="reset" type="reset" value="Reset" id="Reset">Clear form</button>

                    <input type="button" onclick= "location.href='search.php'" value="Search" />
                </form>
                <!-- <form name="logoutform" method="post" action="<?php echo basename(__FILE__); ?>" id="logoutform"> -->
                    <input type="hidden" name="form_name" value="logoutform">
                    <button class="logoutform" type="submit" name="logoutform" value="Logoutform" id="Logoutform">Logout</button>
                <!-- </form> -->
            </center>
        </fieldset>
    </div>
</body>

</html>
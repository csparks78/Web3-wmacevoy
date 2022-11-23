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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="Stylesheet" type="text/css" href="css/add_customers.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class='signup-container'>
    <div class='left-container'>
      <h1>
        Amanda's Grooming
      </h1>
      <form action="action.php" method="POST">
        <div class='puppy'>
          <img src="img/dog.jpg">
          <!-- <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-542207-jpeg.png'>
      </div> -->
        </div>
    </div>
    <div class='right-container'>
      <header>
        <h1>Customer information</h1>
        <div class='set'>
          <div class='firstName'>
            <label for='firstName'>First name</label>
            <input id='firstName' name='firstName' placeholder="First name" type='text'>
          </div>
          <div class='lastName'>
            <label for='lastName'>Last name</label>
            <input id='lastName' name='lastName' placeholder="Last name" type='text'>
          </div>
        </div>
        <div class='set'>
          <div class='pets-breed'>
            <label for='pets-breed'>Breed</label>
            <input id='pets-breed' placeholder="Pet's breed" type='text'>
          </div>
          <div class='dogName'>
            <label for='dogName'>Pets name</label>
            <input id='dogName' name='dogName' placeholder="Pets name" type='text'>
          </div>
        </div>
        <div class='set'>
          <div class='email'>
            <div class='email'>
              <label for='email'>Email address</label>
              <input id='email' name="email" placeholder="Email address" type='text'>
            </div>
          </div>
          <div class='phone'>
            <div class='phone'>
              <label for='phone'>Phone number</label>
              <input id='phone' name="phone" placeholder="Phone number" type='text'>
            </div>
          </div>

        </div>
        <div class='set'>
          <div class='gender'>
            <label for='gender'>Gender</label>
            <div class='radio-container-gender'>
              <input checked='' id='gender' name='gender-male' type='radio' value='male'>
              <label for='gender-male'>Male</label>
              <input id='gender-female' name='gender-female' type='radio' value='female'>
              <label for='gender'>Female</label>
            </div>
          </div>
          <div class='date'>
            <div class='date'>
              <label for='date'>Date</label>
              <input id='date' name="date" placeholder="Date" type='text'>
            </div>
          </div>

        </div>

        <!-- <div class='comment-button'>
              <button v-on:click="addItem()" class='primaryContained float-right' type="submit">Add</button>
            </div> -->
        <!-- </label> -->
        <div class="pets-comment">
          <!-- <label for='pet-comment'> -->
          <div class='comment-container'>
            <input type="text" name='comments' class="input" placeholder="Write a comment" v-model="newItem"
              @keyup.enter="addItem()"></textarea>
          </div>
        </div>
        <!-- <div class='pets-weight'>
          <label for='pet-weight-0-25'>Weight</label>
          <div class='radio-container'>
            <input checked='' id='pet-weight-0-25' name='pet-weight' type='radio' value='0-25'>
            <label for='pet-weight-0-25'>0-25 lbs</label>
            <input id='pet-weight-25-50' name='pet-weight' type='radio' value='25-50'>
            <label for='pet-weight-25-50'>25-50 lbs</label>
            <input id='pet-weight-50-100' name='pet-weight' type='radio' value='50-100'>
            <label for='pet-weight-50-100'>50-100 lbs</label>
            <input id='pet-weight-100-plus' name='pet-weight' type='radio' value='100+'>
            <label for='pet-weight-100-plus'>100+ lbs</label>
          </div>
        </div> -->


      </header>
      <footer>
        <div class='set'>
          <input type="hidden" name="form_name" value="Logoutform">
          <button id="Logoutform" type="submit" name="logoutform" value="Logoutform">Logout</button>

          <!-- <button id='back'>Back</button> -->
          <button id="reset" type="reset" value="Reset" id="Reset">Clear form</button>
          <button id='submit' type="submit" name="Submit" value="Submit">Submit</button>
      </footer>
    </div>

</body>

</html>
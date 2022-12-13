<?php
require __DIR__ . '/loggedin.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="Stylesheet" type="text/css" href="css/add_customers.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="img\dogBath.png">
  <title>Amanda's Grooming</title>
</head>

<body>
  <div class='signup-container'>
    <div class='left-container'>
      <h1>
        Amanda's Grooming
      </h1>
      <form action="action.php" method="post">
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
          <div class='breed'>
            <label for='breed'>Breed</label>
            <input id='breed' name="breed" placeholder="Pet's breed" type='text'>
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
            <div class='gender'>
              <label for='gender'>Gender</label>
              <input id='gender' name="gender" placeholder="Gender" type='text'>
              <!-- <div class='radio-container-gender'>
              <input  id='gender' name='gender-male' type='radio' value='Male'>
              <label for='gender-male'>Male</label>
              <input  id='gender' name='gender-female' type='radio' value='Female'>
              <label for='gender-female'>Female</label>-->
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
            <input type="text" name='comments' class="input" placeholder="Write a comment" v-model="newItem" @keyup.enter="addItem()"></textarea>
          </div>
        </div>



      </header>
      <footer>
        <div class='set'>
          <input type="hidden" name="form_name" value="Logoutform">
          <button id="Logoutform" type="submit" name="logoutform" onclick="window.location.href='logoutform.php';return false;">Logout</button>
          <button id="Search" input type="submit" name="search" onclick="window.location.href='search.php';return false;">Search</button>
          <button id="reset" type="reset" value="Reset" id="Reset">Clear form</button>
          <button id='submit' type="submit" name="Submit" value="Submit">Submit</button>
      </footer>
    </div>

</body>

</html>
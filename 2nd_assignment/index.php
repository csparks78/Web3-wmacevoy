<!DOCTYPE HTML>
<?php include 'new.php' ?>
<html>

<head>
<link rel="stylesheet" href="css\index.css">
</head>

<body>

<fieldset class=form>
  <legend>PHP Form Validation</legend>
  <p id=required>* required field</span></p>  
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

      FullName: <input type="text" name="name">
      <span class="error">* <?php echo $nameErr; ?></span>
      <br><br>

      E-mail address: <input type="text" name="email">
      <span class="error">* <?php echo $emailErr; ?></span>
      <br><br>

      Website: <input type="text" name="website">
      <span class="error"><?php echo $websiteErr; ?></span>
      <br><br>

      Comment: <textarea name="comment" rows="2" cols="10"></textarea>
      <br><br>

      Gender:
      <input type="radio" name="gender" value="female">Female
      <input type="radio" name="gender" value="male">Male
      <span class="error">* <?php echo $genderErr; ?></span>
      <br><br>

      <input type="submit" name="submit" value="Submit">
    </form>
    </fieldset>

  <?php
  echo "<h2> Output:</h2>";
  echo $name;
  echo "<br>";
  echo $email;
  echo "<br>";
  echo $website;
  echo "<br>";
  echo $comment;
  echo "<br>";
  echo $gender;
  ?>

</body>
<footer>  
</footer>
</html>
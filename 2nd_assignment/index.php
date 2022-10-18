<!DOCTYPE HTML>
<?php include 'process.php' ?>
<html>

<head>
  <link rel="stylesheet" href="css\index.css">
</head>

<body>

  <fieldset class=formOutline>
    <legend>PHP Form with Validation</legend>
    <p id=required>* required field</span></p>
    <form class="mainForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="titles">Full name</div>
      <input type="text" name="name">
      <span class="error">* <?php echo $nameErr; ?></span>
      <br><br>
      <div class="titles">E-mail address</div>
      <input type="text" name="email">
      <span class="error">* <?php echo $emailErr; ?></span>
      <br><br>
      <div class="titles">Website</div>
      <input type="text" name="website">
      <span class="error"><?php echo $websiteErr; ?></span>
      <br><br>

      <input type="submit" name="submit" value="Submit">
    </form>
  </fieldset>
  <div class="mainForm">
    <?php

    echo "<h2>Your Input:</h2>";
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
  </div>
</body>
<footer>
</footer>

</html>
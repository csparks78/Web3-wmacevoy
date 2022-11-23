<?php
include_once 'connect.php';
// Variables for the names table using form validation

$firstName = test_input($_POST['firstName']);
$lastName = test_input($_POST['lastName']);
$phone = test_input($_POST['phone']);
$email = test_input($_POST['email']);

//Variables for the dog table using form validation
$dogName = test_input($_POST['dogName']);
$date = test_input($_POST['date']);
$gender = test_input($_POST['gender']);
$breed = test_input($_POST['breed']);
$comments = test_input($_POST['comments']);

// Form validation function
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

try {
	$sql = ("
			INSERT INTO names (firstName, lastName, phone, email) VALUES ('$firstName', '$lastName', '$phone', '$email');
			INSERT INTO dogs (dogName, gender, breed, date, comments) VALUES ('$dogName', '$gender', '$breed', '$date', '$comments');
			");
	$sth = $con->query($sql);
} catch (PDOException $e) {
	echo $e->getMessage();
}
header("Location: add_cust.php");
echo 'Success!';
<?php
session_start();
require_once('config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$phone_number = $_POST["phone_number"];
$email = $_POST["email"];
if(empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
  echo "All fields are required.";
} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "Invalid email format.";
} elseif($password != $confirm_password) {
  echo "Passwords do not match.";
} else {echo "Name: " . $name . "<br>";
  echo "Email: " . $email . "<br>";
  echo "Password: " . $password . "<br>";
}

$sql = "INSERT INTO users (first_name, last_name, phone_number, gender, email)
VALUES ('$first_name', '$last_name', '$phone_number', '$gender', '$email')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<?php

// Establish a connection to the MySQL database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Retrieve the data from the form
  $name = $_POST["name"];
  $phone = $_POST["phone"];
  $email = $_POST["email"];
  $gender = $_POST["gender"];
  $is_xim = isset($_POST["is_xim"]) ? 1 : 0;
  $password = $_POST["password"];

  // Insert the data into the "user" table
  $sql = "INSERT INTO user (name, phone_no, email, gender, is_xim, password) VALUES ('$name', '$phone', '$email', '$gender', $is_xim,'$password')";

  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);

?>
<?php
session_start();
include "../db/db.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
  function validate($data)
  {
    $data = trim($data); // remove whitespace from beginning and end of string
    $data = stripslashes($data); // remove backslashes
    $data = htmlspecialchars($data); // convert special chars to html
    return $data; // return striped data
  }
}

$username = validate($_POST['username']); // run validation on username
$pass = validate($_POST['password']); // run validation on password

// echo $username;
// echo $pass;

// check that username != empty
if (empty($username)) {
  header("Location: ../index.php?error=User Name is required"); // if a field is empty redirect to error page
  exit(); // to make sure the code bellow doesn't get executed

  // check password != empty
} else if (empty($pass)) {
  header("Location: ../index.php?error=Password is required");
  exit();
}

// query to be executed
$query = "SELECT * FROM users WHERE username='$username' AND password='$pass'";

// results of query
$result = mysqli_query($conn, $query);

// var_dump($result); // test print

if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  if ($row['username'] == $username && $row['password'] == $pass) {
    $_SESSION['name'] = $row['name'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['id'] = $row['id'];
    header("Location: ../home.php");
    exit();
  } else {
    header("Location: ../index.php?error=Incorrect username or password");
    exit();
  }
} else {
  header("Location: ../index.php?error=User not found");
  exit();
}

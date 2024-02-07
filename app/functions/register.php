<?php
session_start();
include "../db/db.php"; // path to database connection file

function validate($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Registration form submitted
  $name = validate($_POST['name']);
  $username = validate($_POST['username']);
  $password = validate($_POST['password']);

  // Check if username and password are not empty
  if (empty($name) || empty($username) || empty($password)) {
    header("Location: register.php?error=All fields are required");
    exit();
  }

  // Check if the username is already taken
  $query = "SELECT * FROM users WHERE username='$username'";
  $check_result = mysqli_query($conn, $query);

  if (mysqli_num_rows($check_result) > 0) {
    header("Location: register.php?error=Username already taken");
    exit();
  }

  // Insert the new user into the database
  $insert_user = "INSERT INTO users (username, name, password) VALUES ('$username', '$name', '$password')";
  $insert_result = mysqli_query($conn, $insert_user);

  if ($insert_result) {
    header("Location: ../index.php?success=Registration successful. You can now log in.");
    exit();
  } else {
    header("Location: register.php?error=Registration failed. Please try again.");
    exit();
  }
} else {
  // Display registration form
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../style.css" />
  </head>

  <body>
    <div class="form-container">
      <h2>Registration</h2>
      <?php if (isset($_GET['error'])) { ?>
        <p style="color: red;"><?php echo $_GET['error']; ?></p>
      <?php } ?>
      <form action="register.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="name" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Register</button>
      </form>
      <button onClick="goHome()" style="margin-top:10px">Go to login</button>
    </div>
    <script>
      function goHome() {
        window.location.href = '../index.php'
      }
    </script>
  </body>

  </html>
<?php
}
?>
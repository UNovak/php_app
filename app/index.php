<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> LOGIN </title>
</head>

<body>
  <!-- calls login.php when submit for the form is pressed -->
  <form action="functions/login.php" method="post">
    <h2> LOGIN </h2>
    <?php if (isset($_GET['error'])) { ?>
      <p class='error'> <?php echo $_GET['error'] ?></p>
    <?php } ?>
    <label>username</label>
    <input type="text" name="username" placeholder="username" /></br>

    <label>password</label>
    <input type="password" name="password" placeholder="password" /></br>

    <button type="submit">Login</button>
  </form>

  <!-- displays a link to redirect on registration page -->
  <p>Don't have an account? <a href="./functions/register.php">Register here</a></p>
</body>

</html>
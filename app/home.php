<?php
session_start();
include "./db/db.php";

// Retrieve todo data from the database
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$query = "SELECT * FROM todos WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

// Create an array to store todo items
$todos = array();
while ($row = mysqli_fetch_assoc($result)) {
  $todos[] = $row;
}
?>

<?php
// Load XML file
$xml = new DOMDocument();
$xml->load('data.xml');

// Load XSL file
$xsl = new DOMDocument();
$xsl->load('data.xsl');

// Create new XSLT processor and import XSL
$xslt = new XSLTProcessor();
$xslt->importStylesheet($xsl);

// Transform XML
$xslt->setParameter('', 'user_id', $_SESSION['id']); // Pass user_id as parameter to XSLT
$html = $xslt->transformToXML($xml);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo list</title>
</head>

<body>
  <h1>Hello, <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest'; ?></h1>
  <a href="./functions/logout.php">Logout</a>

  <!-- Display transformed HTML -->
  <?php echo $html; ?>

  <form action="./functions/add.php" method="post">
    <label for="task">New Todo:</label>
    <input type="text" name="task" required>
    <button type="submit">Add Todo</button>
  </form>

</body>

</html>
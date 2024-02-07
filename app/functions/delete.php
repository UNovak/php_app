<?php
session_start();
include('../db/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo_id'])) {
  // Sanitize input
  $todo_id = mysqli_real_escape_string($conn, $_POST['todo_id']);
  $user_id = $_SESSION['id'];

  // Delete todo from the database
  $delete_query = "DELETE FROM todos WHERE id = '$todo_id' AND user_id ='$user_id'";
  $result = mysqli_query($conn, $delete_query);

  // Check if the deletion was successful
  if ($result) {
    // Load the todos.xml file
    $xml = simplexml_load_file('../data.xml');

    // Find the todo node to delete
    $todoNode = null;
    foreach ($xml->todo as $todo) {
      if ($todo->id == $todo_id && $todo->user_id == $user_id) {
        $dom = dom_import_simplexml($todo);
        $dom->parentNode->removeChild($dom);
        break;
      }
    }

    // Save the changes to the todos.xml file
    $xml->asXML('../data.xml');

    // Redirect back to the home page
    header("Location: ../home.php");
    exit();
  } else {
    // Handle the case where the deletion failed
    echo "Error: " . mysqli_error($conn);
  }
} else {
  // Handle the case where the todo_id is not provided
  echo "Todo ID not provided.";
}

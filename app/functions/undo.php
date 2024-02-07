<?php
session_start();
include('../db/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo_id'])) {
  $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
  $todo_id = $_POST['todo_id'];
  $change_query = "UPDATE todos SET completed = 0 WHERE id='$todo_id' and user_id='$user_id'";

  $result = mysqli_query($conn, $change_query);

  // Check if the query was successful
  if ($result) {
    // Load the todos.xml file
    $xml = simplexml_load_file('../data.xml');

    // Find the todo node to update
    foreach ($xml->todo as $todo) {
      if ($todo->id == $todo_id) {
        $todo->completed = 0;
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
  // Handle the case where the todo ID is not provided
  echo "Todo ID not provided.";
}

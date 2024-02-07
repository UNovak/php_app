<?php
session_start();
include('../db/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
  // Sanitize input
  $task = mysqli_real_escape_string($conn, $_POST['task']);

  // Insert new todo into database
  $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
  $insert_query = "INSERT INTO todos (user_id, task, completed) VALUES ('$user_id', '$task', '0')";
  $result = mysqli_query($conn, $insert_query);

  // Check if the insertion was successful
  if ($result) {
    // Fetch the ID of the inserted todo
    $todo_id = mysqli_insert_id($conn);
    $completed = 0;

    // Load the todos.xml file
    $xml = simplexml_load_file('../data.xml');

    // Add the new todo to the XML file
    $todo = $xml->addChild('todo');
    $todo->addChild('id', $todo_id);
    $todo->addChild('user_id', $user_id);
    $todo->addChild('task', $task);
    $todo->addChild('completed', $completed);

    // Save the changes to the todos.xml file
    $xml->asXML('../data.xml');

    // Redirect back to the home page
    header("Location: ../home.php");
    exit();
  } else {
    // Handle the case where the insertion failed
    echo "Error: " . mysqli_error($conn);
  }
} else {
  // Handle the case where the task is not provided
  echo "Task not provided.";
}

<?php
  $servername = "0.0.0.0";
  $username = "root";
  $password = "adam1703";
  
  // Create connection
  $conn = new mysqli($servername, $username, $password);
  
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // $conn->query("");

?>

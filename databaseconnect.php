<?php
  $servername = "localhost";
  $username = "id14886851_whitestar_admin";
  $password = "JobCoster@aut0";
  $database = "id14886851_whitestarproducts_admin";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
?>
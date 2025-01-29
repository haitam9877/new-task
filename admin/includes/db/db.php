<?php
$servername = "mysql:host=localhost;dbname=blog";
$username = "root";
$password = "";

try {
  $conn = new PDO($servername, $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
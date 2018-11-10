<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "banya";

$servername = "localhost";
$username = "dkhousec";
$password = "fh5Ye3QcvRq";
$dbname = "dkhousec_banya";

// $mysqli = new mysqli($servername, $username, $password, $dbname);



      // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->query("SET NAMES 'utf8'");
      // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function getUsername($conn,$id) {
      $sql = "SELECT username FROM `member` WHERE `member`.`id` LIKE $id";
      $result = $conn->query($sql);
      // $row = $result->fetch_all(MYSQLI_ASSOC);
      $array = array();
      $username = "";
      while($row = $result->fetch_assoc()) {
            $username = $row['username'];
      }

      return $username;
}

function getBillID($conn,$id) {
      $sql = "SELECT orders_ref FROM `orders` WHERE `orders`.`orders_ref` LIKE '$id'";
      $result = $conn->query($sql);
      // $row = $result->fetch_all(MYSQLI_ASSOC);
      $array = array();
      $username = "";
      while($row = $result->fetch_assoc()) {
            $orders_ref = $row['orders_ref'];
      }

      return $orders_ref;
}
?>
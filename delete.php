<?php
$id = $_GET["id"];
include "db_conn.php";
$sql = "DELETE FROM `crud` WHERE id = {$id}";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: http://localhost/php-crud/index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
?>
<?php
include 'config.php';

$id = $_GET['id'];
$sql = "DELETE FROM students WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "Record deleted successfully!";
} else {
    $_SESSION['error'] = "Error deleting record: " . $conn->error;
}

header('Location: index.php');
?>

<?php
include 'config.php';

$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM students WHERE name LIKE '%$search%' OR enrollment LIKE '%$search%' ORDER BY name";
$result = $conn->query($sql);

include 'index.php';
?>

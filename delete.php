<?php
require "config.php";

$id = $_GET['id'];

$request = "DELETE FROM todolist WHERE id = ?";

$result = $pdo -> prepare($request);
$result -> execute([$_SESSION['id']]);

header("Location: notes.php");
?>
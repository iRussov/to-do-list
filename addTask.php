<?php
session_start();
require "config.php";

if (!empty($_POST['task'])) { 
    $request = "INSERT INTO todolist(login, task, isDone) VALUES (?,?,?)";
    $result = $pdo->prepare($request);
    $result->execute([$_SESSION['login'], $_POST['task'], 0]);
}

header("Location: notes.php");
?>
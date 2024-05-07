<?php
// Задаём параметра для подключения к бд
 $serverName = "localhost";
 $dbName = "project1";
 $userName = "root";
 $password="";

 // Создаём соединение с базой данных
 $pdo = new PDO("mysql:host=$serverName;dbname=$dbName",$userName, $password);
 ?>
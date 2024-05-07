<?php
session_start();
$theme = $_COOKIE['theme'] ?? 'light';
if($_SESSION != null){
    header("Location: notes.php");
}
$btn = $_COOKIE['btn'] ?? '';
$icon = $_COOKIE['icon'] ?? 'fa-sun';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="./styles/styleForLogin.css" rel="stylesheet" type="text/css" />
    <script src="./scripts/theme.js"></script>
    <?php
if($theme == 'dark') {
    echo '<link rel="stylesheet" href="./styles/dark-style.css">';
} else {
    echo '<link rel="stylesheet" href="./styles/light-style.css">';
}
?>
</head>
<body>
<div class = "<?php echo $theme;?> <?php echo $btn;?>">
<div class = "btn" onclick="setTheme('<?php echo $theme;?>')">
    <div class ="btnIndicator">
        <div class ="btnIconContainer">
            <i class="btnIcon fa-sharp fa-solid <?php echo $icon;?>"></i>
        </div>
    </div>
</div>
</div>
<div class="container">
        <h1 class="title">To do list</h1>
        <form action="" method="post">         
            <label for="login"><i class="fa-solid fa-user"></i>  Login:</label>
            <input name="login" type="login" id="login">
            <label for="password"><i class="fa-solid fa-lock"></i>  Password:</label>
            <input name="password" type="password" id="password">
            <input name="signin" type="submit" value="Login" class = "grnBtn">
            <input name="register" type="submit" value="Register"class = "grnBtn">
        </form> 
        <?php
    if(isset($_POST["signin"])){
        require "config.php";

        $login = $_POST["login"];
        $pwd = $_POST["password"];
        // запрос на получение данных из бд
        $request = "SELECT * FROM `users` WHERE login = ? AND password = ?";

        $result = $pdo->prepare($request);
        $result->execute([$login, $pwd]);
        // Вывод полученных данных из бд
        if($row = $result->fetch()) {
            session_start();

            $_SESSION['login'] = $row['login'];

            header("Location: notes.php");
        }
        else {
            echo '<div class="error"><p>Некорректные данные</p></div>
            <style>
            input[type=login], input[type=password] {
                border: 1px solid red;
            }
            </style>';
        }
    }
    if(isset($_POST["register"])){
        header("Location: register.php");
    }
?>
    </div>  
</body>
</html>

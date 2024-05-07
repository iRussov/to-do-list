<?php
$theme = $_COOKIE['theme'] ?? 'light';
$btn = $_COOKIE['btn'] ?? '';
$icon = $_COOKIE['icon'] ?? 'fa-sun';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="./styles/styleForReg.css" rel="stylesheet" type="text/css" />
    <script src="./scripts/theme.js"></script>
    <?php
if($theme == 'dark') {
    echo '<link rel="stylesheet" href="./styles/dark-style.css"';
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
<form action="" method="post" class = "container">
        <h1 class = "title">Registration Form</h1>
        <label for="login"><i class="fa-solid fa-user"></i>  Login:</label>
        <input name="login" type="login">
        <label for="password"><i class="fa-solid fa-lock"></i>  Password:</label>
        <input name="password" type="password">
        <label for="confirmPassword"><i class="fa-sharp fa-solid fa-circle-check"></i>  Confirm password:</label>
        <input name="confirmPassword" type="password">
        <input name="register" type="submit" value="Register" class = "grnBtn">
        <input name="log" type ="submit" value = "Back to login" class = "grnBtn">
        <?php
            if(isset($_POST["register"])) {
                require "config.php";

                $login = $_POST["login"];
                $pwd = $_POST["password"];
                $pwd_confirm = $_POST["confirmPassword"];
                
                $error = "";

                if(empty($login) || empty($pwd) || empty($pwd_confirm)) {
                    $error = "Не все поля заполнены";
                }

                else if($pwd != $pwd_confirm) {
                    $error = "Пароль не совпадает";
                }
                else {
                    $request = "INSERT INTO users(login, password) VALUES (?,?)";

                    $result = $pdo->prepare($request);
                    $result->execute([$login, $pwd]);

                    if($result) header("Location: index.php");
                    else $error = "Error";
                }

                if(!empty($error)) {
                    echo '<div class="error">' . $error . '</div>
                    <style>
                        input[type=login], input[type=password] {
                            border: 1px solid red;
                        }
                    </style>';
                }
            }
            if(isset($_POST["log"])){
                header("Location: index.php");
            }
        ?>
    </form>
</body>
</html>

<?php
session_start();
$theme = $_COOKIE['theme'] ?? 'light';
if($_SESSION==null){
    header("Location: index.php");
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
    <title>To do list</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="./styles/styleForNote.css" rel="stylesheet" type="text/css" />
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
<header class ="header"> 
    <div class = "<?php echo $theme;?> <?php echo $btn;?> switch">
        <div class = "btn" onclick="setTheme('<?php echo $theme;?>')">
            <div class ="btnIndicator">
                <div class ="btnIconContainer">
                    <i class="btnIcon fa-sharp fa-solid <?php echo $icon;?>"></i>
                </div>
            </div>
        </div>
    </div>
    <h1 class="title">To Do List</h1>
    <form action = "" method="post" class = "log">
        <input name="log_out" type = "submit" value = "log out" class = "log_out">
    </form>
</header>
<div class="tdlCont">
<div class="form-container">
<form action = "addTask.php" method = "post" class = "addForm">
    <input name = "task" type="text">
    <input name = "add" type = "submit"  data-bs-dismiss="modal" value = "add" class = "grnBtn">
</form> 
</div>
<div class = "TDL">
<ul>
    <?php
        require "config.php";

        $request = "SELECT id, task, isDone FROM todolist WHERE login = ?";

        $result = $pdo ->prepare($request);
        $result->execute([$_SESSION['login']]);

        while($row = $result -> fetch()) {
            echo '<li>
            '.$row['task'].'
            <a href="updateTask.php?id='.$row['id'].'"><i class="fa-solid fa-pen-to-square"></i></a>
            <a href="removeTask.php?id='.$row['id'].'"><i class="fa-solid fa-trash delete"></i></a>
            </li>';
        }
    ?>
</ul>
</div>
</div>
</body>
</html>
<?php
if(isset($_POST["log_out"])){
    session_start();
    // Обнуляем глобальную переменную
    $_SESSION = array();
    // Уничтожаем сессию
    session_destroy();
    // переходим на страницу входа
    header("Location: index.php");
}
?>

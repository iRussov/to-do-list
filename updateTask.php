<?php
    require "config.php";

    $id = $_GET['id'];
    $sql = "SELECT task FROM todolist WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $text = $rows['task'];

    if (isset($_POST["update"]))
    {
        $task = $_POST['task'];
        if (!empty($_POST['task'])) { 
            $request = "UPDATE todolist SET task = ? WHERE id=?";
            $result=$pdo->prepare($request);
            $result->execute([$task, $id]);
            header("Location: notes.php");
        }
        
    }
    $theme = $_COOKIE['theme'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <?php
if($theme == 'dark') {
    echo '<link rel="stylesheet" href="./styles/dark-style.css"';
} else {
    echo '<link rel="stylesheet" href="./styles/light-style.css">';
}
?>
</head>
<body>
    <div class="cont">
    <form action="" method="post">
        <input type="text" name="task" value="<?php echo $text; ?>">
        <input type="submit" name="update" value="Update" class="grnBtn">
    </form>
    </div>
</body>
</html>
<style>
.cont{
    display:flex;
    justify-content: center;
    align-items: center;
    height: 90vh;
}
input[type="text"] {
  width: 550px;
  padding: 10px;
  border-radius: 10px;
  border: 1px solid #ccc;
  font-size: 32px;
}
.grnBtn {
  padding: 10px 20px;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 32px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
.grnBtn:hover{
  background-color: #4CAF50;
}
</style>
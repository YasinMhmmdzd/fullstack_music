<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION["username"]) && isset($_SESSION["userpass"])){
    header('location:admin/');
}
?>
<html lang="fa_IR" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
    <link rel="stylesheet" href="./assets/css/login.css">
</head>
<body>
    <section class="login-container">
        <h2 class="title">ورود</h2>
        <form method="post">
            <input type="text" class="input" name="username" placeholder="نام کاربری را وارد کنید ">
            <input type="password" class="input" name="userpass" placeholder="رمز خودرا وارد کنید">
            <button class="login-btn" name="submit-btn">ورود</button>
            <?php
            if(isset($_GET['err'])){
                ?>
                <p class="err">خطای نام کاربری یا رمز عبور</p>
                <?php
            }
            ?>
        </form>
    </section>
</body>
</html>
<?php
include "db.php";
if(isset($_POST["submit-btn"])){
    $username = $_POST['username'];
    $userpass = $_POST['userpass'];
    $query = "SELECT * FROM users";
    $result = $db -> query($query);
    foreach($result as $row){
        if($row['user_name'] == $username && $row['user_password'] == $userpass){
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["userpass"] = $userpass;
            header('location:admin/');
        }
        else{
            header('location:?err');
        }
    }
}
?>
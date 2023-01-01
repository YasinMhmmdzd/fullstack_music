<!DOCTYPE html>
<?php
session_start();
include "../db.php";
$user_session_name = $_SESSION['username'];
$user_session_pass = $_SESSION['userpass'];
$query = "SELECT * FROM users WHERE user_name = '$user_session_name' AND user_password = '$user_session_pass' ";
$result = $db -> query($query);
?>
<html lang="fa_IR" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <section class="right-panel">
        <ul>
                <li><h2 style="color:white;">
            <?php
            foreach($result as $user):
                echo $user["user_name"];
            ?>
            </h2>
        <?php
        endforeach;
        ?>
        </li>
            <a href="../index.php">
                <li class="list-menu">بازدید سایت</li>
            </a>
            <a href="?add">
                <li class="list-menu">افزودن آهنگ</li>
            </a>
            <a href="?comments">
                <li class="list-menu">نظرات</li>
            </a>
            <a href="?exit">
                <li class="list-menu exit">خروج</li>
            </a>
        </ul>
    </section>
    <section class="left-panel">
        <?php
        function openAdd(){
            ?>

            <section class="add">
                <form method="post" class="form" enctype="multipart/form-data">
                    <input type="text" name="music_title" placeholder="تیتر آهنگ">
                    <input type="text" name="music_genre" placeholder="ژانر آهنگ">
                    <input type="text" name="music_artist" placeholder="خواننده ی اثر">
                    کاور آهنگ : <input type="file" name="music_cover">
                    فایل آهنگ :<input type="file" name="music_file">
                    <button class="send-music-btn" name="add-music-btn">ثبت آهنگ</button>
                </form>
            </section>

                    <?php
        }
        function openComment(){
            ?>
            <section class="comments">
                <table>
                    <tr>
                    <th>ردیف</th>
                    <th>نویسنده ی کامنت</th>
                    <th>متن کامنت</th>
                    <th>عملیات</th>
                    </tr>
                <?php
                include "../db.php";
                $query = "SELECT * FROM comments ORDER BY comment_id";
                $result = $db -> query($query);
                foreach($result as $comments):
                ?>
                <tr>
                    <td><?=$comments["comment_id"]?></td>
                    <td><?=$comments["comment_author"]?></td>
                    <td><?=$comments["comment_text"]?></td>
                    <td><a href="?delete_comment&comment_id=<?=$comments['comment_id']?>">حذف کامنت</a></td>
                </tr>
                <?php
                endforeach;
                ?>
</table>
            </section>
            <?php
        }
        ?>
    </section>
</body>
</html>
<?php
if(isset($_POST['add-music-btn'])){
    $music_file_path = "../assets/musics/" . $_FILES["music_file"]["name"];
    $music_cover_path = "../assets/img/" . $_FILES["music_cover"]["name"];
    $music_title = $_POST['music_title'];
    $music_genre = $_POST['music_genre'];
    $music_artist = $_POST['music_artist'];
    move_uploaded_file($_FILES["music_cover"]["tmp_name"],$music_cover_path);
    move_uploaded_file($_FILES["music_file"]["tmp_name"],$music_file_path);
    include "../db.php";
    $music_cover_name = $_FILES["music_cover"]["name"];
    $music_file_name = $_FILES["music_file"]["name"];
    $query = "INSERT INTO musics (music_title , music_genre , music_cover , music_artist , music_file) VALUES ('$music_title' , '$music_genre', '$music_cover_name' , '$music_artist' , '$music_file_name')";
    $result = $db -> query($query);
}

if(isset($_GET['add'])){
    openAdd();
}
elseif(isset($_GET['comments'])){
    openComment();
}
elseif(isset($_GET['delete_comment'])){
    $comment_id = $_GET['comment_id'];
    $query = "DELETE FROM comments WHERE comment_id = '$comment_id'";
    $result = $db -> query($query);
    header('location:?comments');
}
elseif(isset($_GET['exit'])){
    session_destroy();
    header('location:../');
}
?>
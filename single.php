<!DOCTYPE html>
<html lang="fa_IR" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <?php
    if(!isset($_GET["id"]) && $_GET["id"] >= 0){
    header("./");
}
else{
    include "db.php";
    $music_id = $_GET['id'];
    $query = "SELECT * FROM musics WHERE music_id = '$music_id'";
    $result = $db -> query($query);
    foreach($result as $music){
        $music_title = $music["music_title"];
        $music_artist = $music["music_artist"];
        $music_cover = $music["music_cover"];
        $music_file = $music["music_file"];
        $music_id = $music["music_id"];
    }
}
?>
    <title><?= $music_title . " از " . $music_artist;?> | وبسایت آهنگ</title>
</head>
<body>
    <?php
    include "header.php";
    ?>
    <h2><?=$music_title?> - <?=$music_artist?></h2>
    <img src="./assets/img/<?=$music_cover?>" class="music-file-image">
    <audio controls>
        <source src="./assets/musics/<?=$music_file?>" type="audio/mpeg">
    </audio>
    <a href="./assets/musics/<?=$music_file?>">Download</a>
    <br>
    <section class="comment-box">
        <form method="post" class="comment-form">
            <input type="text" name="comment-author">
            <textarea name="comment-text"></textarea>
            <button name="comment-btn">ثبت نظر</button>
        </form>
        <hr>
        <?php
        $query = "SELECT * FROM comments WHERE comment_post = '$music_id' ORDER BY comment_id DESC";
        $result = $db -> query($query);
        foreach($result as $comment):
        ?>
        <section class="comment">
            <h4><?=$comment["comment_author"]?></h4>
            <p><?=$comment["comment_text"]?></p>
        </section>
        <?php
        endforeach;
        ?>
    </section>
</body>
</html>
<?php
if(isset($_POST['comment-btn'])){
    $comment_author = $_POST['comment-author'];
    $comment_text = $_POST['comment-text'];
    $query = "INSERT INTO comments (comment_author , comment_post , comment_text) VALUES ('$comment_author' , '$music_id' , '$comment_text')";
    $result = $db -> query($query);
    header("Refresh:0");
}
?>
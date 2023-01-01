<?php
include "db.php";
?>
<!DOCTYPE html>
<!-- Developed by Yasin Mohammadzade (github.com/yasinmhmmdzd) --!>
<html lang="fa_IR" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
<?php
include "header.php";
?>
    <main>
        <section class="music-container">
            <?php
            $query = "SELECT * FROM musics";
            $result = $db -> query($query);
            foreach ($result as $music):
            ?>
            <section class="music">
                <img src="./assets/img/<?=$music['music_cover']?>" class="music-cover">
                <a href=<?="single.php?id=" . $music['music_id']?>>
                <section class="music-body">
                    <h3 class="music-title"><?=$music['music_title']?></h3>
                    <p class="music-artist"><?=$music['music_genre'] . "-" . $music['music_artist']?></p>
                </section>
            </a>
            </section>
            <?php
            endforeach;
            ?>
        </section>
    </main>
    <?php
    include "footer.php";
    ?>
</body>

</html>

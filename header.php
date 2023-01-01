<header>
    <?php
    session_start();
    ?>
        <ul class="list-menu">
            <a href="index.php">
                <li class="list-menu-item">صفحه اصلی</li>
            </a><a href="#">
                <li class="list-menu-item">آهنگ ها</li>
            </a><a href="#">
                <li class="list-menu-item">تماس با ما</li>
            </a>
        </ul>
        <div>
            <a href="login.php">
            <button class="login-btn">
                <?php
                if(isset($_SESSION["username"]) && isset($_SESSION["userpass"])){
                    echo " سلام " .  $_SESSION["username"] . " عزیز ";
                }
                else{
                    ?>
                    ورود به پنل
                    <?php
                }
                ?>
            </button>
        </a>
        </div>
    </header>
<?php session_start()?>
<link rel="stylesheet" href="../css/header.css">
<link rel="stylesheet" href="../css/anim.css">
<link rel="stylesheet" href="../css/main.css">

<body onload="time()">
    <header>
        <?php  
            $result_header = mysqli_query($mysqli,"SELECT * FROM `header`"); 
            echo "<div class=\"textheaders\">";
                while ($header = mysqli_fetch_assoc($result_header)) {
                    echo"<a href=\"".$header['href']."\" class=\"menu-link\">".$header['text']."</a>";
                }
                echo "
                <div class=\"username\">
                    <ul class=\"menu\">
                        <li class=\"menu_list\"><a href=\"#\">".$_SESSION['user']."</a>
                            <ul class=\"menu_drop\">
                                <li><a onclick=\"time_info('block')\" id=\"time\"></a></li>
                                <li><a href=\"php/exit.php\" class=\"menu-link\">Выход</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>";
            $result_header = mysqli_query($mysqli,"SELECT * FROM `header`"); 
            echo "<div class=\"imageheaders\">";
                while ($header = mysqli_fetch_assoc($result_header)) {
                    echo"<a href=\"".$header['href']."\">
                    <span class=\"".$header['image']."\"></span>
                    </a>";
                }
                echo "<a href=\"php/exit.php\">
                    <span class=\"fa fa-sign-out\"></span>
                    </a>";
            echo "</div>";
        ?>
    </header>

    <div class="page">
        <div class="mouse-parallax">
            <div id="smoke" class="mouse-parallax-smoke"></div>
        </div>
        <div class="smoke">
            <div class="pulsate">
                <h1>Smoke</h1>
            </div>
        </div>
        <div class="scrolldown" style=""></div>
    </div>
</body>

<?php include "time_info.php";?>

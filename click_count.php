<?php
    session_start();
?>
<html>
    <head>
        <meta charset="utf-8" />
    
    </head>
    <body>
        
        <a href="index_.html">Оглавление сайта</a>
        <h1>Считаем щелчки!</h1>

        <form>
        
        
        <button id="btn1" >Щелкни меня!</button> <br />
        </form>
        <?php
            $i =0;

            // //вспомним переменную счетчика если она существует
            // if (isset($_SESSION["clicks"]))
            //     $i = $_SESSION["clicks"];
            // $i += 1;
            // //запомним текущее хначение счетчика щелчков
            // // в сессионной переменной clicks
            // $_SESSION["clicks"] = $i;
            
            if (isset($_COOKIE['clicks']))
                $i = $_COOKIE['clicks'];

            $i += 1;
            setcookie("clicks",$i, time() + 20000);

            echo("Всего щелчков: $i");
        ?>

    </body>
</html>
<?php
    session_start();
    // если нет сессионной переменной с названием user, не пускаем
    if (!isset($_SESSION["user"])) {
        echo('<meta http-equiv="refresh" content="2; URL = ../login.php">');
        die("Сначала авторизуйтесь или зарегистрируйтесь!");
    }
    $user = $_SESSION["user"];
    //echo("1111".getenv('MYAPP_CONFIG'));
    include ('/var/www/html/params.php')

            //$user = $_REQUEST["user"];
            //echo($user);
            //$pwd = $_REQUEST["pwd"];
            //$hashed = hash('sha256',$pwd);
            $sql = "SELECT ID, Number1, Number2, Result, UserID
                    FROM log
                    WHERE UserID='$user'
            ";
            //echo($sql);
            $conn = mysqli_connect($DB_URL,$DB_USER,$DB_PWD,$DB_NAME);

            $statement = mysqli_prepare($conn,$sql);
            //mysqli_stmt_bind_param($statement,"ss",$user,$hashed);
            mysqli_stmt_execute($statement);
            
            echo(mysqli_error($conn));

            $cursor = mysqli_stmt_get_result($statement);
            $result = mysqli_fetch_all($cursor);

            
            //var_dump($result);
            mysqli_close($conn);

            echo(json_encode($result));


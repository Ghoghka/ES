<?php 
    session_start();
    include(getenv('MYAPP_CONFIG')); 
    if(isset($_REQUEST["user"],$_REQUEST["pwd"])){
        $user = $_REQUEST["user"];    
        $pwd = $_REQUEST["pwd"];
        $hashed = hash('sha256',$pwd);
        $sql_select = "SELECT ID, UserName
                    FROM users
                    WHERE UserName=?";
        $sql_insert = "INSERT 
                    INTO users
                    SET UserName=?, PwdHash=?";
        
        //$conn = mysqli_connect("localhost:3306","root","","calc");
        $conn = mysqli_connect($DB_URL,$DB_USER,$DB_PWD,$DB_NAME);

        //$cursor = mysqli_query($conn,$sql_select);
        //$result = mysqli_fetch_all($cursor);

        $statement = mysqli_prepare($conn,$sql_select);
        mysqli_stmt_bind_param($statement,"s",$user);
        mysqli_stmt_execute($statement);
        
        echo(mysqli_error($conn));

        $cursor = mysqli_stmt_get_result($statement);
        $result = mysqli_fetch_all($cursor);

        //echo(mysqli_error($conn));
        //var_dump($result);
        
        if(count($result) > 0) {
            echo ("<h2>Обломс! Имя $user уже занято. Попробуйте другое.</h2>");
            mysqli_close($conn);    
            //echo('<meta http-equiv="refresh" content="2; URL = register.php">');
            }
        else {
            //$cursor = mysqli_query($conn,$sql_insert);

            $statement = mysqli_prepare($conn,$sql_insert);
            mysqli_stmt_bind_param($statement,"ss",$user,$hashed);
            mysqli_stmt_execute($statement);
            
            echo(mysqli_error($conn));

            $cursor = mysqli_stmt_get_result($statement);
            //$result = mysqli_fetch_all($cursor);

            //$error_msg = mysqli_error($conn);
            //echo($error_msg);
            //mysqli_close($conn);
            //$_SESSION["user"] = $user;
            //echo ("<h2>Поздравляем, $user!<br />
            //Вы успешно зарегистрированы и вошли в систему.<br />
            //Сейчас Вы будете перенаправлены на главную страницу.</h2>");
            //echo('<meta http-equiv="refresh" content="5; URL = index_.html">');
            if ($cursor == 'FALSE'){
                 echo(mysqli_error($conn));
                 mysqli_close($conn);
            }
            else {
                mysqli_close($conn);
                $_SESSION["user"] = $user;
                echo ("<h2>Поздравляем, $user!<br />
                Вы успешно зарегистрированы и вошли в систему.<br />
                Сейчас Вы будете перенаправлены на главную страницу.</h2>");
                echo('<meta http-equiv="refresh" content="5; URL = index_.html">');
            }   
        }
    }
?>
<html>
    <head>
        <meta charset="utf-8" />
    
    </head>
    <body>
        <a href="index_.html">Оглавление сайта</a>
        <h2>Регистрация нового пользователя</h2>
        <h2>придумайте имя и пароль</h2>
        <form method="post">
        <p>Введите Ваше имя</p>
        <input name="user"/> <br />
        <p>Введите Ваш пароль</p>
        <input name="pwd" type="password"/> <br />
        <button id="btn1" >GO!</button> <br />
        </form>
    </body>
</html>

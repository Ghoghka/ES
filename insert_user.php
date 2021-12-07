<?php
session_start();

            $user = $_REQUEST["user"];
            // echo($user);
            $pwd = $_REQUEST["pwd"];
            $hashed = hash('sha256',$pwd);
            // echo($hashed);
            $sql = "INSERT INTO users SET UserName='$user', PwdHash='$hashed'";
            // echo($sql);
            $conn = mysqli_connect("localhost:3306","root","","calc");
            $cursor = mysqli_query($conn,$sql);
            // $result = mysqli_fetch_all($cursor);
            echo(mysqli_error($conn));
            //var_dump($cursor);
            mysqli_close($conn);
            $_SESSION["user"] = $user;
            echo('<meta http-equiv="refresh" content="2; URL = index_.html">');
?>
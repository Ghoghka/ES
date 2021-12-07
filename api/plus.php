<?php

session_start(); 
include("C:/AppParams/params.php");
//Это комментарий PHP

$x = $_REQUEST["x"];
$y = $_REQUEST["y"];
$z = $x + $y;

$user = $_SESSION["user"];

//$conn = mysqli_connect("localhost:3306","root","","calc");
$conn = mysqli_connect($DB_URL,$DB_USER,$DB_PWD,$DB_NAME);

$sql = "INSERT INTO log(Number1, Number2, Result, UserID) VALUES($x,$y,$z,'$user')";
//$sql = "INSERT INTO log(Number1, Number2, Result, UserID) VALUES($x,$y,$z,'anonym')";

mysqli_query($conn,$sql);
//echo(mysqli_error($conn));
//$sql = "INSERT INTO log(Number1, Number222, Result, UserID) VALUES(11,22,33,'anonym')";
//mysqli_query($conn,$sql);
//echo(mysqli_error($conn));
mysqli_close($conn);

echo($z);
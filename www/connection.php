<?php

function getConnection()
{
    $host = "127.0.0.1";
    $db = "test";
    $user = "root";
    $pass = "";
    $conn = @mysqli_connect($host, $user, $pass, $db) or die("Mysql Baglanamadi");

    return $conn;
}


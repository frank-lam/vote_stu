<?php

//连接数据库

function connectDb()
{
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=hise;", "root", "");
        $pdo->query("set names utf8");
        //echo "<strong>->数据库连接成功</strong>";
    } catch (PDOException $e) {
        die("数据库连接失败" . $e->getMessage());
    }
    return $pdo;
}
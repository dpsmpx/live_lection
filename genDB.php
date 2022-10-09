<?php
    $servername = "127.0.0.1";// sql305.xenn.xyz  127.0.0.1
    $dbusername = "root";// xnnx_31611291  root
    $dbpassword = "";// sBggwLtF8eTc5EXiwDVDKhwBXVzfZvhicKW2QeA3
    $database = "";
    $sql = file_get_contents('end_live_lection.sql') or die('Не удалось найти сценарий генерации');
    $db = new PDO('mysql:host='.$servername.';dbname='.$database,$dbusername,$dbpassword) or die('Ошибка подключения');
    $db->query("create database end_live_lection;") or $db->query("drop database end_live_lection;create database end_live_lection;");
    $db->query($sql) or die('Ошибка запроса');
    mysqli_close($db);
    header('Location: index.html');
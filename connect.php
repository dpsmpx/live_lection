<?php
    $servername = "127.0.0.1";
    $dbusername = "root";
    $dbpassword = "";
    $database = "end_live_lection";
    $conn = new mysqli($servername,$dbusername,$dbpassword,$database) or die("Нет подключения к серверу!");
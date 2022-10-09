<?php
    session_start();
    include("connect.php");
    $name = $_POST['name'];
    $login = $_POST['login'];
    $password = md5($_POST['password']);
    //Проверить наличие такого же пользователя
    $res = $conn->query("select * from users where name='$name' and login='$login' and password='$password';") or die("Ошибка выбора");
    if (mysqli_num_rows($res)==1) die("Такой пользователь уже есть!");//header("Location: index.html");
    //Добавить пользователя
    $conn->query("insert into users (name,login,password) values ('$name','$login','$password');") or die("Ошибка добавления записи!");
    //Получить id_user
    $_SESSION['id_user'] = mysqli_fetch_array($conn->query("select * from users where name='$name' and login='$login' and password='$password';"))['id_user'];
    mysqli_close($conn);
    header("Location: selectLection.php");
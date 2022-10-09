<?php
    session_start();
    include('connect.php');
    $login = $_POST['login1'];
    $password = md5($_POST['password1']);
    $dblogins = $conn->query("select * from users where login='$login' and password='$password';") or die("Ошибка запроса!");
    $id_user = "";
    foreach ($dblogins as $dblogin)
        $id_user = $dblogin['id_user'];
    mysqli_close($conn);
    if (id_user=="") {
        header('Location: index.html');
     } else {
        $_SESSION['id_user'] = $id_user;
        header('Location: selectLection.php');
    }
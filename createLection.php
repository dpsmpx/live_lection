<?php
    session_start();
    session_destroy();
    session_start();
    include('connect.php');
    $table = "lections";
    $conn = new mysqli($servername,$dbusername,$dbpassword,$database) or die("Нет подключения к серверу!");
	$lec_name=$_POST['lec_name'];
    $about=$_POST['about'];
    $id_user = $_SESSION['id_user'];
    $query="insert into $table (id_user,name,about,have_scenario) values ('$id_user','$lec_name','$about','0');";
    echo $query;
    $conn->query($query) or die("Ошибка добавления записи!");
    //Получить id_lect
    $query="select * from $table where id_user='$id_user' and name='$lec_name' and about='$about' and have_scenario='0'";
    $_SESSION['id_lect'] = mysqli_fetch_array($conn->query($query))['id_lect'];
    $_SESSION['lec_name'] = $lec_name;
    mysqli_close();
    header("Location: page_editor.php");
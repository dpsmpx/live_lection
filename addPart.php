<?php
    session_start();
    $id_lect = $_SESSION['id_lect'];
	$slide_name = $_POST['slide_name'];
    $about = $_POST['about'];
	$pic_path = $_FILES['filename']['tmp_name'];
    move_uploaded_file($pic_path, __DIR__.'\\media\\'.$_FILES['filename']['name']);
    $pic_path = 'media\\\\'.$_FILES['filename']['name'];
    $vid_path = $_FILES['filename_vid']['tmp_name'];
    move_uploaded_file($vid_path, __DIR__.'\\media\\'.$_FILES['filename_vid']['name']);
    $vid_path = 'media\\\\'.$_FILES['filename_vid']['name'];
	include('connect.php');
    //Проверить наличие такого же слайда
    $query = "select * from slide where id_lect='$id_lect' and name='$slide_name' and about='$about' and pic_path='$pic_path' and vid_path='$vid_path';";
    $res = $conn->query($query) or die("Ошибка запроса подобного");
    if (mysqli_num_rows($res)==1) die("Подобный слайд уже есть в базе данных");//header('Location: page_editor.html');
    //Добавить слайд
    $query = "insert into slide (id_lect,name,about,vid_path,pic_path) values ($id_lect,'$slide_name','$about','$vid_path','$pic_path');";
    $conn->query($query) or die("Ошибка добавления записи!");
    //Получить id_slide и прочие параметры
    $query = "select * from slide where id_lect='$id_lect' and name='$slide_name' and about='$about' and pic_path='$pic_path' and vid_path='$vid_path';";
    $_SESSION['id_slide'] = mysqli_fetch_array($conn->query($query))['id_slide'];
    mysqli_close($conn);
    header("Location: page_editor.php");
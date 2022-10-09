<?php
	$id_slide = $_REQUEST['id_slide'];
	include('connect.php');
	$slide = mysqli_fetch_array($conn->query("select * from slide where id_slide='$id_slide'")) or die('Слайд не найден!');
	$_SESSION['id_slide'] = $id_slide;
	$_SESSION['slide_name'] = $slide['name'];
	$_SESSION['about_slide'] = $slide['about'];
	$_SESSION['pic_path'] = $slide['pic_path'];
	header('Location: page_editor.php');
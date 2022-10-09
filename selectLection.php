<?php
    session_start();
    session_destroy();
    session_start();
    include('connect.php');
    $table='lections';
    $id_user = $_SESSION['id_user'];
    $lections=$conn->query("select * from lections where id_user='$id_user'") or die("Ошибка запроса!");
    mysqli_close($conn);
?>

<head>
    <meta charset="utf-8">
    <title>Выбор лекции</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table style="max-width: 80%;margin:auto;background: #ccc;border:1px solid #444">
        <tr><td><H3>Проект мультимедиа лекции - выбор лекции</H3></td></tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <p style="background: #ccc;border: #aaa solid 2px;border-radius: 5px;text-align: center;">Выбор лекции</p>
                        </td>
                        <td>
                            <p style="background: #ccc;border: #aaa solid 2px;border-radius: 5px;text-align: center;">Создать лекцию</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            if (mysqli_num_rows($lections)==0) echo "Лекций нет!";
                            else echo '<table>';?>
                            <?php if (mysqli_num_rows($lections)!=0)
                                while ($name=mysqli_fetch_array($lections))
                                    echo '<tr><td><a href="page_editor.php?&id_lect='.$name[0].'">'.$name[2].'</a></td></tr>';?>
                            <?php if (mysqli_num_rows($lections)!=0) echo '</table>';?>
                        </td>
                        <td>
                            <form class="center" method="post" name="form" action="createLection.php">
                                <table>
                                    <tr><td><label for="name">Название</label></td>
                                        <td><label for="about">Описание лекции</label></td></tr>
                                    <tr><td><input placeholder="Введите название" name="lec_name" size="17" required></td>
                                        <td><textarea placeholder="Введите описание лекции" id="about" name="about" style="resize:none" maxlength="200" cols="34" rows="4" required></textarea></td></tr>
                                </table>
                                <input style="width:100%" type="submit" value="Создать лекцию">
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
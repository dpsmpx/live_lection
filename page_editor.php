<!DOCTYPE html>
    <!--Получить все необходимые данные из БД-->
    <?php
        session_start();
        include('connect.php');
        $id_user = $_SESSION['id_user'];
        if ($_REQUEST['id_lect']) {
            $id_lect = $_REQUEST['id_lect'];
            $_SESSION['id_lect'] = $id_lect;
        }
        else
            $id_lect = $_SESSION['id_lect'];
        $lection=mysqli_fetch_array($conn->query("select * from lections where id_lect='$id_lect'")) or die("Ошибка запроса!");
        $slides=$conn->query("select * from slide where id_lect='$id_lect'") or die("Ошибка запроса!");
        $lec_name = $lection['name'];
        if (!$_SESSION['id_slide']) {
            $_SESSION['id_slide'] = '1';
            $id_slide = '1';
        } else {
            $id_slide = $_SESSION['id_slide'];
            //Загрузить данные слайда
            $slide=mysqli_fetch_array($conn->query("select * from slide where id_slide='$id_slide'")) or die("Ошибка запроса!");
            $slide_name = $slide['name'];
            $about_slide = $slide['about'];
            $vid_path = $slide['vid_path'];
            $pic_path = $slide['pic_path'];
            echo $pic_path;
            //load slide data
        }
        mysqli_close($conn);
    ?>
<head>
    <meta charset="utf-8">
    <title>Интерактивные лекции</title>
    <link rel="stylesheet" href="style.css">
    <script src="c.js"></script>
</head>

<body style="max-width: 80%;margin:auto;background: #ccc;border:1px solid #444">
    <table>
        <!--DEBUG-->
        <tr><td style="background: #bbb;color: #222;border: 2px solid #444">
            <center><H3>debug</H3></center>
            <?php var_dump($_SESSION);
            echo '<br>pic_path='.$pic_path?>
        </td></tr>
        <!--УПРАВЛЕНИЕ САЙТОМ-->
        <td><tr>
            <!--Код смены названия заменить на popup-->
            <table>
                <tr>
                    <td><H1 class="lec_name" id=lec_name onclick="document.getElementById('lec_name').innerHTML=prompt('Введите название лекции')"><?php echo $lec_name;?></H1></td>
                    <td><H1><?php echo $slide_name;?></H1></td>
                    <!--Проверить наличие слайдов-->
                    <td><button class="button">Удалить слайд</button></td>
                    <td></td>
                    <td><p class="lec_name" onclick="window.location.href = 'page_player.php'">Режим: редактирование</p></td>
                    <td><img alt="mode" id="mode" style="float:right" src="resources/play_mode.png" onclick="window.location.href = 'page_player.php'"></td>
                </tr>
            </table>
        </tr></td>
        <!--КОНТЕНТ-->
        <tr><td>
            <table>
                <tr>
                    <td style="background-color: #bbb;text-align: center">Слайды</td>
                    <td style="background-color: #bbb;text-align: center">Видео</td>
                    <td style="background-color: #bbb;text-align: center">Презентация</td>
                </tr>
                <tr>
                    <td>
                        <?php
                            while ($slide_now=mysqli_fetch_array($slides))
                                echo "
                                    <table style='width:100%'><tr><td style='text-align:center'>
                                    <a width='200px' href='changeSlide.php?id_slide=$slide_now[0]'>$slide_now[2]</a>
                                    </td></tr></table>
                                ";
                                /*<a width='200px' href='changeSlide.php?id_slide=$name[0]' onclick='<?php $_SESSION[id_slide]=$name[2];header(Location: editor_player.php);?>'>$name[2]</a>*/
                            //mysqli_close();
                        ?>
                        <div id="newPart"></div>
                        <button style="width: 100%" class="button" onclick="document.getElementById('addPartForm').style.display='flex'">Добавить слайд</button>
                        <div id="addPartForm" class="popup-container">
                            <div class="popup">
                                <form action="addPart.php" method="post" enctype="multipart/form-data">
                                    <H1>Добавить слайд</H1>
                                    <input size="50" type="text" name="slide_name" placeholder="Название" />
                                    <textarea style="resize:none" rows="10" cols="49" type="text" name="about" placeholder="Описание" /></textarea>
                                    <p>Выберите видеофрагмент:</p>
                                    <input type="file" name="filename_vid"/>
                                    <p>Выберите изображение слайда:</p>
                                    <input type="file" name="filename"/>
                                    <input class="button" type="submit" value="Подтвердить">
                                </form>
                                <button onclick="document.getElementById('addPartForm').style.display='none'">Отмена</button>
                            </div>
                        </div>
                    </td>
                    <td>
                            <!DOCTYPE html>

    <html>

    <head>

      <meta charset="utf-8">

      <meta name="viewport" content="width=device-width">

      <style> 

     button {

      margin: 0 3px 10px 0;

      padding-left: 2px;

      padding-right: 2px;

      width: 99px;

    }

     

    button:last-of-type {

      margin: 0;

    }

     

    p.borderBelow {

      margin: 0 0 20px 0;

      padding: 0 0 20px 0;

    }

     

    video {

      height: 232px;

      margin: 0 12px 20px 0;

      vertical-align: top;

      width: calc(20em - 10px);

    }

     

     

    video:last-of-type {

      margin: 0 0 20px 0;

    }

     

    video#gumVideo {

      margin: 0 20px 20px 0;

    }

     

    @media screen and (max-width: 500px) {

      button {

        font-size: 0.8em;

        width: calc(33% - 5px);

      }

    }

     

    @media screen and (max-width: 720px) {

      video {

        height: calc((50vw - 48px) * 3 / 4);

        margin: 0 10px 10px 0;

        width: calc(50vw - 48px);

      }

     

      video#gumVideo {

        margin: 0 10px 10px 0;

      }

    }

      </style>

    </head>

    <body>

    <div id="container">

     

        <video id="gum" autoplay muted></video>

        <video id="recorded" loop controls></video>

     

        <div>

          <button id="record" disabled>Start Recording</button>

          <button id="play" disabled>Play</button>

          <button id="download" disabled>Download</button>

        </div>

     

      </div>

      <script>

     

    var mediaRecorder;

    var recordedBlobs;

     

    var gumVideo = document.querySelector('video#gum');

    var recordedVideo = document.querySelector('video#recorded');

     

    var recordButton = document.querySelector('button#record');

    var playButton = document.querySelector('button#play');

    var downloadButton = document.querySelector('button#download');

     

    recordButton.onclick = toggleRecording;

    playButton.onclick = play;

    downloadButton.onclick = download;

     

     

    navigator.mediaDevices.getUserMedia({ audio: true,video: true})

      .then((stream) => {

          recordButton.disabled = false;

          console.log('getUserMedia() got stream: ', stream);

          window.stream = stream;

          gumVideo.srcObject = stream;

      })

      .catch((error) => {

          console.log('navigator.getUserMedia error: ', error);

      });

     

    function handleDataAvailable(event) {

      if (event.data && event.data.size > 0) {

        recordedBlobs.push(event.data);

      }

    }

     

    function handleStop(event) {

      console.log('Recorder stopped: ', event);

    }

     

    function toggleRecording() {

      if (recordButton.textContent === 'Start Recording') {

        startRecording();

      } else {

        stopRecording();

        recordButton.textContent = 'Start Recording';

        playButton.disabled = false;

        downloadButton.disabled = false;

      }

    }

     

     

    function startRecording() {

      recordedBlobs = [];

     

      try {

        mediaRecorder = new MediaRecorder(window.stream);

      } catch (e) {

        console.error('Exception while creating MediaRecorder: ' + e);

        return;

      }

      console.log('Created MediaRecorder', mediaRecorder);

      recordButton.textContent = 'Stop Recording';

      playButton.disabled = true;

      downloadButton.disabled = true;

      mediaRecorder.onstop = handleStop;

      mediaRecorder.ondataavailable = handleDataAvailable;

      mediaRecorder.start(10);

      console.log('MediaRecorder started', mediaRecorder);

    }

     

    function stopRecording() {

      mediaRecorder.stop();

      console.log('Recorded Blobs: ', recordedBlobs);

      recordedVideo.controls = true;

    }

     

    function play() {

      var superBuffer = new Blob(recordedBlobs, {type: 'video/webm'});

      recordedVideo.src = window.URL.createObjectURL(superBuffer);

    }

     

    function download() {

      var blob = new Blob(recordedBlobs, {type: 'video/webm'});

      var url = window.URL.createObjectURL(blob);

      var a = document.createElement('a');

      a.style.display = 'none';

      a.href = url;

      a.download = 'test.webm';

      document.body.appendChild(a);

      a.click();

      setTimeout(function() {

        document.body.removeChild(a);

        window.URL.revokeObjectURL(url);

      }, 100);

    }

      </script>

    </body>

    </html>
                        <canvas id=canva></canvas>
                        <!--
                        <video class="red_border" width="100%" height="200px" id="video" alt="Видео" onload="load('vid.mp4')">
                            <source src="vid.mp4" type="video/mp4">
                        </video>-->
                    </td>
                    <td>
                        <canvas id="canvas" onclick="setArc(Event.clientX,Event.clientY)" width="400%" height="200px" class="red_border"></canvas>
                    </td>
                </tr>
                <tr><td>
                    <div style="display: grid;grid-template-columns: auto auto auto auto auto 1fr auto auto auto;">
                        <!--id=timeline onload=timer()>-->
                        <img alt="rec.png" src="resources/rec.png" onclick="start_recording()">
                        <img alt="stop.png" src="resources/stop.png" onclick="stop_recording()">
                        <img alt="save.png" src="resources/save.png" onclick="save_recording()">
                        <!--видео-->
                        <div><img alt="play.png" src="resources/play.png" onclick="play_pause_m2()" id="ctrl"></div>
                        <div><img alt="prev.png" src="resources/prev.png" onclick="go_prev()" id="ctrl"></div>
                        <div><img alt="next.png" src="resources/next.png" onclick="go_next()" id="ctrl"></div>
                        <div style="float:left"><img alt="play.png" src="resources/play.png" onclick="play_pause_m2()" id="ctrl"></div>
                        <div><img alt="prev.png" src="resources/prev.png" onclick="go_prev()" id="ctrl"></div>
                        <div><img alt="next.png" src="resources/next.png" onclick="go_next()" id="ctrl"></div>
                    </div>
                </td></tr>
            </table>
        </td></tr>
    </table>
</body>

<script>
    window.addEventListener("load", function(){
        fname = "<?php echo $pic_path;?>"
        canvas = document.getElementById("canvas")
        context = canvas.getContext("2d")
        img = new Image()
        img.src = fname
        img.onload = function() {context.drawImage(img, 0, 0, 400, 200)}
    });
    function start_recording() {
        
    }
    /*
    document.addEventListener('readystatechange', () => {
        let vid = document.getElementById('video')
        if (document.readyState === 'complete')
            let duration = vid.duration
    });
    */
    /*
    function start_recording(){}
    function stop_recording(){}
    function save_recording(){}
    function set_nowtime(){}
    */
</script>
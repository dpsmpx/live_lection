actions = []
duration = 0
nowpos = 0
nowslide = 'slide1.jpg'

function load(fname) {
    document.getElementById('video').src = fname
}

function loadslide(fname) {
    document.getElementById('video').src = fname
}

function fillCircle(x, y, radius, color) {
    canvas = document.getElementById('canvas');
    context = canvas.getContext('2d');
    context.fillStyle = color;
    context.beginPath();
    context.arc(x + radius / 2, y + radius / 2, radius / 2, 0, 2 * Math.PI);
    context.fill();
}

function setArc(X, Y) {
    realX = X - document.getElementsByClassName('player')[0].offsetWidth - document.getElementById('themes').offsetWidth - document.getElementById('themes').offsetLeft
    realY = Y - document.getElementById('titlePresent').offsetHeight - document.getElementById('titlePresent').offsetTop
    fillCircle(realX, realY, 8, "WHITE")
    action = {
        x: realX,
        y: realY,
        time: Date.now(),
        type: "Arc"
    }
    actions.push(action)
}

function set_now(clX) {
    vid = document.getElementById("video")
    len = vid.duration
    nowPx = clX - 96 - document.getElementById('themes').offsetWidth - document.getElementById('themes').offsetLeft
    fullPx = document.getElementById('line').offsetWidth
    newTime = len / fullPx * nowPx
    vid.currentTime = newTime
    document.getElementById("now_line").style.width = nowPx.toString() + 'px'
}

function go_prev() {
    vid = document.getElementById("video")
    newTime = vid.currentTime - 10
    vid.currentTime = newTime
    len = vid.duration
    fullPx = document.getElementById('line').offsetWidth
    newPx = fullPx / len * newTime
    document.getElementById("now_line").style.width = newPx.toString() + 'px'
}

function go_next() {
    vid = document.getElementById("video")
    newTime = vid.currentTime + 10
    if (newTime > vid.duration) {
        alert('Видео подошло к концу')
        vid.currentTime = duration
    } else if (newTime === (duration + 10)) {
        alert('Видео закончилось')
    }
    vid.currentTime = newTime
    len = vid.duration
    fullPx = document.getElementById('line').offsetWidth
    newPx = fullPx / len * newTime
    document.getElementById("now_line").style.width = newPx.toString() + 'px'
}

//Проигрывание
function play_pause_m1() {
    vid = document.getElementById('video')
    ctrl = document.getElementById('ctrl')
    if (ctrl.src.indexOf('play') == -1) {
        vid.pause()
        ctrl.src = "resources/play.png"
    } else {
        vid.play()
        pos = 1;
        //while (pos <)
        ctrl.src = "resources/pause.png"
        for (i = 0; i < actions.length; i++) {
            if (i > 0)
                setTimeout(fillCircle, actions[i].time - actions[0].time, actions[i].x, actions[i].y,8,'WHITE')
            else
                fillCircle(actions[i].x, actions[i].y,8,'WHITE')
        }
    }
}

//Запись
function play_pause_m2() {
    vid = document.getElementById('video')
    ctrl = document.getElementById('ctrl')
    if (ctrl.src.indexOf('play') == -1) {
        vid.pause()
        ctrl.src = "resources/play.png"
    } else {
        vid.play()
        ctrl.src = "resources/pause.png"
    }
}




function timer() {
    document.body.insertAdjacentHTML("afterbegin", '<span id="container"></span><br>')
    insertTimeStr(container)
    let timerId = setInterval(insertTimeStr, 1000, container)

    function insertTimeStr(cont) {
        let now = new Date() // получение текущей отметки времени

        let h = now.getHours(), // выделение из нее значений часов,
            m = now.getMinutes(), // минут и секунд
            s = now.getSeconds()

        if (h < 10) h = "0" + h // если значение состоит из одной цифры,
        if (m < 10) m = "0" + m // добавляем перед ним символ нуля
        if (s < 10) s = "0" + s

        cont.innerHTML = '<span class="hours">' + h + "</span>" + ":" +
            '<span class="minutes">' + m + "</span>" + ":" +
            '<span class="seconds">' + s + "</span>"
    }

    function clockStart() {
        clearInterval(timerId)
        timerId = setInterval(insertTimeStr, 1000, container)
    }

    function clockStop() {
        clearInterval(timerId)
    }
}
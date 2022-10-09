# end_live_lection
Дипломный проект - интерактивные лекции

Замечания:
- github pages не поддерживает .php

**Спринт 0**


**1. Работа с видео.**

ok  1.1. На веб странице стандартными средствами HTML 5 отобразить видео.

ok    Видео взять: с локального диска, получить по URL (лучше установить на компьютер OpenServer).

ok    Для простоты можно зашить адрес видеофайла в JScript код. 

   1.2. Научиться управлять показом видеофайла:

ok    Пауза, Воспроизведение.

ok    Перемотка вперед, Перемотка назад.

ok    Выставить по времени (время можно зашить или  брать из текстбокса).

no    Перемотка при зажатии.

ok    Менять длину полосы при +10-10 сек.

no    Менять длину по ходу воспроизведения видео.

no    Контролировать конец и начало воспроизведения.

no    В конце воспроизведения менять значок паузы на плей.

   1.3. Научиться записывать видео с веб камеры на локальный файл.

no    Кнопка Начать запись,

no    кнопка Закончить запись и сохранить

no 1.4. Переключение на следующую запись, смена картинки


**2. Работа со слайдами.**

ok  2.1. На веб странице организовать окно для отображения слайдов.

ok    Разместить в окне картинку (взять с локального диска, получить по URL)

ok  2.2. Разместить 3 кнопки 3-х цветов.

ok    При нажатии на кнопку закрашивать область соответствующим цветом. 

ok  2.3. Перед закрашиванием выводить на экран текст: цвет кнопки и время нажатия

ok  2.4. Рисование на форме с использованием Canvas.

ok    При нажатии на область рисовать круг.

ok    Записывать нажатия в память.

ok  2.5. Режимы работы.

ok    Добавить кнопку выбора режима работы: запись/воспроизведение.

ok  2.6. Воспроизведение.

ok    Воспроизводить записанные действия: режим воспроизведения, нажатие кнопки плей от видеоплеера.

no  2.7. Переключение записи.

no    При окончании воспроизведения кнопка далее переключает на следующее видео.

no    Панель слева позволяет переключать видео вручную.

**3. Работа с БД.**

Для решения задачи можно выбрать один из двух вариантов

а) картинки лежат в BLOB поле

б) картинки лежат в виде файлов, а в бд хранится имя файла. 

3.1. Создать в БД таблицу для хранения картинок (данных о картинках)

3.2. Написать php скрипт, формирующий страницу со списком картинок

3.3. Написать рнр скрипт, формирующий страницу картинки

3.4. Связать скрипты гиперссылками.


**Спринт 1**

Целью спринта является построение сигнального прототипа системы СМЛ (Студии Мультимедиа Лекций).

ПО должно включать следующие компоненты:
- Программа сборки МЛ
- Программа презентации и работы с МЛ
- no Язык разметки интерактивных мультимедиа лекций (IMLML - Interactive Multimedia Lectures Markup Language) и JScript библиотеку для работы с форматом

**А.1. Программа сборки МЛ**

Программа сборки мультимедиа лекций реализуется как одностраничное веб приложение и работает с данными, лежащими в каталоге запуска с локальной адресацией всех ссылок.

Входными данными программы являются: 

- набор файлов изображений формата / форматов (?);

- текстовый файл формата CSV, с названием scenario.csv,

 содержащий предполагаемый сценарий МЛ с указанием порядкового номера слайда,

 названия слайда, имени файла рисунка слайда.


Выходными данными программы являются:

- scenario.csv;

- набор видеофайлов формата (mpg?), соответствующий шагам (слайдам) собранной МЛ;

- набор файлов изображений формата (?), соответствующий реально употребленным в лекции слайдам;

- текстовый файл формата txt, содержащий разметку МЛ на языке IMLML.


Интерфейс программы состоит из следующих основных элементов:

- окно контроля видеозаписи;

- окно демонстрации слайдов;

- окно сценария лекции с последовательностью слайдов. 


Программа Сборки МЛ предназначена для записи мультимедиа лекции синхронно с процессом реального чтения лекции и демонстрации слайдов. Программа реализует следующие функции:

- позволяет лектору в ходе чтения лекции выбирать из сценария последовательно или в произвольном порядке (по номеру, названию) изображения и отображать их для демонстрации;

- записывает видео лектора с разбиением на видеофрагменты, соответствующие периодам демонстрации слайдов;

- записывает протокол ведения лекции: времена переключения слайдов (изображений), порядок их демонстрации, сведения (название), и сохраняет его в специальном формате IMLML.


**А.2. Программа презентации и работы с МЛ**

Программа презентации мультимедиа лекций реализуется как одностраничное веб приложение и работает с данными, лежащими в каталоге запуска с локальной адресацией всех ссылок.

Входными данными программы являются: 

- набор видеофайлов формата (?); 

- набор файлов изображений, использованных для демонстрации лекции формата / форматов (?);

- текстовый файл формата IMLML, с названием lecture.lml, содержащий протокол проведения МЛ с фиксацией всех действий лектора с указанием времени и ссылок указанием порядкового номера слайда, названия слайда, имени файла рисунка слайда.


Выходные данные программы отсутствуют.

Интерфейс программы состоит из  следующих основных элементов:

- окно воспроизведения видеозаписи;

- окно демонстрации слайдов;

- окно содержания лекции с последовательностью слайдов. 


Программа представления мультимедиа лекции предназначена для воспроизведения лекции в соответствии с записи мультимедиа лекции синхронно с процессом реального чтения лекции и демонстрации слайдов. Программа реализует следующие функции:

- размещает на экране окно для представления видео лектора и окно для демонстрации сопутствующих слайдов;

- формирует оглавление лекции как последовательный список названий демонстрационных слайдов и представляет его на экране; 

- позволяет пользователю просматривать МЛ как непрерывную демонстрацию с синхронным последовательным переключением видеофрагментов и демонстрационных слайдов;

- обеспечивает возможность в любой момент времени выбрать пункт оглавления и начать демонстрацию лекции с соответствующему началу пункта моменту, включая начало проигрывания соответствующего видео и отображение требуемого слайда.


**А.3. Язык разметки**

Язык разметки интерактивных мультимедиа лекций (IMLML - Interactive Multimedia Lectures Markup Language) предназначен для записи протокола мультимедиа лекции. Язык позволяет фиксировать времена включения видеофрагментов и времена подгрузки новых слайдов в виде последовательности команд с фиксированным временем относительно времени начала лекции.

Библиотека работы с форматом обеспечивает следующие функции:

- запись очередной команды в массив команд протокола;

- выгрузку записанной последовательности команд протокола в локальный файл;

- загрузку протокола МЛ из локального файла; 

- создание указателя на массив команд протокола; 

- выборку очередной команды (нескольких команд) со смещением указателя.


Реализовать:
Запись видео
Запись действий (модуль интерпретатора сценария)
Воспроизведение видео
Воспроизведение действий (интерпретатор)
Централизованное управление воспроизведением (внешнее управление воспроизведением видео)
Режим записи, режим воспроизведения и режим просмотра
Автоматическая поддержка альбомного и портретного режимов просмотра
Возможность редактировать запись
Возможность отмечать необходимые места... (закладки и прочее)
Система оценки усвоения лекции
Система авторизации
Формирование ссылок на лекции
Опция закрытого аккаунта
Поддержка кантента: текст, форматированный текст, фото, видео, 3д-модели, аудиодорожки, видео
Инструменты: перо, ластик (+их настройки)

Интерфейс:
Управление текущим фрагментом(тема)
Переключение фрагментов лекции(также происходит автоматически)
Менеджер мультимедиа(панель слева)
Окно воспроизведения видео
Интерактивное окно презентации
Управляющие кнопки (+полноэкранный режим с наложением кнопок)
Поддержка управления с клавиатуры(желательно всех функций)

Второстепенные функции+дальнейшее развитие:
Облачное хранение лекций
Несколько языков
Режимы для инвалидов
Шифрование
Онлайн сэссии
Потоковое видео
Ограничения на объём файлов
Подключение платежных систем
Анимация загрузки файлов
Возможность старта воспроизведения без полной загрузки файлов
Средства уменьшения нагрузки на сеть/требований к клиенту
Автоматические субтитры
Опция отключения видео
Опция отключения звука
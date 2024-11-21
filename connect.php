<?php
$db_host='localhost'; // ваш хост
$db_name='database'; // ваша бд
$db_user='root'; // пользователь бд
$db_pass=''; // пароль к бд
// включаем сообщения об ошибках
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// коннект с сервером бд
$link = new mysqli($db_host, $db_user, $db_pass, $db_name); 
// задаем кодировку
$link->set_charset("utf8mb4"); 
?>
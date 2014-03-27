<?php
//соединеняемся с сервером MySQL
$conn=mysql_connect("localhost","root","root") or die("Невозможно установить соединение");
mysql_select_db("testdb") or die("Невозможно открыть базу данных"); //открываем базу данных
mysql_query("SET NAMES utf8"); //настройка кодировки MySQL
?>


<?php
// показывать сообщения об ошибках 
ini_set('display_errors', 1);
error_reporting(E_ALL);

// URL домашней страницы 
$home_url="http://localhost/php_test/api/";

// страница указана в параметре URL, страница по умолчанию одна 
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// установка количества записей на странице 
$items_per_page = 5;

// расчёт для запроса предела записей 
$from_record_num = ($items_per_page * $page) - $items_per_page;
?>
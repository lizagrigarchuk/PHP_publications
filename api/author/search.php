<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение необходимых файлов 
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/author.php';

// создание подключения к БД 
$database = new Database();
$db = $database->getConnection();

// инициализируем объект 
$author = new Author($db);

// получаем ключевые слова 
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

// запрос товаров 
$stmt = $author->search($keywords);
$num = $stmt->rowCount();

// проверяем, найдено ли больше 0 записей 
if ($num>0) {

    // массив товаров 
    $authors_arr=array();
    $authors_arr["items"]=array();

    // получаем содержимое нашей таблицы 
    // fetch() быстрее чем fetchAll() 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // извлечём строку 
        extract($row);

        $author_item=array(
            "id" => $id,
            "fullname" => $fullname,
            "avatar" => $avatar
        );

        array_push($authors_arr["items"], $author_item);
    }

    // код ответа - 200 OK 
    http_response_code(200);

    // покажем товары 
    echo json_encode($authors_arr);
}

else {
    // код ответа - 404 Ничего не найдено 
    http_response_code(404);

    // скажем пользователю, что товары не найдены 
    echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}
?>
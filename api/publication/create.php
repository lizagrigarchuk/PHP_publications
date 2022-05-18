<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 
include_once '../config/database.php';
include_once '../objects/publication.php';

$database = new Database();
$db = $database->getConnection();

$publication = new Publication($db);

if (!empty($_GET['title'])) {

    $title = $_GET['title'];
    $text = $_GET['text'];
    $categories = $_GET['categories'];
    $author = $_GET['photo'];

    if($publication->create($title, $text, $categories, $author)){
        http_response_code(201);
        echo json_encode(array("message" => "Публикация добавлен."), JSON_UNESCAPED_UNICODE);
    }

    else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно добавить публикацию."), JSON_UNESCAPED_UNICODE);
    }
}

else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно добавить публикацию. Данные неполные."), JSON_UNESCAPED_UNICODE);
}
?>
<?php
// необходимые HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

 
include_once '../config/database.php';
include_once '../objects/author.php';

$database = new Database();
$db = $database->getConnection();

$author = new Author($db);

if (!empty($_GET['fullname'])) {

    $author->fullname = $_GET['fullname'];

    if (!empty($_GET['avatar'])) { 
        $author->avatar = $_GET['avatar'];
    }

    if($author->create($_GET['fullname'], $_GET['avatar'])){
        http_response_code(201);
        echo json_encode(array("message" => "Автор добавлен."), JSON_UNESCAPED_UNICODE);
    }

    else {
        http_response_code(503);
        echo json_encode(array("message" => "Невозможно добавить автора."), JSON_UNESCAPED_UNICODE);
    }
}

else {
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно добавить автора. Данные неполные."), JSON_UNESCAPED_UNICODE);
}
?>
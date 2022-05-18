<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/author.php';

$database = new Database();
$db = $database->getConnection();

$author = new Author($db);


$stmt = $author->read();
$num = $stmt->rowCount(); //количество строк

if ($num>0) {
    $authors_arr=array();
    $authors_arr["items"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // извлекаем строку 
        extract($row);

        $author_item=array(
            "id" => $id,
            "fullname" => $fullname,
            "avatar" => $avatar
        );
        array_push($authors_arr["items"], $author_item);
    }
    http_response_code(200);
    echo json_encode($authors_arr);
}
else {
    http_response_code(404);
    echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}
?>
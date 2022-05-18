<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/publication.php';

$database = new Database();
$db = $database->getConnection();

$publication = new Publication($db);


$stmt = $publication->read();
$num = $stmt->rowCount(); //количество строк

if ($num>0) {
    $publications_arr=array();
    $publications_arr["items"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // извлекаем строку 
        extract($row);

        $publication_item=array(
            "id" => $id,
            "title" => $title,
            "text" => $text,
            "create_date" => $create_date,
            "image" => $image,
            "author" => $fullname,
            "category" => $name
        );
        array_push($publications_arr["items"], $publication_item);
    }

    http_response_code(200);
    echo json_encode($publications_arr);
}
else {
    http_response_code(404);
    echo json_encode(array("message" => "Публикации не найдены."), JSON_UNESCAPED_UNICODE);
}
?>
<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../objects/category.php';

$database = new Database();
$db = $database->getConnection();

$category = new Category($db);


$stmt = $category->read();
$num = $stmt->rowCount(); //количество строк

if ($num>0) {
    $categories_arr=array();
    $categories_arr["items"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // извлекаем строку 
        extract($row);

        $category_item=array(
            "id" => $id,
            "nameParentCategory" => $nameParentCategory,
            "nameCategory" => $nameCategory
        );
        array_push($categories_arr["items"], $category_item);
    }

    http_response_code(200);
    echo json_encode($categories_arr);
}
else {
    http_response_code(404);
    echo json_encode(array("message" => "Категории не найдены."), JSON_UNESCAPED_UNICODE);
}
?>
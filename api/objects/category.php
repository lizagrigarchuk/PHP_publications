<?php
class Category {

    private $conn;
    private $table_name = "category";

    // свойства объекта 
    public $id;
    public $name;
    public $parentId;

    // конструктор для соединения с базой данных 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT category.id, catParent.name as nameParentCategory, category.name as nameCategory  FROM " . $this->table_name . " as catParent
        inner join " . $this->table_name . " on catParent.id = category.parentId" ; 
        $stmt = $this->conn->prepare($query);
    
        // выполняем запрос 
        $stmt->execute();
        
        return $stmt;
    }

    function create($name, $parentId){

        $query = "INSERT INTO
                    " . $this->table_name . "
                ( `name`, `parentId`) VALUES ('".$name."', '".$parentId."');";
    
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
}
?>
<?php
class Author {

    // подключение к базе данных и таблице 'products' 
    private $conn;
    private $table_name = "authors";

    // свойства объекта 
    public $id;
    public $fullname;
    public $avatar;

    // конструктор для соединения с базой данных 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * FROM " . $this->table_name;
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    function create($fullname, $avatar){
        
        $query = "INSERT INTO
                    " . $this->table_name . "
                ( `fullname`, `avatar`) VALUES ('".$fullname."', '".$avatar."');";
    
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
}
?>

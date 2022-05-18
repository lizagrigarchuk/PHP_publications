<?php
class Publication {

    private $conn;
    private $table_name = "publication";

    // свойства объекта 
    public $title;
    public $text;
    public $create_date;
    public $image;
    public $author;
    public $category;

    // конструктор для соединения с базой данных 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT publication.id, title, text, create_date, image, authors.fullname, category.name FROM " . $this->table_name. ".publication
        INNER JOIN authors on publication.authorsId = authors.id
        INNER JOIN publication_category on publication.id = publication_category.publicationId
        INNER JOIN category on publication_category.categoryId = category.id
        ORDER BY publication.id;" ;
    
        // подготовка запроса 
        $stmt = $this->conn->prepare($query);
    
        // выполняем запрос 
        $stmt->execute();
        
        return $stmt;
    }

    function read_one($id){

        $query = "SELECT publication.id, title, text, create_date, image, authors.fullname, category.name FROM " . $this->table_name. ".publication
        INNER JOIN authors on publication.authorsId = authors.id
        INNER JOIN publication_category on publication.id = publication_category.publicationId
        INNER JOIN category on publication_category.categoryId = category.id
        WHERE publication.id = ".$id." ORDER BY publication.id;";
    

        // подготовка запроса 
        $stmt = $this->conn->prepare($query);
    
        // выполняем запрос 
        $stmt->execute();
        
        return $stmt;
    }
 
    //поиск публикации по категории
    function read_by_category($id){

        $query = "SELECT publication.id, title, text, create_date, image, authors.fullname, category.name FROM " . $this->table_name. ".publication
        INNER JOIN authors on publication.authorsId = authors.id
        INNER JOIN publication_category on publication.id = publication_category.publicationId
        INNER JOIN category on publication_category.categoryId = category.id
        WHERE category.id = ".$id ." OR category.parentId = ".$id." ORDER BY publication.id";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

//поиск публикации по автору
    function read_by_author($id){

        $query = "SELECT publication.id, title, text, create_date, image, authors.fullname, category.name FROM " . $this->table_name. ".publication
        INNER JOIN authors on publication.authorsId = authors.id
        INNER JOIN publication_category on publication.id = publication_category.publicationId
        INNER JOIN category on publication_category.categoryId = category.id
        WHERE authors.id = ".$id . " ORDER BY publication.id";
  
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    function search($value){
        $query = "SELECT publication.id, title, text, create_date, image, authors.fullname, category.name FROM " . $this->table_name. ".publication
        INNER JOIN authors on publication.authorsId = authors.id
        INNER JOIN publication_category on publication.id = publication_category.publicationId
        INNER JOIN category on publication_category.categoryId = category.id
        WHERE text like '%".$value ."%'OR title like '%".$value ."%' ORDER BY publication.id" ;
  
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }


    function create($title, $text, $categories, $author){
       $query = "INSERT INTO `" . $this->table_name. "`.`publication` (`title`, `text`, `create_date`, `authorsId`) 
                    VALUES ('".$title."', '".$text."', '".date('Y-m-d H:i:s')."', '".$author."');";
        
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            $id=$this->conn->lastInsertId(); //id публикации, для того, чтобы вставить в промежуточную таблицу
        }
    

        $cat = explode(",", $categories);
        $queryCat='';
        for($i=0; $i<count($cat); $i++){
            if($cat[$i]!=''){ //разбираем список кат и записываем в промежут таблицу, id публикации = $id
                $queryCat .= "INSERT INTO `" . $this->table_name. "`.`publication_category` (`publicationId`, `categoryId`) 
                VALUES ('".$id."', '".$cat[$i]."');";
            }
        }

        $stmtC = $this->conn->prepare($queryCat);
        if ($stmtC->execute()) {
            return true;
        }

        return false;
       
        }
}
?>
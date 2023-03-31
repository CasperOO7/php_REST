<?php
class Posts{
    //Database attrbutes
private $con;
private $table='posts';

//posts attrubitues
public $id;
public $category_id;
public $category_name; //we get it from join queries
public $title;
public $body;
public $author;
public $created_at;
//constructor
public function __construct($db)
{
$this->con=$db;
}
public function read(){
$sql='
SELECT 
c.name as category_name,
p.id,
p.category_id,
p.title,
p.body,
p.author,
p.created_at 
FROM '.$this->table.' p
LEFT JOIN 
   categories c ON p.category_id = c.id
   ORDER BY 
   p.created_at DESC';
$stmt=$this->con->prepare($sql);
$stmt->execute();
return $stmt;
}
}
?>
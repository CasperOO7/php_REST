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

public function read_single(){
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
       WHERE p.id = ? ';
    $stmt=$this->con->prepare($sql);
    $stmt->bindParam(1,$this->id);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    $this->title=$row['title'];
    $this->body=$row['body'];
    $this->author=$row['author'];
    $this->category_id=$row['category_id'];
    $this->category_name=$row['category_name'];
}

public function create(){
    $sql='INSERT INTO '.
    $this->table.'
    SET 
    title= :title,
    body= :body,
    author= :author,
    category_id= :category_id';

    //clean data
    $stmt=$this->con->prepare($sql);
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->body=htmlspecialchars(strip_tags($this->body));
    $this->author=htmlspecialchars(strip_tags($this->author));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));

    //bind the place holder
    $stmt->bindParam(':title',$this->title);
    $stmt->bindParam(':body',$this->body);
    $stmt->bindParam(':author',$this->author);
    $stmt->bindParam(':category_id',$this->category_id);

    if($stmt->execute()){
        return true;
    }
    printf("Error: s%.\n",$stmt->e);
    return false;
}


public function update(){
    $sql='UPDATE '.
    $this->table.'
    SET 
    title= :title,
    body= :body,
    author= :author,
    category_id= :category_id
    WHERE
    id= :id';

    //clean data
    $stmt=$this->con->prepare($sql);
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->body=htmlspecialchars(strip_tags($this->body));
    $this->author=htmlspecialchars(strip_tags($this->author));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    $this->id=htmlspecialchars(strip_tags($this->id));

    //bind the place holder
    $stmt->bindParam(':title',$this->title);
    $stmt->bindParam(':body',$this->body);
    $stmt->bindParam(':author',$this->author);
    $stmt->bindParam(':category_id',$this->category_id);
    $stmt->bindParam(':id',$this->id);

    if($stmt->execute()){
        return true;
    }
    printf("Error: s%.\n",$stmt->e);
    return false;
}

public function delete(){
    $sql='DELETE FROM '.
    $this->table.'
    WHERE
    id= :id';

    //clean data
    $stmt=$this->con->prepare($sql);
    $this->id=htmlspecialchars(strip_tags($this->id));

    //bind the place holder
    $stmt->bindParam(':id',$this->id);
    
    if($stmt->execute()){
        return true;
    }
    printf("Error: s%.\n",$stmt->e);
    return false;
}

}
?>
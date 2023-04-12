<?php
class Category{

    //DB attributes

    private $DB_connection;
    private $table='categories';

    //category attributes

    public $id;
    public $name;
    public $created_at;

    public function __construct($DB_Object){
        $this->DB_connection=$DB_Object;
    }

    public function read(){
    $query='SELECT 
    id,
    name,
    created_at
    FROM '.$this->table.' ORDER BY created_at DESC';
    $stmt=$this->DB_connection->prepare($query);
    $stmt->execute();
    return $stmt;
}

public function read_single(){
    $query=' SELECT 
        id,
        name,
        created_at
        FROM '.$this->table.' WHERE id =:id';
    $stmt=$this->DB_connection->prepare($query);
    $stmt->bindParam(':id',$this->id);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    $this->id=$row['id'];
    $this->name=$row['name'];
    $this->created_at=$row['created_at'];
}

public function create(){

$query='INSERT INTO '.$this->table.'
SET
name=:name';
$stmt=$this->DB_connection->prepare($query);
$this->name=htmlspecialchars(strip_tags($this->name));
$stmt->bindParam(':name',$this->name);
 if($stmt->execute()){
    return true;
}
printf("Error: s%.\n",$stmt->e);
return false;

}

public function delete(){
    $query='DELETE FROM '.$this->table.'
    WHERE id=:id';
    $stmt=$this->DB_connection->prepare($query);
    $this->id=htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(':id',$this->id);
     $stmt->execute();
     if($stmt->execute()){
        return true;
    }
    printf("Error: s%.\n",$stmt->e);
    return false;
}

public function update(){
    $query='UPDATE '.$this->table.'
    SET
    name=:name
    WHERE id=:id';
    $stmt=$this->DB_connection->prepare($query);
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->name=htmlspecialchars(strip_tags($this->name));
    $stmt->bindParam(':id',$this->id);
    $stmt->bindParam(':name',$this->name);
     $stmt->execute();
     if($stmt->execute()){
        return true;
    }
    printf("Error: s%.\n",$stmt->e);
    return false;
    


}

}
?>
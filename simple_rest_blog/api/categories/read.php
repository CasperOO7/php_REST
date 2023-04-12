<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../../conf/Database.php';
include_once '../../models/category.php';

    //DB con
$DB=new Database();
$db_obj=$DB->connect();

$category=new Category($db_obj);

$query_result=$category->read();

$row_count=$query_result->rowCount();

if($row_count > 1){
$categories=array();
$categories['data']=array();
while($row=$query_result->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $returned_category_item=array(
        'id'=>$id,
        'name'=>$name,
        'created_at'=>$created_at
    );
    array_push($categories['data'],$returned_category_item);
}
echo json_encode($categories);
}else{
    echo json_decode(
array('message'=>'No Posts Found'));

}
?>
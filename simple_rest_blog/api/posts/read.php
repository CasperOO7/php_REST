<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../../conf/Database.php';
include_once '../../models/posts.php';
//db stuff
$database=new Database();
$db=$database->connect();
//posts stuff
$post=new Posts($db);

$query=$post->read();

$rc=$query->rowCount();

if($rc > 0){
$posts=array();
$posts['data']=array();
while($row=$query->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $returned_post_item=array(
        'id'=>$id,
        'title'=>$title,
        'body'=>html_entity_decode($body),
        'author'=>$author,
        'category_id'=>$category_id,
        'category_name'=>$category_name
    );
    array_push($posts['data'],$returned_post_item);
}
echo json_encode($posts);
}else{
    echo json_decode(
array('message'=>'No Posts Found'));
}

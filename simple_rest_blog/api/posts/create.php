<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, 
Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
include_once '../../conf/Database.php';
include_once '../../models/posts.php';
//db stuff
$database=new Database();
$db=$database->connect();
//posts stuff
$post=new Posts($db);

$data=json_decode(file_get_contents("php://input"));

$post->title=$data->title;
$post->body=$data->body;
$post->author=$data->author;
$post->category_id=$data->category_id;

if($post->create()){
    echo json_encode(
        array(
            'message'=>'post created'
        )

        );
    }
        else{
            echo json_encode(
                array(
                    'message'=>'post not created'
                )
        
                );
        }

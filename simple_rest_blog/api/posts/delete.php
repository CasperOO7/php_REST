<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once '../../conf/Database.php';
include_once '../../models/posts.php';
//db stuff
$database=new Database();
$db=$database->connect();
//posts stuff
$post=new Posts($db);

$data=json_decode(file_get_contents("php://input"));

$post->id=$data->id;



if($post->delete()){
    echo json_encode(
        array(
            'message'=>'post deleted'
        )

        );
    }
        else{
            echo json_encode(
                array(
                    'message'=>'post not deleted'
                )
        
                );
        }

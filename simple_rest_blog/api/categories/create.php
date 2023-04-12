<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type, Authorization, X-Requested-With');
include_once '../../conf/Database.php';
include_once '../../models/category.php';
//db stuff
$database=new Database();
$db=$database->connect();
//categorys stuff
$category=new Category($db);

$data=json_decode(file_get_contents("php://input"));

$category->name=$data->name;

if($category->create()){
    echo json_encode(
        array(
            'message'=>'category created'
        )

        );
    }
        else{
            echo json_encode(
                array(
                    'message'=>'category not created'
                )
        
                );
        }

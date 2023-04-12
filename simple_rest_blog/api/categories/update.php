<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
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

$category->id=$data->id;
$category->name=$data->name;

if($category->update()){
    echo json_encode(
        array(
            'message'=>'category updated'
        )

        );
    }
        else{
            echo json_encode(
                array(
                    'message'=>'category not updated'
                )
        
                );
        }

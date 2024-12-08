<?php
include "function.php";
include "connect.php";

if(requestMethod()=="POST"){
    $id=intval($_POST['id']);

    global $connection;

    $query="UPDATE `user` SET is_active=1 WHERE user_id=:id";
    $update=$connection->prepare($query);
    $update->bindParam(":id",$id);
    $result=$update->execute();

    if($result){
        echo json_encode("Account has been activated");
    }else{
        echo json_encode("Something went wrong. Please try again.");
        http_response_code(500);
    }
}else{
    header("Location: ../404.php");
}
<?php
include "function.php";
include "connect.php";
if(requestMethod()=="POST"){


    global $connection;

    $table=$_POST['table'];
    $id=$_POST['id'];
    $column="";
    switch ($table) {
        case "products":
            $column = "product_id";
            break;
        case "brands":
            $column = "brand_id";
            break;
        case "users":
            $column = "user_id";
            break;
        case "categories":
            $column = "category_id";
            break;

    }

    $query="UPDATE `".$table."` SET `is_deleted`=1 WHERE ".$column."=:id";

    try{
        $delete=$connection->prepare($query);
        $delete->bindParam(":id",$id);
        $result=$delete->execute();
        if($result){
            echo json_encode("Your deletion was successfull");
        }else{
            echo json_encode("Your deletion failed.");
        }
    }catch (PDOException $e){

        echo json_encode("Something went wrong. Please try again");
        http_response_code(500);
    }




}else{
    header("Location: ../404.php");
}
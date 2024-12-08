<?php
include "function.php";
include "connect.php";
include "config.php";
if(requestMethod()=="POST"){

    $regExNameProduct="/^[A-Z\s]+$/u";
    $regExPrice="/^\d{1,}\.\d{2}$/u";



    global $connection;
    $productName=$_POST['prodName'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $brand=$_POST['brand'];
    $id=$_POST['id'];

    $errors= array();

    if(!preg_match($regExNameProduct, $productName)){
        $errors['name']="Name must contain minimum 2 words written in uppercase";
    }
    if(!preg_match($regExPrice, $price)){
        $errors['price']="Price must contain decimals";
    }


    if(empty($errors)){
        $price=floatval($price);
        $query="UPDATE `products` SET `product_name`=:name,`description`=:desc,`price`=:price,`category_id`=:cat,`brand_id`=:brand WHERE product_id=:id";

        $update=$connection->prepare($query);
        $update->bindParam(":name", $productName);
        $update->bindParam(":desc", $description);
        $update->bindParam(":price", $price);
        $update->bindParam(":cat", $category);
        $update->bindParam(":brand", $brand);
        $update->bindParam(":id", $id);
        $result=$update->execute();

        if($result){
            echo json_encode("Your update was successfull.");
        } else {
            http_response_code(500);
        }
    } else {
        $errors=implode("<br>",$errors);
        header("Location: editProducts.php?errors=".$errors);
    }
}else{
    header("Location: ../404.php");
}

?>

<?php
header("Content-type: application/json");
include "function.php";
include "connect.php";

if(requestMethod()=="POST"){

    try{
        $product=$_POST['product'];
        $user=$_POST['user'];
        $products=getAll("products");
        global $connection;

        $cart=userCart($user);
        $inCart=0;

        foreach ($cart as $c){
            if($c->product_id==$product){
                $inCart=1;
                break;
            }
        }

        if($inCart==1){
            $query="DELETE FROM cart_item WHERE product_id=:product AND user_id=:user";

            $delete=$connection->prepare($query);
            $delete->bindParam(":product",$product);
            $delete->bindParam(":user", $user);
            $delete->execute();

            if($delete){
                $restProducts=userCart($user);
                echo json_encode($restProducts);
                http_response_code(200);
            }else{
                http_response_code(500);
            }
        }






    }catch (PDOException $e){
        http_response_code(500);
    }












}else{header("Location: ../404.php");}


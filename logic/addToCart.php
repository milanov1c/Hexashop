<?php
header("Content-type: application/json");
include "function.php";
include "connect.php";

if(requestMethod()=="POST"){

    try{
        global $connection;
        $product=$_POST['product'];
        $user=$_POST['user'];
        $products=getAll("products");
        $quantity=$_POST['quantity'];
        $cart=userCart($user);
        $inCart=false;

        foreach ($cart as $c){
            if($c->product_id==$product){
                $inCart=true;
                break;
            }
        }

        if($inCart){
            echo json_encode("The product is already in the cart.");
            http_response_code(200);
        }else{
            $query="INSERT INTO `cart_item`(`user_id`, `product_id`, `quantity`) ";
            $query.="VALUES (:user,:product,:quantity)";

            $insert=$connection->prepare($query);
            $insert->bindParam(":user",$user);
            $insert->bindParam("product",$product);
            $insert->bindParam("quantity",$quantity);

            $result=$insert->execute();


            echo json_encode("Product has been added to your cart.");
        }



    }catch (PDOException $e){
        http_response_code(500);
    }












}else{
    header("Location: ../404.php");
}
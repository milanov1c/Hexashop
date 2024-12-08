<?php

function registerUser($name, $lName, $user, $email, $pass){
    global $connection;

    $query="INSERT INTO `user`(`username`,`password`,`first_name`,`last_name`,`email`)";
    $query.="VALUES (:username,:password,:fName,:lName,:email)";

    $insert=$connection->prepare($query);
    $insert->bindParam(":username",$user);
    $insert->bindParam(":password",$pass);
    $insert->bindParam(":fName",$name);
    $insert->bindParam(":lName",$lName);
    $insert->bindParam(":email",$email);

    $result=$insert->execute();
    return $result;
}

function getUserBy($param, $value){
    global $connection;

    if($param=="username"){
        $query="SELECT COUNT(*) AS n FROM user WHERE username=:value";
    }
    if($param=="email"){
        $query="SELECT COUNT(*) AS n FROM user WHERE email=:value";
    }

    $select=$connection->prepare($query);
    $select->bindParam(":value",$value);

    $select->execute();

    $result=$select->fetch();
    return $result;

}

function logIn($username, $password){
    global $connection;

    $errors=null;

    $query="SELECT * FROM user u JOIN role r ON u.role_id=r.role_id WHERE u.username=:username AND is_active=1";
    $select=$connection->prepare($query);
    $select->bindParam(":username", $username);

    $select->execute();
    $user=$select->fetch();

    if(!$user){
        $errors="Your credentials are invalid. Please enter again";
    }else{
        if($user->password!=$password){
            $errors="Your credentials are invalid.";


        }
        if(!$errors){


                $_SESSION['user']=$user;
                if($user->role_id==2){
                    header("Location: shop.php");
                }elseif($user->role_id==1){
                    header("Location: admin/admin-panel.php");
                }
            }

    }

}

function isLogged(){
    return isset($_SESSION["user"]);
}

function requestMethod(){
    return $_SERVER['REQUEST_METHOD'];
}

function getAll($table){
    global $connection;

    $query="SELECT * FROM $table";

    $result=$connection->query($query)->fetchAll();

    return $result;
}

function displayMenu($links){
    $display="";

    foreach ($links as $link){
        $display.="<li><a href=".$link->path." >$link->name</a></li>";
    }

    return $display;
}

function getProducts($limit){
    global $connection;

    $query="SELECT * FROM products WHERE is_deleted=0 LIMIT ".$limit;
    $result=$connection->query($query)->fetchAll();
    return $result;
}

function getProductWhereID($id){
    global $connection;

    $query="SELECT * FROM products p JOIN brands b ON p.brand_id=b.brand_id JOIN categories c ON p.category_id=c.category_id WHERE p.product_id=:id";

    $select=$connection->prepare($query);
    $select->bindParam(":id", $id);

    $select->execute();

    $result=$select->fetch();
    return $result;
}

function get($key){
    if(!isset($_GET[$key])){
        return null;
    }
    return $_GET[$key];
}

function userCart($user){
    global $connection;

    $query="SELECT * FROM cart_item c JOIN products p ON c.product_id=p.product_id JOIN categories ct ON p.category_id=ct.category_id WHERE c.user_id=:user";

    $select=$connection->prepare($query);
    $select->bindParam(":user", $user);
    $select->execute();

    $result=$select->fetchAll();
    return $result;

}

function updateSession($fname, $lname, $username, $email){
    $_SESSION['user']['first_name']=$fname;
    $_SESSION['user']['last_name']=$lname;
    $_SESSION['user']['username']=$username;
    $_SESSION['user']['email']=$email;
}

function updateSessionAddress($street, $city, $state, $zip){
    $_SESSION['user']['street']=$street;
    $_SESSION['user']['city']=$city;
    $_SESSION['user']['state']=$state;
    $_SESSION['user']['zip']=$zip;
}

function isAdmin(){
    return isLogged() && $_SESSION['user']->role_id==1;

}

function productsBrandCategory(){
    global $connection;

    $query="SELECT product_id,product_name,product_img,description,price,category_name,brand_name,p.is_deleted FROM products p JOIN categories c ON p.category_id=c.category_id JOIN brands b ON p.brand_id=b.brand_id";

    $select=$connection->query($query);

    $result=$select->fetchAll();

    return $result;
}

function getUsersRoles(){
    global $connection;

    $query="SELECT * FROM user u JOIN role r ON u.role_id=r.role_id";

    $result=$connection->query($query)->fetchAll();

    return $result;
}

function getUserForId($id){
    global $connection;

    $query="SELECT * FROM user u JOIN role r ON u.role_id=r.role_id WHERE u.user_id=:id";
    $select=$connection->prepare($query);
    $select->bindParam(":id",$id);
    $select->execute();
    $result=$select->fetch();
    return $result;
}

function getProductsForCategory($cat){
    global $connection;

    $query="SELECT * FROM products WHERE category_id=:id";

    $select=$connection->prepare($query);

    $select->bindParam(":id",$cat);

    $select->execute();

    $result=$select->fetchAll();

    return $result;

}

function addOrder($user, $total){
    global $connection;

    $query="INSERT INTO `orders`(`user_id`, `total`) VALUES (:user,:total)";

    $insert=$connection->prepare($query);
    $insert->bindParam(":user",$user);
    $insert->bindParam(":total",$total);
    $insert->execute();

    return $connection->lastInsertId();
}

function addOrderProduct($product, $order, $quantity, $price){
    global $connection;

    $query="INSERT INTO `order_product`(`product_id`, `order_id`, `quantity`, `price`) VALUES (:product,:order,:quantity,:price)";

    $insert=$connection->prepare($query);
    $insert->bindParam(":product",$product);
    $insert->bindParam(":order",$order);
    $insert->bindParam(":quantity",$quantity);
    $insert->bindParam(":price",$price);
    $insert->execute();

    return $insert;
}

function deleteCartOrder($cart, $user){
    global $connection;

    $query="DELETE FROM `cart_item` WHERE product_id=:cart AND user_id=:user";

    $delete=$connection->prepare($query);
    $delete->bindParam(":cart",$cart);
    $delete->bindParam(":user",$user);
    $result=$delete->execute();

    return $result;

}



<?php
include "function.php";
include "connect.php";
include "config.php";
if(requestMethod()=="POST"){

    $regExName="/^[A-ZŠĐŽČĆ][a-zšđčćž]{2,14}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{2,14})?$/";
    $regExLastName="/^[A-ZŠĐŽČĆ][a-zšđčćž]{3,14}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{3,14})?$/";
    $regExUsername="/^[a-zA-Z0-9]{3,20}$/";


    global $connection;
    $fName=$_POST['fName'];
    $lName=$_POST['lName'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $role=$_POST['role'];
    $street=$_POST['street'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $zip=$_POST['zip'];
    $id=$_POST['id'];

    $errors= array();

    if(!preg_match($regExName, $fName)){
        $errors['fName']="Name must contain only letters, starting with uppercase";
    }
    if(!preg_match($regExLastName, $lName)){
        $errors['lName']="Last name must contain only letters, starting with uppercase";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email']="Email must contain @.";
    }
    if(!preg_match($regExUsername, $username)){
        $errors['username']="Username must contain only letters and numbers";
    }

    if(empty($errors)){
        $query="UPDATE `user` SET `username`=:username, `first_name`=:fname, `last_name`=:lname, `email`=:email, `role_id`=:role, `street`=:street, `city`=:city, `state`=:state, `zip`=:zip WHERE user_id=:id";

        $update=$connection->prepare($query);
        $update->bindParam(":username", $username);
        $update->bindParam(":fname",$fName);
        $update->bindParam(":lname",$lName);
        $update->bindParam(":email",$email);
        $update->bindParam(":role",$role);
        $update->bindParam(":street", $street);
        $update->bindParam(":city",$city);
        $update->bindParam(":state",$state);
        $update->bindParam(":zip",$zip);
        $update->bindParam(":id",$id);
        $result=$update->execute();

        if($result){
            echo json_encode("Your update was successfull.");
        } else {
            http_response_code(500);
        }
    } else {
        $errors=implode("<br>",$errors);
        header("Location: editUsers.php?errors=".$errors);
    }
}else{
    header("Location: ../404.php");
}

?>

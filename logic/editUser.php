<?php
include "function.php";
include "connect.php";
include "config.php";
if(requestMethod()=="POST"){

$regExName="/^[A-ZŠĐŽČĆ][a-zšđčćž]{2,14}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{2,14})?$/";
$regExLastName="/^[A-ZŠĐŽČĆ][a-zšđčćž]{3,14}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{3,14})?$/";
$regExUsername="/^[a-zA-Z0-9]{3,20}$/";
$regExPassword="/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/";

    if(isset($_POST['updateInfo'])){
        $fName=$_POST['fName'];
        $lName=$_POST['lName'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $id=$_SESSION['user']->user_id;
        $errors= array();

        if($id==null){
            $errors['id']="id";
        }

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
            global $connection;

            $query="UPDATE `user` SET `username`=:username,`first_name`=:fname,`last_name`=:lname,`email`=:email WHERE user_id=:id";

            $update=$connection->prepare($query);
            $update->bindParam(":username", $username);
            $update->bindParam("fname",$fName);
            $update->bindParam("lname",$lName);
            $update->bindParam("email",$email);
            $update->bindParam("id",$id);
            $result=$update->execute();

            if($result){
                header("Location: ../edit-account.php?success=success");
                updateSession($fName, $lName, $username, $email);

            }else{
                http_response_code(500);
            }
        }else{
            $errors=implode("<br>",$errors);
            header("Location: ../edit-account.php?errors=".$errors);
        }


    }else{
        http_response_code(404);
        header("Location: ../shop.php");
    }

}else{
    header("Location: ../404.php");
}
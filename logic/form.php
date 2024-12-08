<?php
include "connect.php";
include "function.php";

if (isset($_POST["form-submit"])) {
    // Validacija i obrada podataka
    $fName = $_POST["fNameRegister"];
    $lName = $_POST["lNameRegister"];
    $username = $_POST["usernameRegister"];
    $email = $_POST["emailRegister"];
    $password =$_POST["passwordRegister"];
    $rePassword=$_POST["passwordReRegister"];

    $regExName="/^[A-ZŠĐŽČĆ][a-zšđčćž]{2,14}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{2,14})?$/";
    $regExLastName="/^[A-ZŠĐŽČĆ][a-zšđčćž]{3,14}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{3,14})?$/";
    $regExUsername="/^[a-zA-Z0-9]{3,20}$/";
    $regExPassword="/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/";

    $errors= array();

    if(!preg_match($regExName, $fName)){
        $errors['fName']="Name must contain only letters, starting with uppercase";
    }
    if(!preg_match($regExLastName, $lName)){
        $errors['lName']="Last name must contain only letters, starting with uppercase";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email']="Email must contain @.";


    }else{
        $emails = getUserBy("email", $email);
        var_dump($emails->n);
        if($emails->n!=0){
            $errors['email']="Email is already taken";
        }

    }
    if(!preg_match($regExUsername, $username)){
        $errors['username']="Username must contain only letters and numbers";
    }
    else{
        $usernames=getUserBy("username", $username);

        if($usernames->n!=0){
            $errors['username']="Username is already taken";
        }
    }
    if(!preg_match($regExPassword,$password)){
        $errors['password']="Password must contain letters, both uppercase and lowercase, at least one number and special character.";
    }else{
        if($rePassword!=$password){
            $errors['rePassword']="Passwords must match";
        }else{
            $password=md5($password);
        }
    }
    if(empty($errors)){
        registerUser($fName, $lName, $username, $email, $password );
        header("Location: login.php");

    }else{
//        var_dump($errors);
//        exit("Your data is invalid. Please enter it again.");
        header("Location:../contact.php?errors=1");
    }
}else{
    header("Location: ../404.php");
}

?>


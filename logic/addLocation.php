<?php
include "function.php";
include "connect.php";
include "config.php";
if(requestMethod()=="POST"){

$reZip="/^10000|[1-9]\d{4}$/";

    if(isset($_POST['addAddress'])){
        $street=$_POST['street'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        $zip=$_POST['zip'];
        $id=$_SESSION['user']->user_id;
        $errorsLoc= array();

        if($id==null){
            $errorsLoc['id']="id";
        }

        if($street==null || $street==""){
            $errorsLoc['street']="You must enter your street.";
        }
        if($city==null || $city==""){
            $errorsLoc['city']="You must enter your city.";
        }
        if($state==null || $state==""){
            $errorsLoc['state']="You must enter your state.";
        }
        if(!preg_match($reZip, $zip)){
            $errorsLoc['zip']="You must enter your zip code.";
        }

        if(empty($errorsLoc)){
            global $connection;

            $query="UPDATE `user` SET `street`=:street, `city`=:city, `state`=:state, `zip`=:zip WHERE `user_id`=:id";

            $insert=$connection->prepare($query);

            $insert->bindParam(":street", $street);
            $insert->bindParam(":city",$city);
            $insert->bindParam(":state",$state);
            $insert->bindParam(":zip",$zip);
            $insert->bindParam(":id",$id);


                $result=$insert->execute();



            if($result){
                header("Location: ../edit-account.php?successLoc=successLoc");
                updateSessionAddress($street, $city, $state, $zip);

            }else{
                http_response_code(500);
            }
        }else{
            $errorsLoc=implode("<br>",$errorsLoc);
            header("Location: ../edit-account.php?errorsLoc=".$errorsLoc);
        }


    }else{

        header("Location: ../404.php");
    }

}else{
    http_response_code(404);
}


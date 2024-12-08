<?php
include "connect.php";
include "function.php";
include "config.php";
if(requestMethod()=="POST"){

    if(isset($_POST['insertProd'])){
        $regExNameProduct="/^[A-Z\s]+$/u";
        $regExPrice="/^\d{1,}\.\d{2}$/u";

        $name=$_POST['prodName'];
        $image=$_FILES['prodImg'];
        $description=$_POST['prodDesc']??null;
        $price=$_POST['prodPrice'];
        $cat=$_POST['prodCat'];
        $brand=$_POST['prodBrand'];

        $errors=array();

        $allowed=['image/png', 'image/jpg', 'image/jpeg'];
        $maxSize=2500000;

        $type=$image['type'];
        $size=$image['size'];

        if(!in_array($type, $allowed)){
            $errors['image']="This file type is not allowed";
        }
        if($size>$maxSize){
            $errors['image']="Your file size exceeded maximum";
        }
        if(!preg_match($regExNameProduct, $name)){
            $errors['name']="Name must contain minimum 2 words written in uppercase";
        }
        if(!preg_match($regExPrice, $price)){
            $errors['price']="Price must contain decimals";
        }

        if(empty($errors)){
            global $connection;
            $imgExtension=pathinfo($image["name"], PATHINFO_EXTENSION);

            $imageSrc=uniqid()."_".$_SESSION['user']->first_name.$imgExtension;

            if(move_uploaded_file($image['tmp_name'],"../assets/images/shop/".$imageSrc)){
                $query="INSERT INTO `products`(`product_name`, `product_img`, `description`, `price`, `category_id`, `brand_id` )";
                $query.="VALUES (:name,:image,:description,:price,:category,:brand)";

                $insert=$connection->prepare($query);
                $insert->bindParam(":name",$name);
                $insert->bindParam(":image",$imageSrc);
                $insert->bindParam(":description",$description);
                $insert->bindParam(":price",$price);
                $insert->bindParam(":category",$cat);
                $insert->bindParam(":brand",$brand);

                $result=$insert->execute();

                if($result){
                    header("Location: ../admin/insertProduct.php");
                }else{
                    unlink("../assets/images/shop/".$imageSrc);
                }
            }


        }else{
            $errors=implode("<br>",$errors);
            header("Location: ../admin/insertProduct.php?error=".$errors);
        }


    }else{
        header("Location: ../404.php");
    }

}else{
    header("Location: ../404.php");
}
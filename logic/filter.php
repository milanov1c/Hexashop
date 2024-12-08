<?php
include "function.php";
header("Content-type: application/json");





if(requestMethod()=='POST'){
    global $connection;
    include "connect.php";



    try{
        $idCategory=isset($_POST["categories"])?$_POST["categories"]:0;
        $sortChosen=isset($_POST["sort"])?$_POST["sort"]:0;
        $brand=isset($_POST["brand"])?$_POST["brand"]:0;
        $search=isset($_POST["search"])?$_POST["search"]:"";
        $page=isset($_POST["page"])?$_POST["page"]:1;

        $perPage=12;
        $offset=($page-1)*$perPage;

        $query="SELECT * FROM products WHERE is_deleted=0";

        //ZA KATEGORIJE
        if($idCategory!=0){
            $query.= " AND category_id IN ('".implode("','",
                    $idCategory)."')";
        }

        //ZA BRENDOVE

        if($brand!=0){
            $query.=" AND brand_id = :brand";

        }
//
//        //ZA SEARCH
//
//
        if($search!=''){
            $query.=" AND product_name LIKE :search";
            $search="%$search%";
        }
//
        if($sortChosen!=0){
            $query.=" ORDER BY ".$sortChosen;
        }

            $query.=" LIMIT ".$perPage;
            $query.=" OFFSET ".$offset;

        $filter=$connection->prepare($query);

//        // Bajndovanje vrednosti za brend
        if ($brand != 0) {
            $filter->bindValue(":brand", $brand);
        }
//
//        // Bajndovanje vrednosti za search
        if ($search != '') {
            $filter->bindValue(":search", $search);
        }
//



//        var_dump($search);
        $filter->execute();
        $result=$filter->fetchAll();


        if(count($result) > 0){

            echo json_encode($result);
            http_response_code(200);
        }
        else{
            echo json_encode(array());
            http_response_code(200);
        }



    }
    catch(PDOException $ex){
        http_response_code(500);
    }
}else{
    header("Location: ../404.php");
}

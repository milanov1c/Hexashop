<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Hexashop</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">

    <link rel="stylesheet" href="assets/css/owl-carousel.css">

    <link rel="stylesheet" href="assets/css/lightbox.css">

    <script src="https://kit.fontawesome.com/ad51d15578.js" crossorigin="anonymous"></script>

    <?php
        if($_SERVER['REQUEST_URI']=="/sajt/cart.php" || $_SERVER['REQUEST_URI']=="/sajt/cart.php?ordered=1" || $_SERVER['REQUEST_URI']=="/sajt/checkout.php"){
            echo "<link rel='stylesheet' href='assets/css/cart.css'>";
        }
    if($_SERVER['REQUEST_URI']=="/sajt/edit-account.php"){
        echo "<link rel='stylesheet' href='assets/css/editacc.css'>";
    }
    ?>
    <!--

    TemplateMo 571 Hexashop

    https://templatemo.com/tm-571-hexashop

    -->
</head>
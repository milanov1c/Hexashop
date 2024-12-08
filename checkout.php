<?php
include "logic/config.php";
include_once "head.php";
?>
<body>
<?php
include_once "header.php";
if(isLogged()){
    $user=$_SESSION['user'];
    $cart=userCart($user->user_id);
    if($cart){
        $countProducts=count($cart);
        $cartTotal=0;
        foreach ($cart as $c){
            $cartTotal+=$c->price*$c->quantity;
        }
    }
    $shipping=5;

    $errors=array();
    if(!$user->street || !$user->city || !$user->state || !$user->zip){
        $errors['address']="You must edit your account and update address in order to checkout.";
    }
    if($cartTotal==0){
        $errors['total']="Your cart is empty";
    }

    try{
        if(empty($errors)){
            $order=addOrder($user->user_id,$cartTotal+$shipping);

            if(!empty($order)){
                foreach ($cart as $c){
                    addOrderProduct($c->product_id,$order,$c->quantity,$c->price);
                }
                foreach ($cart as $c){
                    deleteCartOrder($c->product_id, $user->user_id);
                }
            }
            header("Location: cart.php?ordered=1");
        }else{
            $errors=implode("<br>",$errors);
        }
    }catch (PDOException $e){
        echo $e->getMessage();
    }



}else{
    header("Location: 404.php");
}
?>
<div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col"><h4><b>Checkout</b></h4></div>
                    <?php if(isLogged() && !empty($errors)):?>

                </div>
            </div>
            <?php if($countProducts>0):?>
                <h4 class="text-danger"><?=$errors?></h4>
            <?php else:?>
                <h4>Your cart is empty...</h4>
            <?php endif;?>
            <div class="back-to-shop"><a href="shop.php">&leftarrow; <span class="text-muted">Back to shop</span></a></div>
        </div>
    <?php endif;?>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="assets/js/script.js"></script>
</body>

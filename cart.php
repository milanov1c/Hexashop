<?php
    include "logic/config.php";
    include_once "head.php";
?>
<body>
    <?php
        include_once "header.php";
        if(isLogged()){
            $cart=userCart($_SESSION['user']->user_id);
            $countProducts=count($cart);
            $cartTotal=0;
            foreach ($cart as $c){
                $cartTotal+=$c->price*$c->quantity;
            }
            $shipping=5;

            $isOrdered=get("ordered");
        }
    ?>
    <div class="card">
        <div class="row">

            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col"><h4><b>Shopping Cart</b></h4></div>
                        <?php if(isLogged()):?>
                        <div class="col align-self-center text-right text-muted"><?=$_SESSION['user']->first_name?>'s items</div>
                        <div id="cartItems" class="mt-5">
                            <?php if($countProducts>0 && !$isOrdered):?>
                                <?php
                                foreach ($cart as $product):
                                    ?>
                                    <div class="row border-top border-bottom">
                                        <div class="row main align-items-center">
                                            <div class="col-2"><img class="img-fluid" src="assets/images/shop/<?=$product->product_img?>"></div>
                                            <div class="col">
                                                <div class="row text-muted"><?=$product->category_name?></div>
                                                <div class="row"><?=$product->product_name?></div>
                                            </div>
                                            <div class="col">
                                                <a href="#">-</a><a href="#" class="border"><?=$product->quantity?></a><a href="#">+</a>
                                            </div>
                                            <div class="col">&dollar; <?=$product->price*$product->quantity?>,00 <a class="remove-cart" href="#" data-id="<?=$product->product_id?>" data-user="<?=$product->user_id?>">&#10005;</a></div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            <?php elseif($isOrdered):?>
                                <h4 class="ps-2">Your order was <span class="fw-bold">successfull</span>!</h4>
                            <?php else:?>
                                <h4>Your cart is empty...</h4>
                            <?php endif;?>

                        </div>
                    </div>
                </div>


                <div class="back-to-shop"><a href="shop.php">&leftarrow; <span class="text-muted">Back to shop</span></a></div>
            </div>
            <div class="col-md-4 summary">
                <div><h5><b>Summary</b></h5></div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">ITEMS <?=$countProducts?></div>
                    <div class="col text-right">&euro; <?=$cartTotal?>.00</div>
                </div>
                <form>
                    <p>SHIPPING</p>
                    <select><option class="text-muted">Standard-Delivery- &euro;5.00</option></select>
                    <p>GIVE CODE</p>
                    <input id="code" placeholder="Enter your code">
                </form>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right">&euro; <?=$cartTotal>0?$cartTotal+$shipping:0?>.00</div>
                </div>
                <?php
                    if($cartTotal){
                        echo "<button class='btn'><a href='checkout.php' class='text-white'>CHECKOUT</a></button>";
                    }
                ?>
                <?php else:?>
                    <h4 class="text-start mt-5">In order to see your cart you must log in.</h4>
                <?php endif;?>
            </div>
        </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
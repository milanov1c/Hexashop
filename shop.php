

<?php
ob_start();
include "logic/config.php";
include_once "head.php";


$perPage=12;


?>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <?php
    include_once "header.php";
    ?>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Check Our Products</h2>
                        <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Products Area Starts ***** -->
    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Our Latest Products</h2>
                        <span>Check out all of our products.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" id="categories">
                <h2 class="fs-4 mb-3">
                    CATEGORIES
                </h2>
                <form>

                    <div class="container">
                        <div class="row justify-content-end p-0 m-0 me-4 mb-4">
                            <div class="col-3 px-1 m-0">
                                <?php
                                $brands=getAll("brands");

                                ?>
                                <select id="ddlBrands" class="form-control">
                                    <option value="0">Choose brand...</option>
                                    <?php
                                        foreach ($brands as $brand):
                                    ?>
                                        <option value="<?=$brand->brand_id?>"><?=$brand->brand_name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-3 px-1 m-0">
                                <?php
                                $sorts=[
                                    "Price ASC"=>"price ASC",
                                    "Price DESC"=>"price DESC",
                                    "Name ASC"=>"product_name ASC",
                                    "Name DESC"=>"product_name DESC"
                                ];

                                ?>
                                <select id="ddlSort" class="form-control">
                                    <option value="0">Sort by...</option>
                                    <?php foreach($sorts as $key => $s): ?>
                                        <option value="<?= $s ?>"><?= $key ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-3 row px-1 m-0">
                                <input class="form-control mr-sm-2" type="search" id="search" placeholder="Search" aria-label="Search">

                            </div>
                            <div class="col-auto px-1 m-0">
                                <button class="btn btn-outline-success  my-2 my-sm-0 " type="button" id="searchButton">Search</button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class=" col-2">

                    <?php
                    //include "logic/filter.php";
                    $categories=getAll("categories");
                    foreach ($categories as $category):
                        ?>



                        <input type="checkbox"  value="<?=$category->category_id?>" data-id="<?=$category->category_id?>" class="form-check-input category mb-1"/>
                        <label class="form-check-label mb-1"><?=$category->category_name?></label>
                        <br>



                    <?php
                    endforeach;
                    ?>
                </div>
                <div class="col-10 row" id="productsDisplay">
                    <?php
                        $products=getProducts($perPage);
                        if(isLogged()){
                            $userId=$_SESSION['user']->user_id;
                        }
                        foreach ($products as $product):
                    ?>
                            <div class='col-lg-3'>
                                <div class='item'>
                                    <div class='thumb'>
                                        <div class='hover-content'>
                                            <ul>
                                                <li><a href='single-product.php?id=<?=$product->product_id?>'><i class='fa fa-eye'></i></a></li>


                                            </ul>
                                        </div>
                                        <img src='assets/images/shop/<?=$product->product_img?>' class='img-fluid' alt='<?=$product->product_name?>'>
                                    </div>
                                    <div class='down-content'>
                                        <h4><?=$product->product_name?></h4>
                                        <span>$<?=$product->price?></span>
                                        <ul class='stars'>
                                            <li><i class='fa fa-star'></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach;?>
                </div>
                <div class="col-lg-12">
                    <div class="pagination">
                        <?php
                        $countProducts=getAll("products");
                        $countProducts=count($countProducts);

                        $paginationNum=ceil($countProducts/$perPage);
//                        <li class="active">
//                                <a href="#">2</a>
//                            </li>
                        ?>
                        <ul id="paginationList">
                           <?php
                            for ($num=0; $num<$paginationNum; $num++):
                           ?>
                                <li class="active"><a href="#" data-id="<?=$num+1?>" class="page"><?=$num+1?></a></li>
                            <?php endfor;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- ***** Products Area Ends ***** -->
    
    <!-- ***** Footer Start ***** -->
<?php
include_once "footer.php";
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/isotope.js"></script>
    
    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/script.js"></script>

    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>

  </body>

</html>

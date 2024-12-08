<?php
    include "logic/config.php";
    include_once "head.php";
?>

<body>

<?php
    include_once "header.php";
?>

<div class="contact-us">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 mx-auto mt-5">
                <div class="section-heading mt-3">
                    <h2>Log In!</h2>

                </div>
                <form id="logIn" action="<?=$_SERVER['PHP_SELF']?>" method="post" onSubmit="return checkForm()">
                    <div class="row">

                        <div class="col-lg-12">
                            <fieldset>
                                <input name="usernameLogin" type="text" id="usernameLogin" placeholder="Your username"/>
                                <small class="invisible text-danger">greska</small>
                            </fieldset>
                        </div>

                        <div class="col-lg-12">
                            <input name="passwordLogin" type="password" id="passwordLogin" placeholder="Your password" />
                            <small class="invisible text-danger">greska</small>
                        </div>

                        <div class="col-lg-12 mt-2">
                            <fieldset>
                                <input type="submit" id="login-submit" name="login-submit" class="main-dark-button" value="Log in"/>

                        </div>
                        <?php

                            //include "logic/function.php";
                            include "logic/connect.php";

                            if(isset($_POST['login-submit'])){
                                $username=$_POST['usernameLogin'];
                                $password=$_POST['passwordLogin'];

                                $password=md5($password);

                                logIn($username, $password);


                            }
                        ?>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    include_once "footer.php";
?>

<!-- jQuery -->
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
<script src="assets/js/jquery.counterup.min.js"></script>
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

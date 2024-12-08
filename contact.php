<?php
    include "logic/config.php";
    include_once "head.php";

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
    <div class="page-heading about-page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Contact Us</h2>
                        <span>Awesome, clean &amp; creative HTML5 Template</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Contact Area Starts ***** -->
    <div class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div id="map">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d90186.37207676383!2d-80.13495239500924!3d25.9317678710111!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9ad1877e4a82d%3A0xa891714787d1fb5e!2sPier%20Park!5e1!3m2!1sen!2sth!4v1637512439384!5m2!1sen!2sth" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
                      <!-- You can simply copy and paste "Embed a map" code from Google Maps for any location. -->

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Say Hi. Don't Be Shy!</h2>
                        <span>Details to details is what makes Hexashop different from the other themes.</span>
                    </div>
                    <form id="contact" action="logic/form.php" method="post" onSubmit="return checkForm()">
                        <div class="row">
                          <div class="col-lg-6">
                            <fieldset>
                              <input name="fNameRegister" type="text" id="fNameRegister" placeholder="Your name"/>
                                <small class="invisible text-danger">Your name is invalid format. Example: Nikolina</small>
                            </fieldset>
                          </div>
                          <div class="col-lg-6">
                              <input name="lNameRegister" type="text" id="lNameRegister" placeholder="Your last name"/>
                              <small class="invisible text-danger">Your last name is in invalid format. Example: Milanovic</small>
                          </div>
                          <div class="col-lg-6 my-1">
                              <fieldset>
                                  <input name="usernameRegister" type="text" id="usernameRegister" placeholder="Your username"/>
                                  <small class="invisible text-danger">Your username is invalid format. Example: nikolina123</small>
                              </fieldset>
                          </div>
                            <div class="col-lg-6 my-1">
                                <input name="emailRegister" type="text" id="emailRegister" placeholder="Your email" />
                                <small class="invisible text-danger">Your email is invalid format. Example: nikolina@gmail.com</small>
                            </div>
                            <div class="col-lg-6">
                                <input name="passwordRegister" type="password" id="passwordRegister" placeholder="Your password" />
                                <small class="invisible text-danger">Your password is in invalid format. Example: Nikolina123+</small>
                            </div>
                            <div class="col-lg-6">
                                <input name="passwordReRegister" type="password" id="passwordReRegister" placeholder="Check your password" />
                                <small class="invisible text-danger">Your passwords do not match. Please enter it again.</small>
                            </div>
                          <div class="col-lg-12 mt-2">
                            <fieldset>
                              <input type="submit" id="form-submit" name="form-submit" class="main-dark-button" value="Register"/>
                                    <?php
                                        if(isset($_GET['success'])){
                                            echo "<p class='text-success'>Your data is successfully sent. You are now registered.</p>";
                                        }elseif (isset($_GET['errors'])){
                                            echo "<p class='text-alert'>Your data is invalid. Please enter it again.</p>";
                                        }
                                    ?>
                          </div>
                            <div class="col-lg-12 mt-2">
                                <p class="text-light-emphasis">Already a member? <a href="login.php" class="fw-bold">Log in!</a></p>
                            </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Contact Area Ends ***** -->




    <!-- ***** Footer Start ***** -->
    <?php
    include_once "footer.php";
    ?>


    <!-- jQuery -->
<!--    <script src="assets/js/jquery-2.1.0.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

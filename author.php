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

<main>
    <div class="row p-0 m-0 mt-5 pt-5 mb-5 justify-content-center">
        <small class="text-center mt-5">Something about</small>
        <h2 class="text-center text-uppercase fw-bold">Author of the site</h2>
        <div class="col-md-2 d-flex justify-content-md-end justify-content-center mt-3">
            <img src="assets/images/author.jpg" alt="Author of the page"  class="img-fluid"/>
        </div>
        <div class="col-md-4 text-md-start text-center mt-3">
            <h3 class="fw-bold text-uppercase">Name</h3>
            <p>Nikolina Milanović</p>
            <h3 class="fw-bold text-uppercase">Index Number</h3>
            <p>120/22</p>
            <h3 class="fw-bold text-uppercase">Course</h3>
            <p>Internet Technologies</p>
            <h3 class="fw-bold text-uppercase">About Me</h3>
            <p>As a second-year student at ICT College, specializing in web programming, I have developed a strong foundation in front-end technologies. My coursework has equipped me with hands-on experience in languages such as HTML, CSS, JavaScript. I am passionate about creating responsive and user-friendly web applications, and I am excited to leverage my skills to contribute effectively in the dynamic field of web development. Through my academic journey, I have demonstrated a commitment to staying current with industry trends and continuously enhancing my programming expertise.</p>
        </div>
    </div>
</main>




<!-- ***** Footer Start ***** -->
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
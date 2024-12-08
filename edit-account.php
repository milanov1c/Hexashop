<?php
    include "logic/config.php";
    include_once "head.php";
?>
<body>
<?php
    include_once "header.php";
    $user=$_SESSION['user'];

    $error=get("errors");

    if($error){
        $error=explode("%",$error);

        $error=$error[0];
    }

    $errorLoc=get("errorsLoc");{
        if($errorLoc){
            $errorLoc=explode("%",$errorLoc);

            $errorLoc=$errorLoc[0];
        }
    }

    if(isLogged()):
?>
<div class="pt-5"></div>
<div class="container mt-5 pt-5">
    <div class="row gutters">

        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 mx-auto">
            <div class="card h-100">
                <div class="card-body">
                    <form action="logic/editUser.php" method="POST">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fName">First Name</label>
                                    <input type="text" class="form-control" id="fName" name="fName" value="<?=$user->first_name?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?=$user->username?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                                <div class="form-group">
                                    <label for="lName">Last name</label>
                                    <input type="text" class="form-control" id="lName" name="lName" value="<?=$user->last_name?>">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?=$user->email?>">
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right mt-3">
                                    <button type="submit" id="updateInfo" name="updateInfo" class="btn btn-primary">Update Info</button>
                                    <?php
                                        if($error){
                                            echo "<p class='text-danger'>".$error."</p>";
                                        }elseif (get("success")){
                                            echo "<p class='text-success'>Your update was successfull.</p>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="logic/addLocation.php" method="POST">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Address</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="street">Street</label>
                                    <input type="text" class="form-control" id="street" name="street" placeholder="Enter Street">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="Enter State">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
                                <div class="form-group">
                                    <label for="zip">Zip Code</label>
                                    <input type="text" class="form-control" name="zip" id="zip" placeholder="Zip Code">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right mt-3">
                                    <button type="submit" id="addAddress" name="addAddress" class="btn btn-primary">Add Address</button>
                                    <?php
                                    if($errorLoc){
                                        echo "<p class='text-danger'>".$errorLoc."</p>";
                                    }elseif (get("successLoc")){
                                        echo "<p class='text-success'>Your update was successfull.</p>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php else:?>
    <h4 class="mt-5 pt-5 text-center">You are not logged in. In order to edit your account you must log in.</h4>
<?php
endif;
    include_once "footer.php";
?>
</body>

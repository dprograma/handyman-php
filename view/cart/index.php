<?php

include "../../view/__partials/topmenu.php";
include "../../src/config/db/Connect.php";

$category = $_SESSION['category'];
$request = $_SESSION['request'];
$price = $_SESSION['price'];
$tax = $_SESSION['tax'];
$amount = $_SESSION['amount'];
?>

<div class="container flex-column align-items-center mt-5">
    <div class="flex-row row">
        <div class="col-6 col-lg-3">
            <img src="../../assets/images/categories/<?php echo str_replace(' ', '_', strtolower(trim($category))) . ".png"; ?>" width="120">
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow">
                <p><?php echo $category; ?></p>
                <p><?php echo str_replace('_', ' ', ucwords(trim($request))); ?></p>
            </div>
        </div>
    </div><!-- end of flex box-->
    <hr>
    <div class="flex-row row">
        <div class="col-6 col-lg-3">
            <p>Service Charge</p>
            <p>Tax</p>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow">
                <p><?php echo $price; ?></p>
                <p><?php echo $tax; ?></p>
            </div>
        </div>
    </div><!-- end of flex box-->
    <hr>
    <div class="flex-row row">
        <div class="col-6 col-lg-3">
            <p>________________</p>
            <p>Total</p>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow">
                <p>________________</p>
                <p><?php echo $amount; ?></p>
            </div>
        </div>
    </div><!-- end of flex box-->
    <hr>
    <div class="flex-row row justify-content-center">
        <div class="col-8 col-md-8">
            <form action="../../src/API/paystackApi.php" method="POST">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                <input type="submit" class="btn btn-lg btn-block text-white mt-3" style="background-color:#C2185B;" name="action" value="Checkout">
            </form>
        </div>
    </div>
</div>


<?php
include "../../view/__partials/bottommenu.php";
?>
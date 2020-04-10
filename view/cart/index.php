<?php

include "../../view/__partials/topmenu.php";
include "../../src/config/db/Connect.php";

$category = $_SESSION['category'];
$request = $_SESSION['request'];
$price = $_SESSION['price'];
$tax = $_SESSION['tax'];
$logistics = $_SESSION['logistics'];
$amount = $_SESSION['amount'];
?>

<div class="container flex-column align-items-center mt-5">
    <div class="flex-row row">
        <div class="col-6 col-lg-3">
            <img src="../../assets/images/categories/<?php echo str_replace(' ', '_', strtolower(trim($category))) . ".png"; ?>" width="120" height="120">
        </div>
        <div class="col-6 col-lg-3">
            <div class="card shadow pl-3">
                <p class="text-secondary"><small><em>Customer request category</em>: <b><?php echo $category; ?></b></small><br></p>
                <p><small><em>Customer request: </em><b><?php echo str_replace('_', ' ', ucwords(trim($request))); ?></b></small></p>
            </div>
        </div>
    </div><!-- end of flex box-->
    <hr>
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>Request Category</th>
                <th>Customer Request</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><small><?php echo $category; ?></small></td>
                <td><small><?php echo str_replace('_', ' ', ucwords(trim($request))); ?></small></td>
            </tr>
        </tbody>
    </table>
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>Service Charge</th>
                <th>Logistics</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td><small><?php echo "₦" . number_format($price) . ".00"; ?></small></td>
                <td><small><?php echo "₦" . number_format($logistics) . ".00"; ?></small></td>

            </tr>
        </tbody>
    </table>
    <table class="table table-hover">
        <tr>
            <td></td>
            <th>Tax</th>
            <td><small><?php echo "₦" . $tax; ?></small></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <th>Total</th>
            <th class="font-weight-bolder text-danger"><?php echo "₦" . number_format($amount) . ".00"; ?></th>
            <td></td>
        </tr>
        <tr></tr>
    </table><hr>
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
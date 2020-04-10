<?php

if (!empty($_REQUEST['request'])) {

    $request = base64_decode($_GET['request']);
    include "../__partials/topmenu.php";
    include "../../src/config/db/Connect.php";
    include "../../view/__partials/displaysuccess.php";
    include "../../view/__partials/displayerror.php";
    if (isset($firstname) || isset($lastname) || isset($phone) || isset($email) || isset($address)) {
        $style = "color: darkolivegreen !important";
    } else {
        $style = "";
    }
    $stmt = $mysqli->query("SELECT * FROM requestTable WHERE `request` = '$request'");
    $row = $stmt->fetch_assoc();
    $_SESSION['category'] = $row['category'];
    $_SESSION['request'] = $row['request'];
    $_SESSION['price'] = $row['price'];
    $_SESSION['amount'] = $row['amount'];
    $_SESSION['logistics'] = $row['logistics'];
    $_SESSION['tax'] = $row['tax'];
?>
    <div class="container justify-content-center align-items-center">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <form action="../../index.php" method="POST" class="valign">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <div class="text-center mt-4 font-weight-bold">Confirm User Info</div>
                    <hr />
                    <div class="form-group">
                        <label class="col-form-label" for="firstname">Firstname</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" style="<?php echo $style; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="lastname">Lastname</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="phone">Phone number</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="tel" pattern="[0-9]{4}[0-9]{3}[0-9]{4}" name="phone" id="phone" value="<?php echo $phone; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="email">Email</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="email" name="email" id="email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="address_1">Address</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="text" name="address_1" id="address_1" value="<?php echo $address; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-lg text-white font-weight-bolder" style="background-color:#C2185B;" name="action" value="Proceed">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
<?php
    include "../__partials/bottommenu.php";
} else {
}

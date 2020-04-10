<?php
//create a session
session_start();
//create csrf session token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

if(isset($_GET['action'])){
    $email_token = $_GET['action'];
}

?>
<html>

<head>
    <?php include "../../view/__partials/head.php"; ?>
</head>
<?php
include "../../view/__partials/displaysuccess.php";
include "../../view/__partials/displayerror.php";
?>
<body class="gradient">
    <div class="justify-content-center align-items-center row">
        <div class="text-white text-center p-3 font-weight-bolder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #C2185B;">Reset Password</div>
    </div>
    <div class="container">
        <div class="justify-content-center align-items-center row">
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <form action="../../index.php" method="POST" class="center ">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <input type="hidden" name="email_token" value="<?php echo $email_token; ?>">
                    <div class="form-group">
                        <label class="col-form-label" for="password">Password</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="password" name="password">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="confirm">Confirm</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="password" name="confirm">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-lg btn-block text-white" style="background-color:#C2185B" type="submit" name="action" value="Reset">
                    </div>
                    <div class="form-group d-flex flex-row justify-content-center">
                        <a href="../../view/login/" class="text-decoration-none font-weight-bold">&lt;&lt; Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


</html>
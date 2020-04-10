<?php
//create a session
session_start();
//create csrf session token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>
<html>

<head>
    <?php include "../../view/__partials/head.php"; ?>
</head>

<body class="gradient">
    <div class="justify-content-center align-items-center row">
    <div class="text-white text-center p-3 font-weight-bolder col-lg-12 col-md-12 col-sm-12 col-xs-12 row" style="background-color: #C2185B;"><div class="col-4 text-left"><a href="#" onClick="javascript:window.history.back();"><img src="../../assets/images/arrow.png" alt="back" width="50px"></a></div><div class="col-8 text-left">Password Reset</div></div></div>
    <?php
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
        $message = "alert alert-danger alert-dismissible text-center font-weight-bolder";
        $closeAlert = "<a href='#' class='close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>";
    } else {
        $error = "";
        $message = "";
        $closeAlert = "";
    }
    ?>
    <div class="<?php echo $message; ?>">
        <?php echo $closeAlert; ?>
        <?php echo $error; ?>
    </div>
    </div>
    <div class="container">
        <div class="justify-content-center align-items-center row">
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <form action="../../index.php" method="POST" class="center ">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <div class="form-group">
                        <label class="col-form-label" for="email">Email</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-lg btn-block text-white" style="background-color:#C2185B" type="submit" name="action" value="Change password">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


</html>
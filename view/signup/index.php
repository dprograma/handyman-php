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
        <div class="text-white text-center p-3 font-weight-bolder col-lg-12 col-md-12 col-sm-12 col-xs-12 row" style="background-color: #C2185B;"><div class="col-md-3"><img src="../../assets/images/arrow.png" alt="" width="50px"></div><div class="col-md-9 mx-auto">Sign Up</div></div>
    </div>
    <?php
    if (isset($_SESSION['error'])) {
        $alert = $_SESSION['error'];
        unset($_SESSION['error']);
        $message = "alert alert-danger alert-dismissible text-center font-weight-bolder";
        $closeAlert = "<a href='#' class='close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>";
    }elseif(isset($_SESSION['success'])){
        $alert = $_SESSION['success'];
        unset($_SESSION['success']);
        $message = "alert alert-success alert-dismissible text-center font-weight-bolder";
        $closeAlert = "<a href='#' class='close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>";
    } else {
        $alert = "";
        $message = "";
        $closeAlert = "";
    }
    ?>
    <div class="<?php echo $message; ?>">
        <?php echo $closeAlert; ?>
        <?php echo $alert; ?>
    </div>
    <div class="container">
        <div class="justify-content-center align-items-center row">
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <form action="../../index.php" method="POST" class="center ">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <div class="form-group">
                        <label class="col-form-label" for="firstname">Firstname</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="text" placeholder="John" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="lastname">Lastname</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="text" placeholder="Doe" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="username">Username</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="text" placeholder="johndoe" name="username" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="email">Email</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="email" placeholder="someone@example.com" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="password">Password</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="password" placeholder="********" name="password" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="confirm">Confirm</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="password" placeholder="********" name="confirm" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="phone">Phone</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="tel" pattern="[0-9]{4}[0-9]{3}[0-9]{4}" placeholder="09045231754" name="phone" required>

                    </div>
                    <div class="form-group">
                        <input class="btn btn-lg btn-block text-white" style="background-color:#C2185B" type="submit" name="action" value="Sign up">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
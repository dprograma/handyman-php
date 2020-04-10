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
    <script type="text/javascript">
        function setCookie(cmail, cpwd) {
            var mailvalue = document.getElementById("email").value;
            var pwdvalue = document.getElementById("password").value;
            var d = new Date();
            // d.setTime(d.getTime() + (10 * 24 * 60 * 60 * 1000));
            // var expires = "expires=" + d.toUTCString();
            document.cookie = cmail + "=" + mailvalue + "; expires=Tue, 19 Jan 2038 03:14:07 UTC";
            document.cookie =  cpwd + "=" + pwdvalue + ";expires=Tue, 19 Jan 2038 03:14:07 UTC";
        }
    </script>
</head>

<body class="gradient">
    <div class="justify-content-center align-items-center row">
        <div class="text-white text-center p-3 font-weight-bolder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #C2185B;">Authentication</div>
    </div>
    <?php
        include "../../view/__partials/displayerror.php";
    ?>
    <div class="container">
        <div class="justify-content-center align-items-center row">
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <form action="../../index.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <?php if (isset($_COOKIE['email']) || isset($_COOKIE['password'])) {
                        $email = $_COOKIE['email'];
                        $password = $_COOKIE['password'];
                    } else {
                        $email = "";
                        $password = "";
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-form-label" for="email">Email</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="email" placeholder="someone@example.com" name="email" id="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="password">Password</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="password" placeholder="*********" name="password" id="password" value="<?php echo $password; ?>">
                    </div>
                    <div class="form-group">

                        <label class="col-form-label" for="remember-me">Remember me</label>
                        <input type="checkbox" name="remember-me" onchange="setCookie('email','password');">

                    </div>
                    <div class="form-group">
                        <input class="btn btn-lg btn-block text-white" style="background-color:#C2185B" type="submit" name="action" value="Sign in">
                    </div>
                </form>
                <div class="justify-content-center align-items-center font-weight-bolder p-2 row">
                    <div class="text-center">Not registered? <a href="../signup/" class="text-decoration-none">Sign up</a></div>
                </div>
                <div class="justify-content-center align-items-center font-weight-bolder p-2 row">
                    <div class="text-center"><a href="../sendemail/" class="text-decoration-none">Forgot password?</a></div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
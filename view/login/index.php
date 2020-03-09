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
    <title>Sign In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css">
    <script type="text/javascript" src="../../assets/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.js"></script>
    <script type="text/javascript">
        function setCookie(cmail,cpwd) {
            var mailvalue = document.getElementById("email").value;
            var cookiemail;
            var cookiepwd;
            var d = new Date();
            d.setTime(d.getTime() + (10 * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cmail + "=" + mailvalue + ";" + cpwd + "=;" + expires + ";path=/";
        }
    </script>
</head>

<body>
    <div class="justify-content-center align-items-center row">
        <div class="text-white text-center p-3 font-weight-bolder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #C2185B;">Authentication</div>
    </div>
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
    <div class="container">
        <div class="justify-content-center align-items-center row">
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <form action="../../index.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <?php if (isset($_COOKIE['email'])) {
                        $email = $_COOKIE['email'];
                    } else {
                        $email = "";
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-form-label" for="email">Email</label>
                        <input class="form-control" type="email" placeholder="someone@example.com" name="email" id = "email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="password">Password</label>
                        <input class="form-control" type="password" placeholder="*********" name="password" id = "password">
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
                    <div class="text-center">Not registered? <a href="../signup/">Sign up</a></div>
                </div>
                <div class="justify-content-center align-items-center font-weight-bolder p-2 row">
                    <div class="text-center"><a href="../sendemail/">Forgot password?</a></div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
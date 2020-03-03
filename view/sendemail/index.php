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
    <title>Send Mail</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css">
    <script type="text/javascript" src="../../assets/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.js"></script>
</head>

<body>
    <div class="justify-content-center align-items-center row">
    <div class="text-white text-center p-3 font-weight-bolder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #C2185B;">Reset Password</div>
    </div>
    <div class="container">
        <div class="justify-content-center align-items-center row">
            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <form action="../../index.php" method="POST" class="center ">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <div class="form-group">
                        <label class="col-form-label" for="email">Email</label>
                        <input class="form-control" type="email" name="email" required>
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
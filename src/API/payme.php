<?php

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width minimum-scale=1.0 maximum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../assets/fontawesome/css/all.css">
    <script type="text/javascript" src="../../assets/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../assets/fontawesome/js/all.js"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <img src="../../assets/images/paystack.jpg" style="width: 100%">
                <form action="paystackApi.php" method="POST">
                    <div class=" offset-2 justify-content-center">
                        <div class="form-group row mt-3 col-md-10">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="input-group mt-5 col-md-5">
                            <div class="input-group-prepend">
                                <span class="input-group-text">N</span>
                            </div>
                            <input type="text" name="amount" class="form-control">
                        </div>
                        <div class="col-md-5 mt-5">
                            <input type="submit" class="btn btn-danger btn-block" value="Pay Now">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
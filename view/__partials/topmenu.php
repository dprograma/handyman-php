<?php

session_start();

// if (isset($_GET['verify'])) {
//     $verify = $_GET['verify'];
//     unset($_GET['verify']);

//     if (isset($_SESSION['verify'])) {
//         $session_verify = $_SESSION['verify'];
//         unset($_SESSION['verify']);
//     }
//     if (hash_equals($verify, $session_verify)) {

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    //unset($_SESSION['userid']);
} else {
    $userid = "";
}
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    //unset($_SESSION['email']);
} else {
    $email = "";
}
if (isset($_SESSION['password'])) {
    $password = $_SESSION['password'];
    //unset($_SESSION['password']);
} else {
    $password = "";
}
if (isset($_SESSION['firstname'])) {
    $firstname = $_SESSION['firstname'];
    //unset($_SESSION['firstname']);
} else {
    $firstname = "";
}
if (isset($_SESSION['lastname'])) {
    $lastname = $_SESSION['lastname'];
    //unset($_SESSION['lastname']);
} else {
    $lastname = "";
}
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    //unset($_SESSION['username']);
} else {
    $username = "";
}
if (isset($_SESSION['address'])) {
    $address = $_SESSION['address'];
    //unset($_SESSION['address']);
} else {
    $address = "";
}
if (isset($_SESSION['permission'])) {
    $permission = $_SESSION['permission'];
    //unset($_SESSION['permission']);
} else {
    $permission = "";
}
if (isset($_SESSION['phone'])) {
    $phone = $_SESSION['phone'];
    //unset($_SESSION['phone']);
} else {
    $phone = "";
}
if (isset($_SESSION['session'])) {
    $session = $_SESSION['session'];
    //unset($_SESSION['session']);
} else {
    $session = "";
}
if (isset($_SESSION['loggedin'])) {
    $loggedin = $_SESSION['loggedin'];
    //unset($_SESSION['loggedin']);
} else {
    $loggedin = "";
}
if (isset($_SESSION['registered'])) {
    $registered = $_SESSION['registered'];
    //unset($_SESSION['registered']);
} else {
    $registered = "";
}
if (isset($_SESSION['imagefile'])) {
    $imagefile = $_SESSION['imagefile'];
} else {
    $imagefile = "avater.png";
}

$redirectUrl = 'http://' . $_SERVER['SERVER_NAME'] . '/handyman-php/';

if ($loggedin == 1) {

?>

    <html>

    <head>
        <?php 
        include "../../view/__partials/head.php"; 
        ?>
    </head>

    <body class="gradient">
        <div id="my-page">
            <div id="my-header" class="text-white p-3 font-weight-bolder col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color: #C2185B;">
                <a href="#my-menu"><img src="../../assets/images/hamburger.png" width="45px"></a><span class="mx-5 font-weight-bolder"><?php if (isset($request)) {
                                                                                                                                            $request = trim($request);
                                                                                                                                            $requestheader = strlen($request) >  18 ? substr($request, 0, 18) . "..." : $request;
                                                                                                                                            echo str_replace('_', ' ', $requestheader);
                                                                                                                                        } elseif (isset($category)) {
                                                                                                                                            $category = trim($category);
                                                                                                                                            $categoryheader = strlen($category) >  18 ? substr($category, 0, 18) . "..." : $category;
                                                                                                                                            echo str_replace('_', ' ', $categoryheader);
                                                                                                                                        } elseif (isset($profile)) {
                                                                                                                                            $profile = trim($profile);
                                                                                                                                            $profileheader = strlen($profile) >  18 ? substr($profile, 0, 18) . "..." : $profile;
                                                                                                                                            echo str_replace('_', ' ', $profileheader);
                                                                                                                                        }
     elseif(isset($_GET['action'])){
        $action = $_GET['action'];
        echo base64_decode($action);
     } 
     elseif(isset($_GET['category'])){
        $action = $_GET['category'];
        $action = base64_decode($action);
        $action = str_replace("_", " ", $action);
        $actionheader = strlen($action) >  18 ? substr($action, 0, 18) . "..." : $action;
        echo $actionheader;
     }                                                                  elseif(empty($requestheader) && empty($categoryheader) && empty($profileheader)){
echo "Categories";
                                                                                                                                        }
     else{
         echo "Admin";
     }                                                                                                                                   ; ?></span>
                <nav id="my-menu">
                    <ul>
                        <li class="justify-content-center" style="overflow:hidden"><img src="../../assets/images/profileimg/<?php echo $imagefile; ?>" width="200px" style="margin:20px;border-radius: 50%;"></li>
                        <li><a href="../../view/profile/?profile=<?php echo base64_encode("profile"); ?>">Profile</a></li>
                        <li class="active"><a href="<?php if ($loggedin == 1) {
                                                        echo '../../view/account/';
                                                    } else {
                                                        echo '../../view/login/';
                                                    } ?>">Home</a></li>
                        <li><span><a href="<?php if ($loggedin == 1) {
                                                echo '../../view/customer/?action=' . base64_encode('Customer Request');
                                            } else {
                                                echo '../../view/login/';
                                            } ?>">My Request</a></span>
                            <!-- <ul>
                            <li><a href="/about/history/">History</a></li>
                            <li><a href="/about/team/">The team</a></li>
                            <li><a href="/about/address/">Our address</a></li>
                        </ul> -->
                        </li>
                        <?php
                        if ($loggedin == 1 && $permission == 1) {
                            echo "<li><a href='../../src/controllers/categoryController/?action=read'>Admin</a>";
                        }
                        ?>
                        <li><a href="<?php echo $redirectUrl . 'src/controllers/logoutController/?action=Signout'; ?>">Logout</a></li>
                    </ul>
                </nav>
            </div>
            <div id="my-content">
            <?php
        }
            ?>
<?php
//start a session
session_start();
// if (empty($_SESSION['token'])) {
//     $_SESSION['token'] = bin2hex(random_bytes(32));
// }
// $token = $_SESSION['token'];
//load file for mysqli connection to database

// if (!empty($_POST['token'])) {
//     if (hash_equals($_SESSION['token'], $_POST['token'])) {
//          // Proceed to process the form data
//     } else {
//          // Log this as a warning and keep an eye on these attempts
//     }
// }

if (!empty($_REQUEST['csrf_token'])) {
    if (hash_equals($_SESSION['csrf_token'], $_REQUEST['csrf_token'])) {
        // Proceed to process the form data
        if (isset($_SERVER['REQUEST_METHOD'])) {
            if (isset($_REQUEST['action']) || $_REQUEST['action'] == '') {
                $action = $_REQUEST['action'];
                switch ($action) {
                    case 'Sign up':
                        include 'src/classes/Singup.php';

                        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $confirm = filter_input(INPUT_POST, 'confirm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
                        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
                        $start = 100000;
                        $end = 10000000;
                        $userId = rand($start, $end);
                        $table = "migrationTable";
                        $url = "http://localhost/handyman-php/view/account/";
                        $from = "info@handyman.com";
                        $subject = "User Registration";

                        $list = [$userId, $email, $password, $firstname, $lastname, $username, $phone];
                        $signup = new Signup();
                        $signup->create($table, $url, $subject, $from, $password, $confirm, $email, $list);
                        break;

                    case 'Sign in':

                        include 'src/classes/Signin.php';
                        include 'src/config/db/Connect.php';

                        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
                        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $table = "migrationTable";
                        $url = "handyman.com/account/";

                        $signin = new Signin();
                        $signin->login($table, $email, $password, $url);

                        break;

                    case 'Change password':

                        include 'src/classes/Reset.php';

                        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);

                        $table = "migrationTable";
                        $subject = "Password Reset";
                        $url = "handyman.com/reset/";
                        $from = "info@handyman.com";

                        $reset = new Reset();
                        $reset->sendMail($table, $subject, $url, $from, $email);

                        break;

                    case 'Reset':

                        //create a session
                        session_start();

                        //check if email token match
                        if (!empty($_GET['email_token'])) {
                            if (hash_equals($_SESSION['email_token'], $_GET['email_token'])) {
                                //autoload php files include
                                include 'src/classes/Reset.php';

                                //declare variables and sanitize them
                                $table = "migrationTable";
                                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                $confirm = filter_input(INPUT_POST, 'confirm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                                //check if password and confirm password match
                                if ($password == $confirm) {
                                    $reset = new Reset();
                                    $reset->update($table, $email, $password);
                                } else {
                                    $_SESSION['error'] = "Password mismatch!";
                                }
                            } else {
                                // Log this as a warning and keep an eye on these attempts
                                echo "Invalid request!";
                            }
                        }

                        break;

                    case 'Delete':

                        //autoload php files include
                        include 'src/classes/Destroy.php';

                        $url = "handyman.com";
                        $table = "migrationTable";
                        $destroy = new Destroy();
                        $destroy->delete($url, $table);

                        break;

                    case 'Proceed':
                        include 'src/config/db/Connect.php';

                        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $address = filter_input(INPUT_POST, 'address_1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
                        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
                        $customername = $firstname . " " . $lastname;
                        $x = 1111111;
                        $y = 111111111;
                        $rand = rand($x, $y);
                        $customerid = $rand;
                        $category = $_SESSION['category'];
                        $request = $_SESSION['request'];
                        $price = $_SESSION['price'];
                        $amount = $_SESSION['amount'];
                        $tax = $_SESSION['tax'];
                        $orderdate = date('d-m-Y h:i:s');
                        $returndate = date('d-m-Y h:i:s');
                        $qty = 1;

                        $redirect = "view/cart/";
                        $redirectback = "view/request/?request=" . base64_encode($request);

                        $stmt = $mysqli->prepare("INSERT INTO customerRequestTable (customerrequestId,customerrequest,requestcategory,customername,customeremail,customerphone,customeraddress,orderdate,orderreturndate,quantity,unitprice,amount,tax) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
                        $stmt->bind_param('issssssssiddd', $customerid, $request, $category, $customername, $email, $phone, $address, $orderdate, $returndate, $qty, $price, $amount, $tax);
                        $stmt->execute();
                        $stmt->store_result();
                        if ($stmt->affected_rows > 0) {
                            header("location:$redirect");
                        } else {
                            $_SESSION['error'] = "Something went wrong!";
                            header("location:$redirectback");
                        }

                        break;

                    case 'Update Profile':

                        include 'src/config/db/Connect.php';
                        include 'src/classes/Upload.php';

                        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $oldpassword = filter_input(INPUT_POST, 'old_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $newpassword = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $Email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
                        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);

                        $loggedin = $_SESSION['loggedin'];
                        $email = $_SESSION['email'];
                        $password = $_SESSION['password'];
                        if (empty($newpassword)) {
                            $newpassword = $password;
                        }

                        if ($loggedin == 1) {
                            $stmt = $mysqli->prepare("UPDATE migrationTable SET `email` = ?, `password` = ?, `firstname` = ?,  `lastname` = ?, `username` = ?, `address` = ?, `phone` = ? WHERE `email` = ?");
                            $stmt->bind_param('ssssssss', $Email, $newpassword, $firstname, $lastname, $username, $address, $phone,  $email);
                            $stmt->execute();

                            // If user details is updated successfully,then upload display image
                            if ($stmt) {
                                $redirectUrl = 'http://' . $_SERVER['SERVER_NAME'] . '/handyman-php/';
                                $targetUrl = "assets/images/profileimg/";
                                $userid = $_SESSION['userid'];
                                $uploadimage = new Upload();
                                $uploadimage->uploadfile($targetUrl, $redirectUrl, $userid);
                            } else {
                                $_SESSION['error'] = "Error updating your image.";
                            }
                        } else {
                            $_SESSION['error'] = "Error updating your details.";
                            exit;
                        }

                        break;

                    default:
                        require_once 'src/config/db/Connect.php';
                        $url = 'view/login/';
                        header("location:$url");
                        //echo "Default!";
                        break;
                }
            } else {
                require_once 'src/config/db/Connect.php';
                $url = 'view/login/';
                header("location:$url");
                //echo "post method is wrong!";
            }
        } else {
            require_once 'src/config/db/Connect.php';
            $url = 'view/login/';
            header("location:$url");
            //echo "request method is wrong!";
        }
    } else {
        // Log this as a warning and keep an eye on these attempts
        echo "Invalid request!";
    }
} else {
    require_once 'src/config/db/Connect.php';
    $url = 'view/login/';
    header("location:$url");
    //echo "csrf token is empty!";
}

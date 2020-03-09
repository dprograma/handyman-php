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

if (!empty($_POST['csrf_token'])) {
    if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
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
                        $userId = rand($start,$end);
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

                    case 'Sign out':

                        //autoload php files include
                        include 'src/classes/Destroy.php';

                        $url = "handyman.com";
                        $signout = new Destroy();
                        $signout->signout($url);

                        break;

                    case 'Delete':

                        //autoload php files include
                        include 'src/classes/Destroy.php';

                        $url = "handyman.com";
                        $table = "migrationTable";
                        $destroy = new Destroy();
                        $destroy->delete($url, $table);

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

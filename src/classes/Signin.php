<?php

class Signin
{
    public $email;
    public $password;
    public $table;
    public $url;

    public function login($table, $email, $password, $url)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        //connect to mysql database server
        $mysqli = new mysqli('localhost', 'root', '', 'handyman_8791');
        //check if email and password exist in database
        $sql = "SELECT * FROM " . $table . " WHERE `email` = ? AND `password` = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows() > 0) {
            //store session id in database if successfully logged in
            $sessionid = session_id();
            $loggedin = '1';
            $sql = "UPDATE " . $table . " SET `sessionid` = ?, `loggedIn` = ? WHERE `email` = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('sis', $sessionid, $loggedin, $email);
            $stmt->execute();
            
            if ($stmt) {
                $stmt->close();
                //retrieve all user details from database
                $stmt = $mysqli->prepare("SELECT * FROM " . $table . " WHERE `email` = ? AND `password` = ?");
                $stmt->bind_param('ss', $email, $password);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($userid,$e_mail,$pwd,$firstname,$lastname,$username,$address,$permission,$phone,$displayimage,$session,$loggedin,$registered);
                $stmt->fetch();

                $_SESSION['userid'] = $userid;
                $_SESSION['email'] = $e_mail;
                $_SESSION['password'] = $pwd;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['username'] = $username;
                $_SESSION['address'] = $address;
                $_SESSION['permission'] = $permission;
                $_SESSION['phone'] = $phone;
                $_SESSION['imagefile'] = $displayimage;
                $_SESSION['session'] = $session;
                $_SESSION['loggedin'] = $loggedin;
                $_SESSION['registered'] = $registered;
                
                $url = "view/account/";
                header("location:$url");
                $stmt->close();
            } else {
                echo "session not saved.";
            }
        } else {
            $_SESSION['error'] = "Invalid username or Email.";
            $redirectToSelf = "view/login/";
            header("location:$redirectToSelf");
            $stmt->close();
        }
    }
}

<?php

class Signup
{
    //declare variables
    public $table;
    public $userid;
    public $email;
    public $password;
    public $confirm;
    public $subject;
    public $to;
    public $from;
    public $list = [];

    public function create($table, $url, $subject, $from, $password, $confirm, $email,  $list)
    {
        //connect to mysqli database
        $mysqli = new mysqli('localhost', 'root', '', 'handyman_8791');
        //check if email already exists
        $sql = "SELECT * FROM " . $table . " WHERE `email` = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        //if email already exists output a message in a session
        if ($stmt->num_rows() > 0) {
            $stmt->close();
            $_SESSION['error'] = "Email already exists!";
        } elseif ($password != $confirm) {              //check if password
            $_SESSION['error'] = "Password mismatch!"; //is same as re-enter
            $stmt->close();                                     //password
        } else {
            $stmt->close();
            //if all goes well
            $sql = "INSERT IGNORE INTO " . $table . " (userId,email,password,firstname,lastname,username,phone) VALUES(";
            foreach ($list as $l) {                            //insert into 
                $values[] = "'$l'";                       //database
            }
            $sql .= implode(', ', $values);
            $sql .= ")";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
            //if insert works send an email to user
            if ($stmt->affected_rows > 0) {

                // ini_set("SMTP", "smtp.mailtrap.io");
                // ini_set("smtp_port", "2525");
                // ini_set("auth_username", "e4ddb8cd5d0f6e");
                // ini_set("auth_password", "7c789e78d8ef2a");
                // ini_set("smtp_ssl", "auto");
                // ini_set("sendmail_from", "from@example.com");
                
                $message = "<p><strong>Welcome to HandyMan</strong></p>";
                $message .= "<p> Please, click the link below to confirm your email. </p>";
                $message .= "<p><a href='$url'>" . $url . "</a></p>";
                $message = wordwrap($message, 70);
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type: text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: <" . $from . ">" . "\r\n";
                //if mail is sent, output a message in a session
                if (mail($email, $subject, $message, $headers)) {
                    $_SESSION['email_message'] = "A message has been sent to your email.";
                    $stmt->close();
                } else {
                    return;
                }
            } else {
                echo "error: insertion failed!";
            }
        }
    }
}

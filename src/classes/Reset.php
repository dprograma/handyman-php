<?php

class Reset
{
    //declare parameters
    public $subject;
    public $message;
    public $from;
    public $url;
    public $token;
    public $table;
    public $email;
    public $password;

    public function sendMail($table, $subject, $url, $from, $email)
    {
        //connect to mysql server 
        $mysqli = new mysqli('localhost', 'root', '', 'handyman_8791');

        //check if email sent exist before adding url token to database
        $sql = "SELECT * FROM " . $table . " WHERE `email` = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        if ($stmt->num_rows() > 0) {
            //create a string token and store in a session
            $token = bin2hex(random_bytes(32));
            $_SESSION['email_token'] = $token;

            //create email credentials
            $url = $url . "?action=" . $token;
            $message = "<p><strong>Hello, </strong></p>";
            $message .= "<p> Please, click the link below to reset your password. </p>";
            $message .= "<p><a href='$url'>" . $url . "</a></p>";
            $message = wordwrap($message, 70);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: <" . $from . ">" . "\r\n";
            if (mail($email, $subject, $message, $headers)) {
                $_SESSION['email_message'] = "A message has been sent to your email.";
                $stmt->close();
                $url = "../../view/sendemail/";
                header("location:$url");
            } else {
                echo "error sending email";
            }

            echo "Update failed.";
            $stmt->close();
        } else {
            $_SESSION['email_error'] = "Email does not exist!";
            $stmt->close();
        }
    }

    public function update($table, $email, $password)
    {
        //start a session
        session_start();

        //load file for mysqli connection to database
        $mysqli = new mysqli('localhost', 'root', '', 'handyman_8791');
        //check if password to be reset already exist
        $sql = "SELECT * FROM " . $table . " WHERE `email` = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();

        if ($stmt->num_rows() > 0) {
            //update the table with the password and email sent
            $sql = "UPDATE " . $table . " SET `password` = ? WHERE `email` = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('ss', $password, $email);
            $stmt->execute();

            if ($stmt->num_rows() > 0) {
                $_SESSION['success'] = "Password reset is successful.";
            } else {
                return;
            }
        } else {
            echo "password field is empty!";
        }
    }
}

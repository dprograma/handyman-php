<?php

class Signin
{
    public $email;
    public $password;
    public $table;
    public $url;

    public function signin($table, $email, $password, $url)
    {
        session_start();
        //connect to mysql database server
        $mysqli = new mysqli('localhost', 'root', '', 'handyman_8791');

        $sql = "SELECT * FROM " . $table . "WHERE email = ? AND password = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();

        if ($stmt->num_rows() > 0) {
            //store session id in database if successfully logged in
            $sessionid = session_id();
            $sql = "UPDATE " . $table . "SET `sessionid` = ? WHERE `email` = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('ss', $sessionid, $email);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                header("Location:$url");
                $stmt->close();
            } else {
                echo "session not saved.";
            }
        } else {
            $_SESSION['error'] = "Username or Email error.";
            $stmt->close();
        }
    }
}

<?php

class Destroy
{
    public $url;
    public $table;
    public function delete($url, $table)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        //start a session
        session_start();

        //create a database connection
        $mysqli = new mysqli('localhost', 'root', '', 'handyman_8791');
        //obtain the current session id and compare with that in the database
        $sessionid = session_id();

        $sql = "SELECT * FROM " . $table . " WHERE `sessionid` = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $sessionid);
        $stmt->execute();
        $stmt->store_result();
        //if session id matches then delete the affected row
        if ($stmt->num_rows() > 0) {
            $sqs = "DELETE FROM " . $table . " WHERE `sessionid` = ?";
            $stms = $mysqli->prepare($sqs);
            $stms->bind_param('s', $sessionid);
            $stms->execute();
            //if row deletion is successful, output a message in a session
            $stmt->store_result();
            if ($stms->affected_rows > 0) {
                $_SESSION['deleted'] = "Account successfully deleted!";
                header("location:$url");
            } else {
                echo "error deleting record.";
            }
        } else {
            echo "No such session id";
        }
    }

    public function signout($url)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        //connect to mysqli database
        $mysqli = new mysqli('localhost', 'root', '', 'handyman_8791');
        //obtain session
        session_start();
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $loggedin = $_SESSION['loggedin'];
    
        //remove logged in value from database
        $log = 0;
        $session = "";
        $sql = $mysqli->prepare("UPDATE migrationTable SET `loggedin` = ?, `sessionid` = ? WHERE `email` = ?");
        $sql->bind_param('iss', $log, $session, $email);
        $sql->execute();
        //unset current session id
        session_unset($_SESSION['email']);
        unset($_SESSION['email']);
        session_unset($_SESSION['password']);
        unset($_SESSION['password']);
        session_unset($_SESSION['loggedin']);
        unset($_SESSION['loggedin']);

        header("location:$url");
    }
}

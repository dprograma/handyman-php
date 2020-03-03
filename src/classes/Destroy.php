<?php

class Destroy
{
    public $url;
    public $table;
    public function delete($url, $table)
    {
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
        //if session id matches then delete the affected row
        if ($stmt->num_rows() > 0) {
            $sqs = "DELETE FROM " . $table . " WHERE `sessionid` = ?";
            $stms = $mysqli->prepare($sqs);
            $stms->bind_param('s', $sessionid);
            $stms->execute();
            //if row deletion is successful, output a message in a session
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
        //start a session
        session_start();

        //obtain session id
        $sessionid = session_id();
        //unset current session id
        session_unset($sessionid);
        unset($sessionid);

        header("Location:$url");
    }
}

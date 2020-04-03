<?php

class Upload
{

    public function uploadfile($target_dir, $url, $id)
    {
        ob_start();
        $mysqli = new mysqli("localhost", "root", "", "handyman_8791");

        $target_file = $target_dir . basename($_FILES['image']['name']);
        
        $redirect = $url . "view/profile/?profile=" . base64_encode('profile');
        
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $imageName = $target_dir . $id . "." . $imageFileType;
        $imagefile = $id . "." . $imageFileType;
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            $_SESSION['error'] = "Sorry, your file is too large.";
            $uploadOk = 0;
            header("location:$redirect");
        }
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
            header("location:$redirect");
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION['error'] = "Sorry, your file was not uploaded.";
            header("location:$redirect");
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $imageName)) {
                $email = $_SESSION['email'];
                $stmt = $mysqli->query("UPDATE migrationTable SET `displayimage` = '$imagefile' WHERE `email` = '$email'");
                if ($stmt) {
                    $sql = $mysqli->query("SELECT `displayimage` FROM migrationTable WHERE `email` = '$email' ");
                    $row = $sql->fetch_assoc();
                    $_SESSION['imagefile'] = $row['displayimage'];
                }

                $_SESSION['success'] = "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                header("location:$redirect");
            } else {
                $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                header("location:$redirect");
            }
        }
        ob_end_flush();
    }
}

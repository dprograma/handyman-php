<?php

if (isset($_SERVER['REQUEST_METHOD'])) {
    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];

        switch ($action) {
            case 'create':
                include "../../../src/classes/Create.php";
                $redirect = "../../../view/admin/create.php?action=" . base64_encode('Create Category');
                $create = new Create;
                $create->createform($redirect);
                break;
            case 'read':
                include "../../../src/classes/Read.php";
                $redirect = "../../../view/admin/read.php?action=" . base64_encode('Admin');
                $show = new Read;
                $show->readform($redirect);
                break;
            case 'Update':
                session_start();
                include "../../config/db/Connect.php";
                $category = trim($_POST['category']);
                $category = str_replace(" ", "_", $category);
                $redirect = "../../../view/admin/update.php?category=" . base64_encode($category);
                // $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                //check if category has already been created
                $stmt = $mysqli->query("SELECT * FROM requestTable WHERE `category` = '$category'");
                $row = $stmt->fetch_assoc();
                if ($row['updated'] == 1) {
                    $_SESSION['error'] = "Update limit reached.";
                    header("location:$redirect");
                } else {
                    for ($x = 1; $x <= 25; $x++) {
                        if (!empty($_POST[$x])) {
                            $sql = "UPDATE requestTable SET `updated` = 1, `request` = '" . $_POST[$x] . "' WHERE `category` = '$category' AND `fieldname` = '$x'";
                            $mysqli->query($sql) or die($mysqli->error);
                            echo $sql;
                            exit;
                        }
                    }
                    $target_dir = "../../../assets/images/categories/";
                    $target_file = $target_dir . basename($_FILES['image']['name']);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $imageName = $target_dir . $category . "." . $imageFileType;
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
                        $imageFileType != "png"
                    ) {
                        $_SESSION['error'] = "Sorry, PNG files are allowed.";
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
                            $_SESSION['success'] = "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                            header("location:$redirect");
                        } else {
                            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                            header("location:$redirect");
                        }
                    }
                }
                break;
            case 'Delete':
                session_start();
                if (isset($_GET['category'])) {
                    $category = $_GET['category'];
                    $redirect = "../../../view/admin/read.php";

                    include "../../../src/config/db/Connect.php";

                    $stmt = $mysqli->query("DELETE FROM requestTable WHERE `category` = '$category'");

                    $_SESSION['success'] = "Category " . $category . " successfully deleted!";
                    header("location:$redirect");
                }
                break;
            case 'Create':
                session_start();
                include "../../config/db/Connect.php";
                $redirect = "../../../view/admin/create.php";
                $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $category = str_replace(" ", "_", $category);
                // $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                //check if category has already been created
                $stmt = $mysqli->query("SELECT * FROM requestTable WHERE `category` = '$category'");

                if ($stmt->num_rows > 0) {
                    $_SESSION['error'] = "Sorry, this category already exist. Proceed to <a href='update.php'>Edit</a> instead.";
                    header("location:$redirect");
                } else {
                    for ($x = 1; $x <= 20; $x++) {
                        if (!empty($_POST[$x])) {
                            $sql = "INSERT INTO requestTable (category,fieldname,request) VALUES('$category','$x','" . $_POST[$x] . "')";
                            $mysqli->query($sql);
                        }
                    }
                    $target_dir = "../../../assets/images/categories/";
                    $target_file = $target_dir . basename($_FILES['image']['name']);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $imageName = $target_dir . $category . "." . $imageFileType;
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
                        $imageFileType != "png"
                    ) {
                        $_SESSION['error'] = "Sorry, PNG files are allowed.";
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
                            $_SESSION['success'] = "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                            header("location:$redirect");
                        } else {
                            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                            header("location:$redirect");
                        }
                    }
                }
        }
    } else {
        echo "Invalid request!";
    }
} else {
    echo "Invalid request!";
}

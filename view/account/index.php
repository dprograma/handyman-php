<?php

session_start();

if (isset($_GET['verify'])) {
    $verify = $_GET['verify'];
    unset($_GET['verify']);

    if(isset($_SESSION['verify'])){
        $session_verify = $_SESSION['verify'];
        unset($_SESSION['verify']);
    }
    if(hash_equals($verify,$session_verify)){
?>
    <html>
        <head></head>
        <body>
            <div>This is the user account</div>
        </body>
    </html>
<?php
    }
} else {
    $verify = "";
}


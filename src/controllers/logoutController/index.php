<?php
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'Signout') {  
    //autoload php files include
    include '../../../src/classes/Destroy.php';
    
    $url = "../../../view/login/";
    $signout = new Destroy();
    $signout->signout($url);
} else {
    //echo error
    echo "Error";
}


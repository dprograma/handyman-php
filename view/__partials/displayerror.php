<?php
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
        $message = "alert alert-danger alert-dismissible text-center font-weight-bolder";
        $closeAlert = "<a href='#' class='close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>";
    } else {
        $error = "";
        $message = "";
        $closeAlert = "";
    }
    ?>
    <div class="<?php echo $message; ?>">
        <?php echo $closeAlert; ?>
        <?php echo $error; ?>
    </div>
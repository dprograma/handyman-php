<?php
    if (isset($_SESSION['success'])) {
        $success = $_SESSION['success'];
        unset($_SESSION['success']);
        $message = "alert alert-success alert-dismissible text-center font-weight-bolder";
        $closeAlert = "<a href='#' class='close' data-dismiss = 'alert' aria-label = 'close'>&times;</a>";
    } else {
        $success = "";
        $message = "";
        $closeAlert = "";
    }
    ?>
    <div class="<?php echo $message; ?>">
        <?php echo $closeAlert; ?>
        <?php echo $success; ?>
    </div>
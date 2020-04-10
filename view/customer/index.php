<?php

include "../../view/__partials/topmenu.php";
include "../../src/config/db/Connect.php";
include "../../view/__partials/displaysuccess.php";
include "../../view/__partials/displayerror.php";

if ($permission == 1) {
    $stmt = $mysqli->prepare("SELECT * FROM `customerrequestTable`");
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($customerrequestid, $categoryrequest, $requestcategory, $customername, $customeremail, $customerphone, $customeraddress, $orderdate, $returndate, $qty, $price, $amount, $tax, $completed);
} else {
    $stmt = $mysqli->prepare("SELECT * FROM `customerrequestTable` WHERE `customeremail` = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($customerrequestid, $categoryrequest, $requestcategory, $customername, $customeremail, $customerphone, $customeraddress, $orderdate, $returndate, $qty, $price, $amount, $tax, $completed);
}

if ($stmt->num_rows() > 0) {
    while ($stmt->fetch()) {
?>
        <div class="contaier d-flex flex-column align-items-center mt-3">
            <table class="table table-sm table-responsive table-condensed table-active">
                <tbody>
                    <tr class=" d-sm-table-row small text-break">
                        <td colspan="3"><?php echo $customername; ?></td>
                        <td>
                            <div class="<?php if ($completed == 1) {
                                echo "badge-success";
                            } else {
                                echo "badge-secondary";
                            }
                            ; ?>">Completed</div>
                        </td>
                        <td>
                            <div class="<?php if ($completed == 1) {
                                echo "badge-secondary";
                            } else {
                                echo "badge-success";
                            }
                            ; ?>">Pending</div>
                        </td>
                    </tr>
                    <tr>
                        <table class="table table-sm">
                            <tr class=" d-sm-table-row table-info small font-weight-bold">
                                <td colspan="2">Request</td>
                                <td colspan="2" class="text-break">Address</td>
                                <td>Phone</td>
                            </tr>
                            <tr class=" d-sm-table-row small">
                                <td colspan="2"><?php echo str_replace('_', ' ', $categoryrequest); ?></td>
                                <td colspan="2" class="text-break"><?php echo $customeraddress; ?></td>
                                <td class="text-success"><?php echo $customerphone; ?></td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <table class="table table-sm table-bordered">
                            <tr class=" d-xs-table-row small table-secondary">
                                <td>Email</td>
                                <td>Request Date</td>
                                <td>Amount</td>
                            </tr>
                            <tr class=" d-sm-table-row small">
                                <td><?php echo $customeremail; ?></td>
                                <td><?php echo date('F j, Y h:i:s', strtotime($orderdate)); ?></td>
                                <td class="text-danger font-weight-bold"><?php echo "₦" . number_format($amount) . ".00"; ?></td>
                            </tr>
                        </table>
                    </tr>
                    <?php
                    if ($permission == 1) {
                    ?>
                        <tr>
                            <table class="table table-sm">
                                <tr class=" d-sm-table-row small text-break table-pane">
                                    <td colspan="5">
                                        <div class="text-right">
                                            <form action="../../index.php" method="POST">
                                                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                                <input type="hidden" name="customerid" value="<?php echo $customerrequestid; ?>">
                                                <input type="submit" name="action" value="Job Completed" class="btn btn-sm text-white font-weight-bold" style="background-color: #C2185B;"></form>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    }
} else {
    ?>

    <div class="container h-100 d-flex justify-content-center">
        <div class="my-auto">
            <div>You do not have any request at this moment. <br>Please create one</div>
            <div class="h-100 d-flex justify-content-center mt-3"><a class="btn btn-lg text-white" href="../../view/account/" style="background-color:#C2185B;">Place Order</a></div>
        </div>
    </div>
<?php
}
include "../../view/__partials/bottommenu.php";
?>
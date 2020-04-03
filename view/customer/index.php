<?php

include "../../view/__partials/topmenu.php";
include "../../src/config/db/Connect.php";
$stmt = $mysqli->prepare("SELECT `customerrequest` FROM `customerrequestTable` WHERE `customeremail` = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
if ($stmt->num_rows() > 0) {
    echo "<div class='card-group mt-3 mx-5'>";
    while ($rows = $result->fetch_assoc()) {
        echo "<div class='card shadow text-center'><h4 class='card-title'>" . $rows['requestcategory'] . "</h4>
            <div class='card-text'>" . "<strong>Customer Name </strong><i>" . $rows['customername'] . "</i> | <strong>Customer Phone number </strong><i>"
            . $rows['customerphone'] . "</i> | \n <strong>Customer Email Address </strong><i>"
            . $rows['customeremail'] . "</i> | <strong>Customer Address </strong><i>"
            . $rows['customeraddress'] . "</i> | \n <strong>Order Date </strong><i>"
            . $rows['orderdate'] . "</i> | <strong>Price </strong><i>"
            . $rows['unitprice'] . "</i> | <strong>Amount </strong><i>"
            . $rows['amount'] . "</i>" .
            "</div>
            </div>";
    }
    echo "</div>";
}
?>
<div class="container h-100 d-flex justify-content-center">
    <div class="my-auto">
        <div>You do not have any request at this moment. <br>Please create one</div>
        <div class="h-100 d-flex justify-content-center mt-3"><a class="btn btn-lg text-white" href="../../view/account/" style="background-color:#C2185B;">Place Order</a></div>
    </div>
</div>>
<?php

include "../../view/__partials/bottommenu.php";

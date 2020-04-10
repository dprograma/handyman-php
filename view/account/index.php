<?php

include "../__partials/topmenu.php";
include "../../src/config/db/Connect.php";
?>
<div class="container">
    <div class="row d-flex flex-row">
        <?php
        $stmt = $mysqli->prepare("SELECT DISTINCT `category` FROM requestTable");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($rows = $result->fetch_assoc()) {
            echo "<div class='col-6 mt-3 mb-3'>";
            echo "<div class='card shadow'><a href='../../view/category/?cat=" . base64_encode($rows['category']) . "' style='text-decoration:none;'>
                        <img height='120px' class='card-img-top p-3 bg-light'  src='" . "../../assets/images/categories/" . str_replace(' ', '_', trim(strtolower($rows['category']))) . ".png" . "' alt='" . $rows['category'] . "'>
                    </div>";
            echo "<p class='card-text text-center font-weight-bold'>" . str_replace('_', ' ', $rows['category']) . "</p>";
            echo "</div>";
        }
        ?>
    </div>
</div>
</div>
</div>

<?php
include "../__partials/bottommenu.php";
//     }
// } else {
//     $verify = "";
// }

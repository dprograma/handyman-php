<?php

if (!empty($_REQUEST['cat'])) {

    $category = base64_decode($_GET['cat']);

    include "../__partials/topmenu.php";
    include "../../src/config/db/Connect.php";
           
    $stmt = $mysqli->prepare("SELECT request FROM `requesttable` WHERE category = ?");
    $stmt->bind_param('s', $category);
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<div class='card-group mt-3 mx-5'>";
    while ($rows = $result->fetch_assoc()) {
        echo "<div class='card shadow text-center'><a class='text-decoration-none' href='../../view/request/?request=" . base64_encode($rows['request']) . "'><h6 class='card-title'>" . str_replace('_', ' ', $rows['request']) . "</h6></a></div>";
    }
    echo "</div>";

    ?>
    </div>
    </div>
    </div>

<?php
    include "../__partials/bottommenu.php";
} else {
    // Log this as a warning and keep an eye on these attempts
    echo "Invalid request!";
}

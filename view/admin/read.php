<?php

include "../../view/__partials/topmenu.php";
include "../../src/config/db/Connect.php";

include "../../view/__partials/displaysuccess.php";
include "../../view/__partials/displayerror.php";

?>

<div class="container d-flex flex-column align-items-center mx-auto">
    <div class="row mt-3 mb-3">
        <a type="button" class="btn btn-success btn-lg" href="../../src/controllers/categoryController/?action=create">Create Category</a>
    </div>
    <div class="row">
        <table class="table table-md table-hover table-striped center">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $mysqli->query("SELECT DISTINCT `category` FROM requestTable ORDER BY `requestId` ");
                while ($rows = $stmt->fetch_assoc()) {
                    echo "<tr><td>" . str_replace('_', ' ', $rows['category']) . "</td><td><a type='button' class='btn btn-sm btn-outline-secondary' href='../../view/admin/update.php?category=" . base64_encode($rows['category']) . "'>Edit</a></td><td><a type='button' class='btn btn-sm btn-danger' onClick=\"javascript:return confirm('Do you want to delete this category?');\" href='../../src/controllers/categoryController/?action=Delete&category=" . base64_encode($rows['category']) . "'>Delete</a></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>
<?php
include "../../view/__partials/bottommenu.php";
?>
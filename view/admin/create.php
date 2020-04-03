<?php
include "../../view/__partials/topmenu.php";
include "../../src/config/db/Connect.php";

?>
<style>
.remove-field{
    position: absolute;
    margin-top: 10px;
    margin-left: 10px;
    z-index: 2;
}
</style>
<?php
include "../../view/__partials/displaysuccess.php";
include "../../view/__partials/displayerror.php";
?>
<div class="container flex-column align-items-center">
    <div class="row">
        <div class="col-10 col-md-6 mx-auto">
            <form id="catform" action="../../src/controllers/categoryController/" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-form-label" for="category">Category name</label>
                    <input type="text" class="form-control" name="category" id="category" required>
                </div>
                <!-- <div class="form-group">
                    <label class="col-form-label" for="category">Amount</label>
                    <div class="input-group">
                        <div class="input-group-append" id="button-addon4">
                            <button class="btn btn-outline-secondary" type="button" style="background-color: #e9ecef;">₦</button>
                        </div>
                        <input type="numeric" class="form-control" name="amount" id="amount" inputmode="decimal" required>
                    </div>
                </div> -->
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile02" name="image">
                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"><i>PNG images only*</i></label>
                    </div>
                </div>
                <div class="form-row">

                </div>
                <div>Create a subcategory</div>
                <hr>
                <div class="d-flex flex-row justify-content-center mb-3"><button class="btn btn-outline-secondary rounded-0" type="button" style="background-color: #e9ecef;" id="add">Add +</button></div>
                <div class="input-group mb-3" id="wrapper">
                    <input type="text" class="form-control rounded-0" name="1" id="1" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-lg btn-block text-white" name="action" style="background-color: #C2185B;" id="action" value="Create">
                </div>
            </form>
        </div>
    </div>

</div>

<?php
include "../../view/__partials/bottommenu.php";
?>
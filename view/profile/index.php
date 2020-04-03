<?php
if (isset($_GET['profile'])) {
    $profile = base64_decode($_GET['profile']);
    include "../../view/__partials/topmenu.php";
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    $csrf_token = $_SESSION['csrf_token'];

?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#image").change(function() {
                var reader = new FileReader();
                const file = document.querySelector('input[type=file]').files[0];
                reader.onload = function(e) {
                    $('#pix').attr('src', e.target.result);
                };

                reader.onerror = function(e) {
                    console.error("File could not be read! Code " + e.target.error.code);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
    <?php
    include "../../view/__partials/displaysuccess.php";
    include "../../view/__partials/displayerror.php";
    ?>
    <div class="container">
        <div class="row w-100 h-100 d-flex justify-content-center">
            <div class="d-flex flex-column justify-content-center align-items-end">
                <form action="../../index.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <img id="pix" src="../../assets/images/profileimg/<?php echo $imagefile; ?>" width="200px" style="position: relative; margin:20px;border-radius: 50%;">
                        <label for="image" class="">
                            <input type="file" name="image" id="image" style="display: none;">
                            <img id="photo" src="../../assets/images/camera.png" width="90px" style="position: absolute; margin:20px; left: 100px; top: 165px;opacity:0.6;">
                        </label>

                    </div>
                    <div class="form-group">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <label class="col-form-label" for="firstname">Firstname</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="lastname">Lastname</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="username">Username</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="text" name="username" id="username" value="<?php echo $username; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="phone">Phone number</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="tel" pattern="[0-9]{4}[0-9]{3}[0-9]{4}" name="phone" id="phone" value="<?php echo $phone; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="email">Email</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="email" name="email" id="email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="address_1">Address</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="text" name="address" id="address" value="<?php echo $address; ?>" required>
                    </div>
                    <div class="form-group">
                        <h5>Change Password</h5>
                        <hr />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="old_password">Old Password</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="password" name="old_password" id="old_password">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="new_password">New Password</label>
                        <input class="form-control border-right-0 border-left-0 border-top-0 border-rounded-0 rounded-0 shadow-none gradient" type="password" name="new_password" id="new_password">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-lg text-white font-weight-bolder" style="background-color:#C2185B;" name="action" value="Update Profile">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

<?php
    include "../../view/__partials/bottommenu.php";
}
?>
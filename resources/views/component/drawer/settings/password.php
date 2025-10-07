<?php
$User = new User();
?>
<!-- Make a Report -->
<div class="offcanvas offcanvas-end bg-gray-200"  tabindex="-1" id="settingPasswordDrawer" aria-labelledby="settingPasswordDrawerLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <header class="bg-transparent mb-4">
            <h5 class="offcanvas-title" id="settingPasswordDrawerLabel">Change Password </h5>
            <p>Change your Host Communities password below</p>
        </header>

        <div class="mt-5">
            <form class="form w-100" action="controllers/settings.php" method="post">
                <?= Form::request('change-password') ?>

                <div class="row g-4 mb-5">
                    <!-- Old Password -->
                    <div class="col-12">
                        <label for="old_password" class="form-label">Old Password</label>
                        <div class="position-relative">
                            <img src="assets/icons/onboarding/Password Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <input type="password" id="old_password" name="old_password" class="ps-5 form-control form-control-lg form-control-solid bg-light-primary" placeholder="**********" value="" required="" />
                            <a href="javascript:;" class="toggle-password position-absolute top-50 translate-middle" data-target="old_password" style="right: 18px;"><img src="assets/icons/onboarding/Hide Password.svg" alt="icon" class="img-fluid form-icon"></a>
                        </div>
                    </div>

                    <!-- New Password -->
                    <div class="col-12">
                        <label for="new_password" class="form-label">New Password</label>
                        <div class="position-relative">
                            <img src="assets/icons/onboarding/Password Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <input type="password" id="new_password" name="new_password" class="ps-5 form-control form-control-lg form-control-solid bg-light-primary" placeholder="**********" value="" required="" />
                            <a href="#" class="toggle-password position-absolute top-50 translate-middle" data-target="new_password" style="right: 18px;"><img src="assets/icons/onboarding/Hide Password.svg" alt="icon" class="img-fluid form-icon"></a>
                        </div>
                    </div>

                    <!-- Retype New Password -->
                    <div class="col-12">
                        <label for="confirm_password" class="form-label">Retype New Password</label>
                        <div class="position-relative">
                            <img src="assets/icons/onboarding/Password Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <input type="password" id="confirm_password" name="confirm_password" class="ps-5 form-control form-control-lg form-control-solid bg-light-primary" placeholder="**********" value="" required="" />
                            <a href="#" class="toggle-password position-absolute top-50 translate-middle" data-target="confirm_password" style="right: 18px;"><img src="assets/icons/onboarding/Hide Password.svg" alt="icon" class="img-fluid form-icon"></a>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary w-100">Change Password</button>
            </form>
        </div>
    </div>
</div>
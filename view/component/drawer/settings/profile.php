<?php
$User = new User();
?>
<!-- Make a Report -->
<div class="offcanvas offcanvas-end bg-gray-200"  tabindex="-1" id="settingProfileDrawer" aria-labelledby="settingProfileDrawerLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class=" offcanvas-body">
        <header class="bg-transparent mb-4">
            <h5 class="offcanvas-title" id="settingProfileDrawerLabel">Update Profile</h5>
            <p>Change or make updates to your profile easily.</p>
        </header>

        <div class="mt-5">
            <form action="controllers/settings.php" class="form w-100" method="post" enctype="multipart/form-data">
                <?= Form::request('profile') ?>
                <div class="row g-4">
                    <!-- File Upload -->
                    <div class="col-12">
                        <div class="d-flex gap-3">
                            <img src="<?= $User->data()->image ? "assets/images/profile/" . $User->data()->image  : "assets/icons/dashboard/Profile Avatar.svg"; ?>" alt="Avatar" id="profile-avatar" class="img-fluid icon-xl">
                            <div class="">
                                <label for="file" class="form-label">Profile Picture</label>
                                <input type="file" id="file" name="file" class="form-control form-control-lg form-control-solid bg-light-primary">
                            </div>
                        </div>
                    </div>

                    <!-- First Name -->
                    <div class="col-12">
                        <label for="first_name" class="form-label">First Name</label>

                        <div class="position-relative">
                            <img for="first_name" src="assets/icons/onboarding/Profile Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <input id="first_name" name="first_name" class="form-control form-control-lg form-control-solid bg-light-primary ps-5" placeholder="e.g: Olumide" value="<?= $User->data()->first_name ?>" required="" />
                        </div>
                    </div>

                    <!-- Second Name -->
                    <div class="col-12">
                        <label for="second_name" class="form-label">Second Name</label>
                        <div class="position-relative">
                            <img for="first_name" src="assets/icons/onboarding/Profile Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <input id="second_name" name="second_name" class="form-control form-control-lg form-control-solid bg-light-primary ps-5" placeholder="e.g: Isaac" value="<?= $User->data()->last_name ?>" required="" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="col-12">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="position-relative">
                            <img for="first_name" src="assets/icons/onboarding/Email Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <input type="email" id="email" name="email" class="ps-5 form-control form-control-lg form-control-solid bg-light-primary" placeholder="e.g: olumideisaac@gmail.com" value="<?= $User->data()->email ?>" required="" readonly />
                        </div>
                    </div>

                    <!-- Phone Number -->
                    <div class="col-12">
                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="position-relative">
                            <img for="first_name" src="assets/icons/onboarding/Phone Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <input type="phone" id="phone" name="phone" class="ps-5 form-control form-control-lg form-control-solid bg-light-primary" placeholder="e.g: 08056278365" value="<?= $User->data()->phone ?>" required="" />
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary w-100 mt-5" id="hc_setting_profile_btn">Update Profile</button>
            </form>
        </div>
    </div>
</div>
<?php
$User = new User();
$World = new World();

$profile = $User->getProfile();
$states = $World->getStatesByCountryId(160);
?>

<!-- Make a Report -->
<div class="offcanvas offcanvas-end bg-gray-200" tabindex="-1" id="settingKYCDrawer" aria-labelledby="settingKYCDrawerLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <header class="bg-transparent mb-4">
            <h5 class="offcanvas-title" id="settingKYCDrawerLabel">Update KYC </h5>
            <p>Change or make updates to your profile easily.</p>
        </header>

        <div class="mt-5">
            <form class="form w-100" action="controllers/settings.php" method="post">
                <?= Form::request('kyc') ?>
                <div class="row g-4">
                    <!-- Community -->
                    <div class="col-6">
                        <label for="kyc-community" class="form-label">Community</label>
                        <div class="position-relative">
                            <img src="assets/icons/onboarding/Community Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <input id="kyc-community" name="community" class="ps-5 form-control form-control-lg form-control-solid bg-light-primary" placeholder="" value="<?= $profile->community ?>" required="" />
                        </div>
                    </div>

                    <!-- Position in Community -->
                    <div class="col-6">
                        <label for="community_position" class="form-label">Position in Community</label>
                        <div class="position-relative">
                            <img src="assets/icons/onboarding/Position Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <select id="community_position" name="community_position" placeholder="Select your position..." placeholder-value="" class="form-select form-select-lg form-select-solid bg-light-primary" required="">
                                <option value="Member">Member</option>
                                <option value="Youth Leader">Youth Leader</option>
                                <option value="Women Leader">Women Leader</option>
                                <option value="Traditional Ruler">Traditional Ruler</option>
                                <option value="Community Chairman">Community Chairman</option>
                                <option value="Community Secretary">Community Secretary</option>
                                <option value="Palace Secretary">Palace Secretary</option>
                                <option value="Miner">Miner</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                    <!-- State -->
                    <div class="col-6">
                        <label for="kyc-state" class="form-label">State</label>
                        <div class="position-relative">
                            <img src="assets/icons/onboarding/Location Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <select id="kyc-state" name="state" placeholder="<?= $profile && $profile->state ? $World->getStateName($profile->state) : "Select a state..."; ?>" placeholder-value="<?= $profile->state ?>" class="form-select select2 form-select-lg form-select-solid bg-light-primary world" data-type="state" data-world-target="#kyc-city" data-selected="<?= $profile ? $profile->state : null; ?>" required="">
                                <?php foreach ($states as $k => $v) { ?>
                                    <option value="<?= $v->id ?>" <?= $profile && $profile->state == $v->id ? 'selected'  : null; ?>><?= $v->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- City -->
                    <div class="col-6">
                        <label for="kyc-city" class="form-label">LGA</label>
                        <div class="position-relative">
                            <img src="assets/icons/onboarding/Location Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <select id="kyc-city" name="city" placeholder="<?= $profile && $profile->city ? $World->getCityName($profile->city) : "Select a city..."; ?>" placeholder-value="<?= $profile->state ?>" class="form-select form-select-lg form-select-solid bg-light-primary" placeholder="eg: emem" value="" required="">
                            </select>
                        </div>
                    </div>

                    <!-- Gender -->
                    <div class="col-6">
                        <label for="gender" class="form-label">Gender</label>
                        <div class="position-relative">
                            <img src="assets/icons/onboarding/Gender Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <select id="gender" name="gender" placeholder="<?= $profile && $profile->gender ? $profile->gender : "Select your gender..."; ?>" class="form-select form-select-lg form-select-solid bg-light-primary" placeholder="eg: emem" value="" required="">
                                <option value="Male" <?= $profile->gender == "Male" ? 'selected' : null; ?>>Male</option>
                                <option value="Female" <?= $profile->gender == "Female" ? 'selected' : null; ?>>Female</option>
                            </select>
                        </div>
                    </div>

                    <!-- Age Bracket -->
                    <div class="col-6">
                        <label for="age_bracket" class="form-label">Age Bracket</label>
                        <div class="position-relative">
                            <img src="assets/icons/onboarding/Age Bracket Icon.svg" alt="icon" class="img-fluid form-icon position-absolute top-50 translate-middle">
                            <select id="age_bracket" name="age_bracket" placeholder="Select your age bracket..." placeholder-value="" class="form-select form-select-lg form-select-solid bg-light-primary" required="">
                                <option value="18-25">18-25</option>
                                <option value="25-30">25-30</option>
                                <option value="30-35">30-35</option>
                                <option value="40-45">40-45</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button class="btn w-100 mt-5">Update KYC</button>
            </form>
        </div>
    </div>
</div>
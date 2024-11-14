<?php
$User = new User();
?>
<!-- Make a Report -->
<div class="offcanvas offcanvas-end bg-gray-200"  tabindex="-1" id="settingDeleteDrawer" aria-labelledby="settingDeleteDrawerLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row min-vh-100 align-items-center justify-content-center">
            <div class="col-lg-9">
                <div class="d-flex flex-column align-items-center">
                    <img src="assets/icons/Dashboard/Delete Account.svg" alt="Delete Icon" class="img-fluid mb-4" style="height: 80px;">

                    <h4 class="mb-4 text-center">Are you sure you want to delete your account?</h4>
                    <a href="controllers/settings.php?rq=delete-account" onclick="return confirm('Are you sure you want to delete your account? this process can\'t be reversed!');" class="btn btn-danger mb-5">Yes, Delete</a>

                    <a href="" class="text-reset">No, don't delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
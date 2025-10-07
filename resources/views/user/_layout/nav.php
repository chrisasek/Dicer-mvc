<?php

use App\Support\Alerts;
use App\Models\Business;
use App\Support\Input;
use App\Models\User;


$User = User::me();
$is_loading = !$User->is_onboarded;

$notification_list = null;

Alerts::display();
?>

<main>
	<!-- Sidebar START -->
	<nav class="navbar sidebar navbar-expand-xl navbar-dark bg-white">

		<!-- Navbar brand for xl START -->
		<div class="vstack align-items-cente">
			<a class="navbar-brand text-black" href="<?= APP_URL ?>">
				Tsara
				<!-- <img class="navbar-brand-item" src="< APP_URL ?>assets/logo/logo.jpg" alt="LOGO"> -->
			</a>
		</div>
		<!-- Navbar brand for xl END -->

		<div class="offcanvas offcanvas-start flex-row custom-scrollbar h-100" data-bs-backdrop="true" tabindex="-1" id="offcanvasSidebar">
			<div class="offcanvas-header px-3">
				<h5 class="offcanvas-title" id="offcanvasExampleLabel"><?= APP_NAME ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>


			<div class="offcanvas-body sidebar-content d-flex flex-column bg-white px-0">
				<?php if ($is_loading) { ?>
					<div class="card card-body">
						<p class="card-text placeholder-glow">
							<span class="placeholder col-7"></span>
							<span class="placeholder col-4"></span>
							<span class="placeholder col-4"></span>
							<span class="placeholder col-6"></span>
							<span class="placeholder col-8"></span>
						</p>

						<p class="card-text placeholder-glow">
							<span class="placeholder col-8"></span>
							<span class="placeholder col-6"></span>
							<span class="placeholder col-5"></span>
						</p>
					</div>
				<?php } else { ?>
					<!-- Sidebar menu START -->
					<ul class="navbar-nav flex-column gap-2 pb-4" id="navbar-sidebar">
						<li class="nav-item <?= !Input::get('page') ? 'active' : null; ?>"><a href="<?= APP_URL ?>" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-house"></i> Home</a></li>
						<li class="nav-item <?= Input::active('reports'); ?>"><a href="reports" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-window-split"></i> Reports</a></li>

						<!-- Payment -->
						<li class="nav-item ms-2 mt-3 mb-2 fw-bold fs-12px" style="background-color: white !important;">Payments</li>
						<li class="nav-item <?= Input::active('transactions'); ?>"><a href="transactions" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-window-split"></i> Transactions</a></li>
						<li class="nav-item <?= Input::active('settlements'); ?>"><a href="settlements" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-arrow-down-circle"></i> Settlements</a></li>
						<li class="nav-item <?= Input::active('transfers'); ?>"><a href="transfers" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-arrow-up-circle"></i> Transfers</a></li>
						<li class="nav-item <?= Input::active('refunds'); ?>"><a href="refunds" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-arrow-counterclockwise"></i> Refunds</a></li>
						<li class="nav-item <?= Input::active('disputes'); ?>"><a href="disputes" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-arrow-repeat"></i> Disputes</a></li>

						<!-- Tool -->
						<li class="nav-item ms-2  mt-3 mb-2 fw-bold fs-12px" style="background-color: white !important;">Tools</li>
						<li class="nav-item <?= Input::active('payment-link'); ?>"><a href="payment-link" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-link-45deg"></i> Payment Link</a></li>
						<li class="nav-item <?= Input::active('terminals'); ?>"><a href="terminals" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-phone"></i> POS</a></li>

						<!-- Setting -->
						<li class="nav-item ms-2  mt-3 mb-2 fw-bold fs-12px" style="background-color: white !important;">Settings</li>
						<li class="nav-item <?= Input::active('profile'); ?>"><a href="profile" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-person"></i> Profile</a></li>
						<li class="nav-item <?= Input::active('compliance'); ?>"><a href="compliance" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-person-bounding-box"></i> Compliance</a></li>
						<li class="nav-item <?= Input::active('accounts'); ?>"><a href="accounts" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-wallet2"></i> Accounts</a></li>
						<li class="nav-item <?= Input::active('preferences'); ?>"><a href="preferences" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-arrows-expand"></i> Preferences</a></li>
						<li class="nav-item <?= Input::active('api'); ?>"><a href="api" class="nav-link d-flex align-items-center gap-2"><i class="bi bi-app"></i> API</a></li>
					</ul>
				<?php } ?>
			</div>
		</div>
	</nav>
	<!-- Sidebar END -->

	<!-- Page content START -->
	<div class="page-content">

		<!-- Top bar START -->
		<nav class="bg-white top-bar navbar-light border-bottom py-0 py-xl-3 px-3">
			<div class="container-fluid p-0">
				<div class="d-flex align-items-center w-100">
					<!-- Logo START -->
					<div class="d-flex align-items-center d-xl-none">
						<a class="navbar-brand" href="<?= APP_URL ?>">
							<img class="light-mode-item navbar-brand-item h-30px" src="<?= APP_URL ?>assets/logo/logo.jpg" alt="LOGO">
							<img class="dark-mode-item navbar-brand-item h-30px" src="<?= APP_URL ?>assets/logo/logo.jpg" alt="LOGO">
						</a>
					</div>


					<!-- Top bar left -->
					<div class="navbar-expand-lg ms-auto ms-xl-0">
						<div class="d-none d-xl-bloc">
							<form action="business/select-business" class="position-relative">
								<select name="business" class="form-select select-business">
									<?php if ($business_list) { ?>
										<?php foreach ($business_list as $business) { ?>
											<option value="<?= $business->id ?>"><?= $business->name ?></option>
										<?php } ?>
									<?php } ?>
								</select>
							</form>
						</div>
					</div>
					<!-- Top bar left END -->

					<!-- Top bar right START -->
					<div class="ms-xl-auto">
						<ul class="navbar-nav flex-row align-items-center gap-3 gap-lg-4">

							<div class="nav-item w-100">
								<form action="api/live-toggle" class="position-relative">
									<div class="form-check form-switch form-check-md">
										<input class="form-check-input" type="checkbox" role="switch" id="live">
										<label class="form-check-label fs-12px" for="live">LIVE</label>
									</div>
								</form>
							</div>

							<!-- Notification dropdown START -->
							<li class="nav-item ms-2 ms-md-3 dropdown">
								<!-- Notification button -->
								<a class="mb-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
									<i class="bi bi-bell fs-5"></i>
								</a>

								<?php if ($notification_list) { ?>
									<!-- Notification dote -->
									<span class="notif-badge animation-blink"></span>
								<?php } ?>

								<!-- Notification dropdown menu START -->
								<div class="dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0 shadow-lg border-0">
									<div class="card bg-transparent">
										<div class="card-header bg-transparent border-bottom py-4 d-flex justify-content-between align-items-center">
											<h6 class="m-0">
												Notifications
												<?php if ($notification_list) { ?>
													<span class="badge bg-danger bg-opacity-10 text-danger ms-2"><?= count($notification_list) ?> new</span>
												<?php } ?>
											</h6>
											<!-- <a class="small" href="#">Clear all</a> -->
										</div>
										<div class="card-body p-0">
											<ul class="list-group list-unstyled list-group-flush">
												<?php if ($notification_list) { ?>
													<?php foreach ($notification_list as $notification) { ?>
														<!-- Notif item -->
														<li>
															<a href="notifications/<?= $notification->id ?>" class="list-group-item-action border-0 border-bottom d-flex p-3">
																<div class="me-3">
																	<div class="avatar avatar-md">
																		<img class="avatar-img rounded-circle" src="assets/icons/dashboard/Profile Avatar.svg" alt="avatar">
																	</div>
																</div>
																<div>
																	<h6 class="mb-1"><?= $notification->subject ?></h6>
																	<p class="small text-body m-0 text-truncate"><?= $notification->message ?></p>
																	<u class="small">View detail</u>
																</div>
															</a>
														</li>
													<?php }  ?>
												<?php } else { ?>
													<li>
														<a href="javascript:;" class="list-group-item-action border-0 border-bottom text-decoration-none d-flex p-3">
															<div>
																<h6 class="text-body  m-0">No notification!</h6>
																<u class="small">You'll be notified when there is a new notification.</u>
															</div>
														</a>
													</li>
												<?php } ?>
											</ul>
										</div>
										<?php if ($notification_list) { ?>
											<!-- Button -->
											<div class="card-footer bg-transparent border-0 py-3 text-center position-relative">
												<a href="notifications" class="stretched-link small">See all incoming activity</a>
											</div>
										<?php } ?>
									</div>
								</div>
								<!-- Notification dropdown menu END -->
							</li>
							<!-- Notification dropdown END -->

							<!-- Profile dropdown START -->
							<li class="nav-item dropdown">
								<!-- Avatar -->
								<a class="p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="bi bi-person-circle fs-5"></i>
								</a>

								<!-- Profile dropdown START -->
								<ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
									<!-- Profile info -->
									<li class="px-3">
										<div>
											<a class="h6 mt-2 mt-sm-0" href="#"><?= User::data('name'); ?></a>
											<p class="small m-0"><?= User::data('email'); ?></p>
										</div>
										<hr>
									</li>

									<!-- Links -->
									<li><a class="dropdown-item fw-normal" href="profile"><i class="bi bi-person me-2"></i> Profile</a></li>
									<li><a class="dropdown-item fw-normal" href="business"><i class="bi bi-briefcase me-2"></i> Businesses</a></li>
									<li><a class="dropdown-item fw-normal" href="preference"><i class="bi bi-person-check me-2"></i> Preference</a></li>
									<li><a class="dropdown-item fw-normal" href="javascript:;"><i class="bi bi-chat-right-dots me-2"></i> Support</a></li>
									<hr>
									<li><a class="dropdown-item bg-danger-soft-hover" href="auth/logout"><i class="bi bi-power fa-fw me-2"></i>Sign Out</a></li>

								</ul>
								<!-- Profile dropdown END -->
							</li>
							<!-- Profile dropdown END -->
						</ul>
					</div>
					<!-- Top bar right END -->

					<!-- Toggler for sidebar START -->
					<div class="navbar-expand-xl sidebar-offcanvas-menu ms-3">
						<button class="navbar-toggler p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-expanded="false" aria-label="Toggle navigation" data-bs-auto-close="outside">
							<i class="bi bi-list fa-fw h5 lh-0 mb-0 rtl-flip" data-bs-target="#offcanvasMenu"> </i>
						</button>
					</div>
				</div>
			</div>
		</nav>
		<!-- Top bar END -->

		<!-- Page main content START -->
		<div class="page-content-wrapper">
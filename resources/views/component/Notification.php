<?php
$User = new User();

$data = $data && is_array($data) && isset($data['data']) ? $data['data'] : $data;
?>

<?php if ($data) {
    $status_color = $data->status ? 'bg-danger text-danger' :  'bg-success text-success';
?>
    <div class="card">
        <div class="card-body p-3 p-lg-4">
            <!-- Status -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="badge <?= $status_color ?> bg-opacity-10  fw-bold px-4 py-2 rounded-full text-sm"><?= $data->status ? 'Unread' : 'Read' ?></span>

                <div class="dropdown">
                    <a class="mb-0 text-muted" href="#" role="button" data-bs-toggle="dropdown" data-bs-offset="-30,10" aria-expanded="false">
                        <i class="fa fa-ellipsis-v fa-fw"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-contain py-1">
                        <li><a class="dropdown-item fs-12px fw-bold" href="notifications/<?= $data->id ?>">View</a></li>
                        <li><a class="dropdown-item fs-12px fw-bold text-danger" href="controllers/notifications.php?rq=delete&id=<?= $data->id ?>">Delete</a></li>
                    </ul>
                </div>
            </div>

            <!-- Content -->
            <div class="">
                <h6 class="text-lg"><?= $data->subject ?></h6>
                <p class="text-lg text-truncate"><?= $data->message ?></p>
            </div>

            <hr class="my-3">

            <!-- Footer -->
            <div class="d-flex align-items-center justify-content-between">
                <span class="text-gray text-lg"><?= date('dS F, Y', strtotime($data->created_at)) ?></span>
                <span class="d-flex align-items-center fw-bold text-lg"><a href="notifications/<?= $data->id ?>"><i class="fa fa-eye text-danger"></i></a></span>
            </div>
        </div>
    </div>
<?php } ?>
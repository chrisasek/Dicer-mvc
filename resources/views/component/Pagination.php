<?php
$paginate = $data ? $data['paginate'] : null;
$per_page = $data ? $data['per_page'] : null;
$page = $data && isset($data['page']) ? $data['page'] : $_SERVER['REQUEST_URI'];
$current = $data ? $data['current'] : null;
$total = $data ? $data['total'] : null;
$page_link = array_chunk(range(1, $total), 4)[floor($current / 4)];

$total_of = $per_page < $total ? ($current * $per_page) . ' of ' . $total : null;

$gets = $qspart = null;

if ($page) {
    $query = explode('&', $_SERVER['QUERY_STRING']);

    $pg_search = array_search("page=" . $page, $query);
    if (isset($pg_search)) unset($query[$pg_search]);

    $p_search = array_search("p=$current", $query);
    if (isset($p_search)) unset($query[$p_search]);

    $page = $page . '?' . implode('&', $query);
}

$prev_page_url = $page . '&p=' . $paginate->previous_page();
$next_page_url = $page . '&p=' . $paginate->next_page();
?>

<?php if ($paginate) { ?>
    <!--pagination start-->
    <div class="mt-5">
        <nav>
            <ul class="pagination pagination-sm rounded mb-0">
                <?php if ($paginate->has_previous_page()) { ?>
                    <li class="page-item">
                        <a href="<?= $prev_page_url; ?>" class="page-link" aria-label="Previous">Prev</a>
                    </li>
                <?php } ?>

                <?php if ($total_of) { ?>
                    <li class="page-item disabled">
                        <span class="page-link"><?= ($total_of); ?></span>
                    </li>
                <?php } ?>
                <?php if ($paginate->has_next_page()) { ?>
                    <li class="page-item">
                        <a href="<?= $next_page_url; ?>" class="page-link" aria-label="Next">Next</a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <!--pagination end-->
<?php } ?>
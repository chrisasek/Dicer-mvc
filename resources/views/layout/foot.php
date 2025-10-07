<?php

use App\Support\Alerts;
use App\Support\Component;
use App\Support\Loader;

Component::render('Drawer');
?>

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.14.3/cdn.min.js" integrity="sha512-ZVf/lRjmZflPdIT4hvK4g1T6WupvrXtoTAM86z3S+5En7AhDVhBaxLRF4blGftmzhhPigloA8EP8OTO/Aabmng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="assets/vendors/jquery-3.3.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.min.js" integrity="sha512-TiQST7x/0aMjgVTcep29gi+q5Lk5gVTUPE9XgN0g96rwtjEjLpod4mlBRKWHeBcvGBAEvJBmfDqh2hfMMmg+5A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Vendors -->
<script src="assets/vendors/purecounterjs/dist/purecounter_vanilla.js"></script>
<script src="assets/vendors/apexcharts/js/apexcharts.min.js"></script>
<script src="assets/vendors/choices/js/choices.min.js"></script>
<script src="assets/vendors/glightbox/js/glightbox.js"></script>
<script src="assets/vendors/quill/js/quill.min.js"></script>
<script src="assets/vendors/stepper/js/bs-stepper.min.js"></script>
<script src="assets/vendors/overlay-scrollbar/js/OverlayScrollbars.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js" integrity="sha512-eiqtDDb4GUVCSqOSOTz/s/eiU4B31GrdSb17aPAA4Lv/Cjc8o+hnDvuNkgXhSI5yHuDvYkuojMaQmrB5JB31XQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- Template Functions -->
<script src="assets/js/functions.js"></script>
<script src="assets/js/site.js"></script>

<?php

use App\Models\User;

if (User::isLoggedIn()) {
  Loader::script('assets/js/transfer.js');
?>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Fancy File Upload -->
  <!-- <script type="text/javascript" src="assets/vendors/fancy-file-uploader/jquery.ui.widget.js"></script> -->
  <!-- <script type="text/javascript" src="assets/vendors/fancy-file-uploader/jquery.fileupload.js"></script> -->
  <!-- <script type="text/javascript" src="assets/vendors/fancy-file-uploader/jquery.iframe-transport.js"></script> -->
  <!-- <script type="text/javascript" src="assets/vendors/fancy-file-uploader/jquery.fancy-fileupload.js"></script> -->

  <!-- Assessment -->
  <!-- <script src="assets/js/assessment/data-protection-audit.js"></script> -->

  <!-- Drawers -->
  <!-- <script src="assets/js/setting/profile.js"></script> -->


  <!-- Stacktable -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/stacktable.js/1.0.2/stacktable.min.js" integrity="sha512-mGJk0Hre70RAZLlfoedoIn70rnVXFXDQIGjhWZ5yMU4kxDqPZhx64MyeXj8oJKdFEGTlZcAx3dTqsa9G0nIbIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/stacktable.js/1.0.2/stacktable.min.css" integrity="sha512-T7fU232kUy3bBnRNF7F4UAGAgC+pu0erJ63k1R6XYmwKclMUYhDQ9tNBnSHkegu70bq8gm+82SF6qLsdigD4/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

  <!-- Datatable -->
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.3.2/js/dataTables.fixedHeader.min.js"></script>

  <!-- <script src="assets/js/demo/moment.js"></script>
  <script src="assets/js/demo/datetime-moment.js"></script> -->
  <!-- <script src="assets/js/demo/datatables.js"></script> -->

  <!-- <script src="assets/vendors/summernote/summernote-lite.min.js"></script>
  <script src="assets/vendors/summernote/plugin/summernote-case-converter.js"></script>
  <script src="assets/vendors/summernote/plugin/summernote-cleaner.js"></script>
  <script src="assets/vendors/summernote/plugin/summernote-ext-addclass.js"></script>
  <script src="assets/js/oniontabs-editor.js"></script> -->

  <!-- <script src="assets/vendors/slugit/jquery.slugit.min.js"></script> -->
  <script src="assets/js/components.bundle.js"></script>
  <script src="assets/js/dashboard.js"></script>

<?php } ?>

</body>

</html>
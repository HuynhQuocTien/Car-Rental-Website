  <script src="<?= BASE_URL ?>/public/js/plugins/jquery-validation/jquery.validate.js"></script>
  <script src="<?= BASE_URL ?>/public/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="<?= BASE_URL ?>/public/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
  <script src="<?= BASE_URL ?>/public/js/plugins/slick-carousel/slick.min.js"></script>
  <script src="<?= BASE_URL ?>/public/js/plugins/select2/js/select2.full.min.js"></script>
  <script src="<?= BASE_URL ?>/public/js/plugins/datatables/jquery.dataTables.min.js"></script>
  
  <script src="<?= BASE_URL ?>/public/js/plugins/bootstrap-notify/bootstrap-notify.js"></script>
  <script src="<?= BASE_URL ?>/public/js/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src=" <?= BASE_URL ?>/public/js/pages/pagination.js"></script>
  <!-- <script src="../public/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script> -->

  <!-- Page JS Helpers (BS Datepicker plugin) -->
  <script>Dashmix.helpersOnLoad(['jq-datepicker', 'jq-rangeslider', 'jq-slick']);</script>
  
  <script src="<?= BASE_URL ?>/public/js/pages/user/auth.js"></script>
  <!-- <script src="<?= BASE_URL ?>/public/js/pages/user/updateCustomer.js"></script> -->
<?php
    if(isset($data["Script"])) {
        echo '<script src="' .BASE_URL.'/public/js/pages/user/'.$data["Script"].'.js"></script>';
    }
?>
  
 

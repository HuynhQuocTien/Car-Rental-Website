<script src="<?= BASE_URL ?>/public/js/dashmix.app.min.js"></script>
<script src="<?= BASE_URL ?>/public/js/plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?= BASE_URL ?>/public/js/plugins/bootstrap-notify/bootstrap-notify.js"></script>
<script src="<?= BASE_URL ?>/public/js/plugins/select2/js/select2.min.js"></script>
<script src="<?= BASE_URL ?>/public/js/plugins/ckeditor5-classic/build/ckeditor.js"></script>
<script src="<?= BASE_URL ?>/public/js/plugins/chart.js/chart.umd.js"></script>
<script src=" <?= BASE_URL ?>/public/js/pages/pagination.js"></script>
<?php
    if(isset($data["Script"])) {
        echo '<script src="' .BASE_URL.'/public/js/pages/admin/'.$data["Script"].'.js"></script>';
    }
?>




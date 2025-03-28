<script src="<?= BASE_URL ?>/public/js/dashmix.app.min.js"></script>

<!-- Page JS Plugins -->
<script src="<?= BASE_URL ?>/public/js/plugins/chart.js/chart.umd.js"></script>

<?php
    if(isset($data["Script"])) {
        echo '<script src="' .BASE_URL.'/public/js/pages/admin/'.$data["Script"].'.js"></script>';
    }
?>




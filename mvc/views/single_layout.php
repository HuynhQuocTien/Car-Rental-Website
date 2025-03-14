<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Website</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <?php
    // Check for error type
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error == '404') {
            include '404.php';
        } elseif ($error == '403') {
            include '403.php';
        } else {
            echo '<h1>Unknown Error</h1>';
        }
    } else {
        echo '<h1>Welcome to Car Rental Website single layout</h1>';
    }
    ?>
</body>
</html>
<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';

require_admin();

$config = require __DIR__ . '/../config/config.php';

$logFile = $config['log']['path'];
$totalHumans = 0;

if (file_exists($logFile)) {
    $totalHumans = count(file($logFile, FILE_IGNORE_NEW_LINES));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Human Analytics – Dashboard</title>
    <link rel="stylesheet" href="/human-analytics/admin/assets/css/admin.css">
</head>
<body>

<header>
    <h1>Human Analytics</h1>
    <a href="/human-analytics/admin/logout.php">Logout</a>
</header>

<section>
    <h2>Verified Humans</h2>
    <p class="metric"><?= $totalHumans ?></p>
</section>

<section>
    <a href="/human-analytics/admin/stats.php">View Detailed Stats →</a>
</section>

</body>
</html>

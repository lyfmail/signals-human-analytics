<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';

require_admin();

$config = require __DIR__ . '/../config/config.php';
$logFile = $config['log']['path'];

$daily = [];

if (file_exists($logFile)) {
    foreach (file($logFile, FILE_IGNORE_NEW_LINES) as $line) {
        $entry = json_decode($line, true);
        if (!isset($entry['timestamp'])) continue;

        $day = substr($entry['timestamp'], 0, 10);
        $daily[$day] = ($daily[$day] ?? 0) + 1;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Human Analytics – Stats</title>
    <link rel="stylesheet" href="/human-analytics/admin/assets/css/admin.css">
</head>
<body>

<h1>Daily Human Visits</h1>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Humans</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($daily as $date => $count): ?>
        <tr>
            <td><?= escape($date) ?></td>
            <td><?= (int)$count ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p><a href="/human-analytics/admin/dashboard.php">← Back to Dashboard</a></p>

</body>
</html>

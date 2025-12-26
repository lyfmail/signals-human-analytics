<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';

if (is_admin_logged_in()) {
    redirect('/human-analytics/admin/dashboard.php');
}

$error = '';

if (is_post()) {
    if (!csrf_verify()) {
        $error = 'Invalid session token.';
    } else {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (admin_login($username, $password)) {
            redirect('/human-analytics/admin/dashboard.php');
        } else {
            $error = 'Invalid credentials.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Human Analytics – Admin Login</title>
    <link rel="stylesheet" href="/human-analytics/admin/assets/css/admin.css">
</head>
<body>

<h1>Admin Login</h1>

<?php if ($error): ?>
<p class="error"><?= escape($error) ?></p>
<?php endif; ?>

<form method="post">
    <?= csrf_field() ?>
    <label>
        Username<br>
        <input type="text" name="username" required>
    </label><br><br>

    <label>
        Password<br>
        <input type="password" name="password" required>
    </label><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>

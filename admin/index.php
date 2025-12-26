<?php
/**
 * Admin index bootstrap
 * Redirects to dashboard if logged in,
 * otherwise sends to login page.
 */

require_once __DIR__ . '/../includes/auth.php';

if (is_admin_logged_in()) {
    header('Location: dashboard.php');
    exit;
}

header('Location: login.php');
exit;

<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';

if (is_logged_in()) {
    redirect_to_role_dashboard(get_current_user_role());
} else {
    header("Location: " . BASE_URL . "login.php");
    exit();
}
?>

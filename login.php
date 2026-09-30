<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

if (is_logged_in()) {
    redirect_to_role_dashboard(get_current_user_role());
}

$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = sanitize($_POST['role'] ?? 'admin');

    if (empty($username) || empty($password)) {
        $error_msg = 'Please fill in both Username and Password.';
    } else {
        if (login_user($username, $password, $role)) {
            redirect_to_role_dashboard($role);
        } else {
            $error_msg = 'Invalid login credentials or selected role. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo SITE_NAME; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
</head>
<body class="login-body">

    <div class="login-card">
        <div class="login-header">
            <i class="fa-solid fa-graduation-cap college-logo-icon"></i>
            <h2><?php echo SITE_SHORT; ?></h2>
            <p>Enterprise Resource Planning Portal</p>
        </div>

        <div class="login-body-content">
            <?php display_flash_message(); ?>

            <?php if (!empty($error_msg)): ?>
                <div class="alert alert-danger alert-dismissible fade show small py-2" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-1"></i><?php echo $error_msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <!-- Role Selector -->
                <label class="form-label fw-bold small text-secondary">SELECT PORTAL / ROLE</label>
                <div class="role-selector-group">
                    <div class="role-radio-btn">
                        <input type="radio" name="role" id="role_admin" value="admin" checked>
                        <label for="role_admin"><i class="fa-solid fa-user-shield me-1"></i>Admin</label>
                    </div>
                    <div class="role-radio-btn">
                        <input type="radio" name="role" id="role_staff" value="staff">
                        <label for="role_staff"><i class="fa-solid fa-chalkboard-user me-1"></i>Staff</label>
                    </div>
                    <div class="role-radio-btn">
                        <input type="radio" name="role" id="role_student" value="student">
                        <label for="role_student"><i class="fa-solid fa-user-graduate me-1"></i>Student</label>
                    </div>
                </div>

                <!-- Username / ID -->
                <div class="mb-3">
                    <label for="username" class="form-label fw-bold small text-secondary">USERNAME / ID / REG NO</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fa-regular fa-user text-muted"></i></span>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter username or Reg No" required autofocus>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold small text-secondary">PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fa-solid fa-lock text-muted"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                    </div>
                </div>

                <!-- Remember me & Forgot password -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label small text-muted" for="rememberMe">Remember me</label>
                    </div>
                    <a href="#" class="small text-decoration-none text-primary" onclick="alert('Please contact the ERP System Administrator or IT Helpdesk to reset your password.'); return false;">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-login w-100">
                    <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In to Portal
                </button>
            </form>

            <!-- Demo Credentials Box -->
            <div class="demo-credentials-box">
                <div class="fw-bold text-dark mb-1"><i class="fa-solid fa-key me-1 text-warning"></i> Demo Login Credentials:</div>
                <div class="d-flex justify-content-between text-muted border-bottom py-1">
                    <span>Admin:</span> <code>admin</code> / <code>admin123</code>
                </div>
                <div class="d-flex justify-content-between text-muted border-bottom py-1">
                    <span>Staff:</span> <code>staff01</code> / <code>staff123</code>
                </div>
                <div class="d-flex justify-content-between text-muted py-1">
                    <span>Student:</span> <code>student01</code> / <code>student123</code>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

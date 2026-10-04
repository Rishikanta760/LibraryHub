<?php
include 'config.php';
if (!empty($_SESSION['admin'])) { header('Location: dashboard.php'); exit; }
if (!empty($_SESSION['student'])) { header('Location: studentdashboard.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? ''); $pass = $_POST['password'] ?? ''; $role = $_POST['role'] ?? 'student';
    $table = $role === 'admin' ? 'login' : 'students';
    $stmt = mysqli_prepare($conn, "SELECT username FROM $table WHERE username=? AND password=? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 'ss', $user, $pass); mysqli_stmt_execute($stmt); $found = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($found)) { $_SESSION[$role === 'admin' ? 'admin' : 'student'] = $user; header('Location: ' . ($role === 'admin' ? 'dashboard.php' : 'studentdashboard.php')); exit; }
    $error = 'We could not verify those credentials. Please try again.';
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>LibraryHub | Sign in</title><link rel="stylesheet" href="assets/style.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"></head>
<body><main class="auth"><section class="auth-side"><div class="brand"><span class="brand-mark"><i class="fa-solid fa-book-open"></i></span>LibraryHub</div><div><p class="eyebrow" style="color:#bdb5ff">Your reading space, reimagined</p><h1>Every great story starts with a simple search.</h1><p>Discover, manage and keep track of your library collection from one calm, organized place.</p></div><small>© <?php echo date('Y'); ?> LibraryHub</small></section><section class="auth-form"><div class="login-card"><p class="eyebrow">Welcome back</p><h1 class="page-title">Sign in to your library</h1><div class="tabs"><button class="tab active" data-tab="admin">Administrator</button><button class="tab" data-tab="student">Student</button></div><?php if($error): ?><div class="notice error"><?php echo e($error); ?></div><?php endif; ?><form method="post" class="login-form active" data-form="admin"><input type="hidden" name="role" value="admin"><label>Admin username</label><input name="username" required autofocus placeholder="Enter your username"><label>Password</label><input type="password" name="password" required placeholder="Enter your password"><button class="btn" style="width:100%;margin-top:24px">Sign in <i class="fa-solid fa-arrow-right"></i></button></form><form method="post" class="login-form" data-form="student"><input type="hidden" name="role" value="student"><label>Student username</label><input name="username" required placeholder="Enter your username"><label>Password</label><input type="password" name="password" required placeholder="Enter your password"><button class="btn" style="width:100%;margin-top:24px">Sign in <i class="fa-solid fa-arrow-right"></i></button></form><p class="auth-note">New to the library? <a href="register.php">Create a student account</a></p></div></section></main><script src="assets/app.js"></script></body></html>

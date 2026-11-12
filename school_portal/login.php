<?php
session_start();
require_once 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT id, username, password, role FROM users WHERE username = :username LIMIT 1');
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header('Location: index.php');
        } else {
            header('Location: student.php');
        }
        exit;
    }

    $error = 'Invalid username or password. Please try again.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in | WE Campus</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">
<?php include 'nav.php'; ?>
<main class="auth-layout login-layout">
    <section class="auth-intro">
        <span class="eyebrow">YOUR CAMPUS, CONNECTED</span>
        <h1>Good to have<br><span>you back.</span></h1>
        <p>Log in securely and continue right where you left off.</p>
        <div class="intro-note"><span class="note-icon">✦</span> Learn. Grow. Make it happen.</div>
    </section>

    <section class="form-card">
        <div class="card-heading">
            <span class="mini-label">WELCOME BACK</span>
            <h2>Log in</h2>
            <p>Use your school portal account details.</p>
        </div>

        <?php if ($error !== ''): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php" class="form-stack">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" placeholder="Enter your username" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Enter your password" required>

            <button class="button button-primary" type="submit">Log in to portal <span>→</span></button>
        </form>
        <p class="form-footer">New around here? <a href="register.php">Create an account</a></p>
    </section>
</main>
</body>
</html>

<?php
session_start();
require_once 'config.php';

$message = '';
$messageType = 'error';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $plainPassword = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'student';

    if ($username === '' || strlen($username) > 50) {
        $message = 'Please enter a username (up to 50 characters).';
    } elseif (strlen($plainPassword) < 8) {
        $message = 'Choose a password with at least 8 characters.';
    } elseif (!in_array($role, ['student', 'admin'], true)) {
        $message = 'Please choose a valid account type.';
    } else {
        $passwordHash = password_hash($plainPassword, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare(
                'INSERT INTO users (username, password, role) VALUES (:username, :password, :role)'
            );
            $stmt->execute([
                ':username' => $username,
                ':password' => $passwordHash,
                ':role' => $role,
            ]);
            $message = 'Your account has been created. You can log in now.';
            $messageType = 'success';
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $message = 'That username is already taken. Try another one.';
            } else {
                error_log($e->getMessage());
                $message = 'Something went wrong. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account | WE Campus</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">
<?php include 'nav.php'; ?>
<main class="auth-layout">
    <section class="auth-intro">
        <span class="eyebrow">WELCOME TO WE CAMPUS</span>
        <h1>Your next chapter<br><span>starts here.</span></h1>
        <p>Create your account to access the school portal, resources and student services.</p>
        <div class="intro-note"><span class="note-icon">✦</span> One portal. A smoother school day.</div>
    </section>

    <section class="form-card">
        <div class="card-heading">
            <span class="mini-label">GET STARTED</span>
            <h2>Create account</h2>
            <p>Enter your details below to join the portal.</p>
        </div>

        <?php if ($message !== ''): ?>
            <div class="alert <?= $messageType === 'success' ? 'alert-success' : 'alert-error' ?>">
                <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
                <?php if ($messageType === 'success'): ?>
                    <a href="login.php">Go to login →</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php" class="form-stack">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" maxlength="50" placeholder="e.g. karen_dev" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" minlength="8" placeholder="At least 8 characters" required>

            <label for="role">Account type</label>
            <select id="role" name="role" required>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>

            <button class="button button-primary" type="submit">Create my account <span>→</span></button>
        </form>
        <p class="form-footer">Already have an account? <a href="login.php">Log in</a></p>
    </section>
</main>
</body>
</html>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="topbar">
    <div class="container nav-inner">
        <a class="brand" href="<?= isset($_SESSION['role']) && $_SESSION['role'] === 'admin' ? 'index.php' : 'student.php' ?>">
            <span class="brand-mark">W</span>
            <span>WE <strong>Campus</strong></span>
        </a>

        <nav class="nav-links">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="welcome">Hello, <?= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a href="index.php">Dashboard</a>
                <?php else: ?>
                    <a href="student.php">My portal</a>
                <?php endif; ?>
                <a class="nav-logout" href="logout.php">Log out</a>
            <?php else: ?>
                <a href="login.php">Log in</a>
                <a class="nav-cta" href="register.php">Create account</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<?php
require_once 'auth_check.php';

if (($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: student.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard | WE Campus</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'nav.php'; ?>
<main class="dashboard container">
    <div class="page-top">
        <div>
            <span class="eyebrow dark-eyebrow">ADMINISTRATION</span>
            <h1>Admin dashboard</h1>
            <p>Welcome back, <?= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') ?>. Your portal is ready.</p>
        </div>
        <span class="role-chip">● ADMIN ACCESS</span>
    </div>

    <section class="welcome-panel">
        <div>
            <span class="mini-label">SCHOOL MANAGEMENT</span>
            <h2>Everything starts<br>with a good plan.</h2>
            <p>This protected page is for administrators only.</p>
        </div>
        <div class="panel-art" aria-hidden="true">W<span>+</span></div>
    </section>

    <section class="dashboard-grid">
        <article class="info-card">
            <span class="info-icon">01</span>
            <h3>Manage students</h3>
            <p>Connect this area to your Unit 19 student add, view and delete features.</p>
            <span class="small-tag">ADMIN TOOL</span>
        </article>
        <article class="info-card">
            <span class="info-icon">02</span>
            <h3>Review records</h3>
            <p>Keep school information organized and accessible from one place.</p>
            <span class="small-tag">RECORDS</span>
        </article>
        <article class="info-card">
            <span class="info-icon">03</span>
            <h3>Account security</h3>
            <p>Only signed-in users with the admin role can open this dashboard.</p>
            <span class="small-tag">PROTECTED</span>
        </article>
    </section>
</main>
</body>
</html>

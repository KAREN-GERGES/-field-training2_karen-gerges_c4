<?php
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student portal | WE Campus</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'nav.php'; ?>
<main class="dashboard container">
    <div class="page-top">
        <div>
            <span class="eyebrow dark-eyebrow">STUDENT SPACE</span>
            <h1>Your student portal</h1>
            <p>Hi <?= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') ?>, welcome to your space.</p>
        </div>
        <span class="role-chip student-chip">● STUDENT ACCESS</span>
    </div>

    <section class="welcome-panel student-panel">
        <div>
            <span class="mini-label">YOUR LEARNING JOURNEY</span>
            <h2>Small steps.<br>Big achievements.</h2>
            <p>Your account is active and your student area is protected.</p>
        </div>
        <div class="panel-art" aria-hidden="true">✦</div>
    </section>

    <section class="info-card student-message">
        <span class="small-tag">PORTAL STATUS</span>
        <h3>You are successfully logged in.</h3>
        <p>This is the student landing page. You can add the result-search form and results from your Unit 19 project here.</p>
    </section>
</main>
</body>
</html>

<?php
//include './process/auth.php'; // Keep your session/auth
//require "./tools/db.php";

$success = "";
$error = "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feelingradation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="page-wrapper">

    <header>
        <h1>Feelingradation</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="#">Contact</a>
            <a href="./process/logout.php">Log Out</a>
        </nav>
    </header>

    <main>
        <div class="home-card">
            <h2>Welcome</h2>
            <p>Let me know what you're feeling right now.</p>

            <!-- Form with ID for JS -->
            <form id="aiForm" class="ai-form">
                <input type="text" name="input" id="title" placeholder="Subject" required>
                <textarea name="message" id="message" placeholder="Your message..." required></textarea>
                <button type="submit">Submit</button>
            </form>

            <p style="color:lime;" id="success"><?php echo $success; ?></p>
            <p style="color:red;" id="error"><?php echo $error; ?></p>

            <h3>Hi, Mei here.</h3>
            <textarea class="aiResponse" id="aiResponse" readonly></textarea>
        </div>
    </main>

    <footer>
        © <?php echo date("Y"); ?> Feelingradation. All rights reserved.
    </footer>

</div>

<script src="ai.js"></script>
</body>
</html>

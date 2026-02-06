<?php
//include './process/auth.php'; // Keep session/auth
?>

<!DOCTYPE html>
<html>
<head>
    <title>About - Feelingradation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="page-wrapper">

    <!-- Header -->
    <header>
        <h1>Feelingradation</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="#">Contact</a>
            <a href="./process/logout.php">Log Out</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <div class="home-card">
            <h2>About Feelingradation</h2>
            <p>
                Feelingradation is a simple, web-based platform designed for anonymous venting. 
                Sometimes life can be overwhelming, and you just need to express your thoughts, 
                emotions, or frustrations without judgment. 
            </p>
            <p>
                On Feelingradation, you can freely share your feelings, whether it's a small stress, 
                a personal achievement, or something weighing on your mind. Our AI assistant, 
                Mei, is here to listen and respond with understanding and supportive insights, 
                helping you process your thoughts in a safe, anonymous space.
            </p>
            <p>
                Remember, it's important to express yourself, and sometimes a few words on a screen 
                can lighten the load.
            </p>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        © <?php echo date("Y"); ?> Feelingradation. All rights reserved.
    </footer>

</div>

</body>
</html>

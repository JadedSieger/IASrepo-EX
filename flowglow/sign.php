<?php
require "tools/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $email = $_POST["email"];
    if (empty($username) || empty($password)) {
        $message = "All fields are required.";
    } else {
        $conn = getDBConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $email);

        if ($stmt->execute()) {
            $message = "Account created successfully!";
        } else {
            $message = "Username already exists.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="auth-container">
    <h2>Sign Up</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="email" name="email" placeholder="Email">
        <button type="submit">Sign Up</button>
    </form>

    <div class="message"><?php echo $message; ?></div>

    <p>
        <a href="login.php">Already have an account?</a>
    </p>
</div>

</body>
</html>

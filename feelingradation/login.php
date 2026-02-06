<?php
session_start();

require "tools/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST["username"]); // can be username or email
    $password = $_POST["password"];

    $conn = getDBConnection();
    $stmt = $conn->prepare(
        "SELECT id, username, password FROM users 
         WHERE username = ? OR email = ?"
    );

    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $username, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "User not found.";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="auth-container">
    <h2>Login</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>

    <div class="message"><?php echo $message; ?></div>

    <p>
        <a href="sign.php">Create an account</a>
    </p>
</div>

</body>
</html>

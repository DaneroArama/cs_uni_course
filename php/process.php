<?php
session_start();
include 'db.php'; // Include your database connection

function authenticate_user($email, $password) {
    global $conn;

    $email = $conn->real_escape_string($email);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the entered password against the hashed password
        if (password_verify($password, $user['password'])) {
            return $user; // Password matches
        }
    }

    return false; // No match
}

function register_user($name, $phone, $email, $password) {
    global $conn;

    $name = $conn->real_escape_string($name);
    $phone = $conn->real_escape_string($phone);
    $email = $conn->real_escape_string($email);

    // Hash the password securely
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$hashed_password')";
    return $conn->query($sql);
}


if (isset($_POST['login'])) {
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];

    $user = authenticate_user($email, $password);
    if ($user) {
        $_SESSION['user'] = $user['name'];
        header("Location: /php/Landing_Page.php");
    } else {
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: /html/404.html");
    }
} elseif (isset($_POST['register'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (register_user($name, $phone, $email, $password)) {
        $_SESSION['user'] = $name;
        header("Location: /php/Landing_Page.php");
    } else {
        $_SESSION['error'] = "Registration failed. Please try again.";
        header("Location: /html/404.html");
    }
}
?>

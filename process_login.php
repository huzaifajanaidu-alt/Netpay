<?php

session_start();

$conn = new mysqli("localhost","root","","netpay");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        // ✅ STORE USER DATA IN SESSION
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['wallet'] = $user['wallet'];

        // ✅ REDIRECT TO DASHBOARD
        header("Location: dashboard.php");
        exit;

    } else {
        echo "Wrong Password";
    }

} else {
    echo "User not found";
}

$conn->close();

?>
<?php

$conn = new mysqli("localhost", "root", "", "netpay");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$wallet = 0;
$status = "active";

$sql = "INSERT INTO users (name, email, phone, password, wallet, status, created_at)
VALUES ('$name','$email','$phone','$password','$wallet','$status',NOW())";

if ($conn->query($sql) === TRUE) {
    echo "Registration Successful!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

?>
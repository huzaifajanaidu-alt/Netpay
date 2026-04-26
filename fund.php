<?php
session_start();

$conn = new mysqli("localhost","root","","netpay");

$user_id = $_SESSION['user_id'];
$amount = $_POST['amount'];

if($amount < 100){
    echo "Minimum funding is ₦100";
    exit;
}

// update wallet
$conn->query("UPDATE users SET wallet = wallet + $amount WHERE id='$user_id'");

// save transaction
$conn->query("INSERT INTO transactions (user_id, service, amount, status, created_at)
VALUES ('$user_id','Wallet Funding','$amount','success',NOW())");

$_SESSION['success'] = "Wallet funded successfully!";
header("Location: dashboard.php");
?>
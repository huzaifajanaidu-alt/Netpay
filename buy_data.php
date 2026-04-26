<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$phone = $_POST['phone'];
$network = $_POST['network'];
$plan = $_POST['plan'];
$user_id = $_SESSION['user_id'];

// MISALI PRICE (zaka iya dauko daga API)
$amount = 500;

// check wallet
$sql = "SELECT wallet FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if($user['wallet'] < $amount){
    $_SESSION['error'] = "insufficeint balance fund your wallet and try again";
    header("Location: data.php");
    exit();
}

// ===== API REQUEST =====
$api_url = VTU_BASE_URL . "/data";

$data = [
    "api_key" => VTU_API_KEY,
    "phone" => $phone,
    "network" => $network,
    "plan" => $plan
];

$curl = curl_init($api_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
curl_close($curl);

$res = json_decode($response, true);

// ===== RESULT =====
if($res['status'] == 'success'){

    $new_wallet = $user['wallet'] - $amount;

    $conn->query("UPDATE users SET wallet='$new_wallet' WHERE id='$user_id'");

    $conn->query("INSERT INTO transactions (user_id, service, amount, status, created_at)
    VALUES ('$user_id','Data','$amount','Success',NOW())");

    $_SESSION['success'] = "Data purchase successful!";
    header("Location: data.php");
    exit();

}else{

    $conn->query("INSERT INTO transactions (user_id, service, amount, status, created_at)
    VALUES ('$user_id','Data','$amount','Failed',NOW())");

    $_SESSION['error'] = "Data purchase failed!";
    header("Location: data.php");
    exit();
}
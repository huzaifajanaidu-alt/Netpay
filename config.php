<?php
//session_start();

// Haɗa Database
$conn = new mysqli("localhost", "root", "", "netpay");
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// VTU API Credentials
define('VTU_API_KEY', 'saka_api_key_dinka_anan');
define('VTU_BASE_URL', 'https://api.alrahuzdata.com.ng'); // URL daga docs
?>
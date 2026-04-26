<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
?> 



<!-- 2 -->
<?php
//session_start();

$conn = new mysqli("localhost","root","","netpay");

$id = $_SESSION['user_id'];

$sql = "SELECT wallet, name FROM users WHERE id='$id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>



<!-- 3 -->
<?php
//session_start();

$conn = new mysqli("localhost","root","","netpay");

$user_id = $_SESSION['user_id'];

// get transactions
$transactions = $conn->query("SELECT * FROM transactions WHERE user_id='$user_id' ORDER BY id DESC");
?>

<!-- 4 -->

<?php if(isset($_SESSION['success'])): ?>
  <div style="background:green;color:white;padding:10px;">
    <?php 
    echo $_SESSION['success']; 
    unset($_SESSION['success']);
    ?>
  </div>
<?php endif; ?>


<!-- 5 -->

<?php
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// Samun bayanan user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VTU Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<input type="checkbox" id="menu-toggle">

   <header class="header">
  <label for="menu-toggle" class="side-menu-btn">
    <span></span>
  </label>

  <h2>Netpay Dashboard</h2>

  <nav>
    <a href="logout.php">Logout</a>
  </nav>
</header>

<div class="dashboard">


  <!-- Sidebar -->
<div class="sidebar"> <h2>NETPAY2 VTU</h2>
   <ul>
     <li>🏠 Dashboard</li>
     <li>📱 Buy Airtime</li> 
     <li>🌐 Buy Data</li> 
     <li>📺 Cable TV</li>
      <li>💡 Electricity</li> 
      <li>💼 Wallet</li> 
      <li>📄 Transactions</li> 
      <li>⚙️ Settings</li> 
    </ul>
   </div>

  <!-- Main Content -->
  <div class="main">

    <!-- Top Bar -->
    <div class="topbar">
      <h3>Welcome, <?php echo $user['name']; ?></h3>
      <button class="fund-btn">+ Fund Wallet</button>
    </div>

    <!-- Wallet Card -->
    <div class="wallet">
      <p>Wallet Balance</p>
      <h1>₦<?php echo $user['wallet']; ?></h1>
      <h6>refferai banous N0.5</h6>
    </div>


    <div class="dash-nav">
    <button onclick="showSection('all')">All Transactions</button>
    <button onclick="showSection('wallet')">Wallet Summary</button>
</div>

    
     
    <div class="services">

  <a href="airtime.php" class="dash-service">
    <img src="suppor.png" width="20" height="15"> Airtime
  </a>

  <a href="data.php" class="dash-service">
    <img src="data1.png" width="20" height="15"> Data
  </a>

  <div class="dash-service">
    <img src="cash.png" width="20" height="15">
    Airtime 2 Cash
  </div>

  <div class="dash-service">
    <img src="setting.png" width="20" height="15">
    Smile Voice
  </div>

  <div class="dash-service">
    <img src="exam.png" width="20" height="15">
    Exam pin
  </div>

  <div class="dash-service">
    <img src="donelogo.png" width="20" height="15">
    Electricity Bill
  </div>

</div>
<!-- ALL TRANSACTIONS -->
<div id="allSection" class="section">

<?php while($row = $transactions->fetch_assoc()): ?>

<div class="trx" 
onclick="openTransaction(
'<?php echo $row['service']; ?>',
'₦<?php echo $row['amount']; ?>',
'<?php echo $row['service']; ?>',
'<?php echo $row['status']; ?>'
)">
    <?php echo $row['service']; ?> - ₦<?php echo $row['amount']; ?>
</div>

<?php endwhile; ?>

</div>


<!-- WALLET SUMMARY -->
<div id="walletSection" class="section" style="display:none;">

<?php
$wallet_trx = $conn->query("SELECT * FROM transactions WHERE user_id='$user_id' AND service='wallet'");
while($row = $wallet_trx->fetch_assoc()):
?>

<div class="trx"
onclick="openTransaction(
'Wallet',
'₦<?php echo $row['amount']; ?>',
'Wallet Transaction',
'<?php echo $row['status']; ?>'
)">
    Wallet - ₦<?php echo $row['amount']; ?>
</div>

<?php endwhile; ?>

</div>

  </div>
</div>

<script>

function showSection(type){

    document.getElementById("allSection").style.display = "none";
    document.getElementById("walletSection").style.display = "none";

    if(type === "all"){
        document.getElementById("allSection").style.display = "block";
    }else{
        document.getElementById("walletSection").style.display = "block";
    }
}

function openTransaction(type, amount, info, status){

    document.getElementById("trxType").innerText = "Type: " + type;
    document.getElementById("trxAmount").innerText = "Amount: " + amount;
    document.getElementById("trxPhone").innerText = "Info: " + info;
    document.getElementById("trxStatus").innerText = "Status: " + status;

    document.getElementById("trxPopup").style.display = "flex";
}

function closeTransaction(){
    document.getElementById("trxPopup").style.display = "none";
}

</script>


<div id="trxPopup" class="popup-overlay" style="display:none;">
    <div class="popup">
        <h2>Transaction Details</h2>
        <p id="trxType"></p>
        <p id="trxAmount"></p>
        <p id="trxPhone"></p>
        <p id="trxStatus"></p>
        <button onclick="closeTransaction()">Close</button>
    </div>
</div>

</body>
</html>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buy Airtime</title>
<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="popup.css">
</head>

<body>
<header class="header">
<h2>Buy Airtime</h2>
<a href="dashboard.php">⬅ Back</a>
</header>

<?php include 'message.php'; ?>
<section class="buy-data">
    
<!--<div id="loader" style="display:none;">Processing...</div>-->

<h3>Buy Airtime</h3>

<form id="airtimeForm" action="buy_airtime.php" method="POST">
<label>Phone Number</label>
<!--input type="tel" id="phone" placeholder="Enter phone number" required-->
<input type="tel" name="phone" id="phone" placeholder="Enter phone number" required>
<label>Select Network</label>
<select name="network" id="network" required>
    <option value="">Select Network</option>
    <option value="MTN">MTN</option>
    <option value="Airtel">Airtel</option>
    <option value="Glo">Glo</option>
    <option value="NineMobile">9mobile</option>
</select>
 
<!-- NETWORK DETECT -->
<div class="network-box">
<img id="networkLogo" src="" style="display:none;">
<p id="networkName"></p>
</div>

<label>Amount</label>
<!--input type="number" id="amount" placeholder="Enter amount" min="50" required-->
<input type="number" name="amount" id="amount" placeholder="Enter amount" min="50" required>

<!-- QUICK BUTTONS -->
<div class="quick-amount">
<button type="button" onclick="setAmount(100)">₦100</button>
<button type="button" onclick="setAmount(200)">₦200</button>
<button type="button" onclick="setAmount(500)">₦500</button>
<button type="button" onclick="setAmount(1000)">₦1000</button>
</div>

<button type="submit">Buy Airtime</button>

</form>
<script>
document.addEventListener("DOMContentLoaded", function(){

    // =======================
    // ELEMENTS
    // =======================
    const phoneInput = document.getElementById("phone");
    const networkLogo = document.getElementById("networkLogo");
    const networkName = document.getElementById("networkName");
    const form = document.getElementById("airtimeForm");

    // =======================
    // NETWORK PREFIX DATABASE
    // =======================
    const networks = {
        MTN: ["0803","0703","0813","0816","0903","0906"],
        Airtel: ["0802","0708","0812","0901","0902"],
        Glo: ["0805","0705","0815","0905"],
        NineMobile: ["0809","0817","0818","0908"]
    };

    const logos = {
        MTN:"mtn.jpg",
        Airtel:"airtel.jpg",
        Glo:"glo.jpg",
        NineMobile:"9mobile.jpg"
    };

    // =======================
    // DETECT NETWORK
    // =======================
    if(phoneInput){
        phoneInput.addEventListener("input", function(){

            let number = this.value.substring(0,4);

            for(let network in networks){
                if(networks[network].includes(number)){
                    networkLogo.src = logos[network];
                    networkLogo.style.display = "block";
                    networkName.textContent = network;
                    return;
                }
            }

            networkLogo.style.display = "none";
            networkName.textContent = "";
        });
    }

    // =======================
    // QUICK AMOUNT
    // =======================
    window.setAmount = function(value){
        document.getElementById("amount").value = value;
    }

    // =======================
    // FORM SUBMIT
    // =======================
    if(form){
        form.addEventListener("submit", function(e){

            let amount = document.getElementById("amount").value;

            if(amount < 50){
                e.preventDefault();
                alert("Minimum airtime is ₦50");
                return;
            }

            // SHOW LOADER
            document.getElementById("loader").style.display = "flex";
        });
    }

});
</script>

<div id="loader" class="loader-overlay" style="display:none;">
    <div class="spinner"></div>
</div>

</body>
</html>
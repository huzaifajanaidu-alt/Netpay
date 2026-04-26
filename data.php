<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buy Data</title>
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="popup.css">
</head>
<body>
<header class="header">
  <h2>Buy Data</h2>
  <a href="dashboard.php">⬅ Back</a>

</header>

<?php session_start(); ?>
<?php include 'message.php'; ?>

<section class="buy-data">

  <h3>Buy Internet Data</h3>

  <form action="buy_data.php" method="POST">

<label>Network</label>
<select name="network" required>
  <option value="">Select Network</option>
  <option value="MTN">MTN</option>
  <option value="Airtel">Airtel</option>
  <option value="Glo">Glo</option>
  <option value="9mobile">9mobile</option>
</select>

<label>Data Type</label>
<select name="data_type" id="dataType" required>
  <option value="">Select Data Type</option>
  <option value="sme">SME</option>
  <option value="gifting">Gifting</option>
  <option value="corporate">Corporate</option>
</select>

<label>Data Plan</label>
<select name="plan" id="dataPlan" required>
  <option value="">Select Data Plan</option>
</select>

<label>Phone Number</label>
<input type="tel" name="phone" required>

<button type="submit">Buy Data</button>

</form>

</section>


<script>
const dataPlans = {
  sme: ["SME 500MB", "SME 1GB", "SME 2GB"],
  gifting: ["Gifting 1GB", "Gifting 2GB", "Gifting 5GB"],
  corporate: ["Corporate 500MB", "Corporate 1GB", "Corporate 2GB"]
};

const dataType = document.getElementById("dataType");
const dataPlan = document.getElementById("dataPlan");

dataType.addEventListener("change", function () {
  dataPlan.innerHTML = '<option value="">Select Data Plan</option>';

  if (this.value === "") return;

  dataPlans[this.value].forEach(plan => {
    const option = document.createElement("option");
    option.text = plan;
    option.value = plan;
    dataPlan.add(option);
  });
});
</script>
</body>



<script src="main.js"></script>

</body>
</html>

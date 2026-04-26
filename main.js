alert("welcame back to netpay!");



const dataPlans = {
  sme: [
    "SME 500MB",
    "SME 1GB",
    "SME 2GB"
  ],
  gifting: [
    "Gifting 1GB",
    "Gifting 2GB",
    "Gifting 5GB"
  ],
  corporate: [
    "Corporate 5GB",
    "Corporate 10GB"
  ]
};

const dataType = document.getElementById("dataType");
const dataPlan = document.getElementById("dataPlan");

if (dataType && dataPlan) {
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
}

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart2");
var CP = document.getElementById("CP").value;
var CH = document.getElementById("CH").value;
var CD = document.getElementById("CD").value;
var CS = document.getElementById("CS").value;
var CF = document.getElementById("CF").value;
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Kategori", "Pelayanan", "Produk Kecantikan", "Jasa Makeup", "Supplier Produk"],
    datasets: [{
      data: [CP, CH, CD, CS, CF],
      backgroundColor: ['#4e73df', '#36b9cc', '#73d32a', '#f6c23e', '#e74a3b'],
      hoverBackgroundColor: ['#2e59d9', '#2c9faf', '#4ec433', '#dda20a', '#be2617'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 70,
  },
});

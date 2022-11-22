$(".msger").hide();
$("#myChart").show();
$(".question").show();
const words = res.data_values;
document.getElementById("question").innerHTML = res.poll_question;

const config = {
  type: "wordCloud",
  data: {
    labels: words.map((d) => d.key),
    datasets: [
      {
        label: "Score",
        data: words.map((d) => d.value),
      },
    ],
  },

  options: {
    padding: 10,
    minRotation: 0,
    hoverColor: [
      "#ff1a68",
      "#36a2eb",
      "#ffce56",
      "#4bc0c0",
      "#9966ff",
      "#ff9f40",
      "#000000",
      "#ff1a68",
      "#36a2eb",
      "#ffce56",
      "#4bc0c0",
      "#9966ff",
      "#ff9f40",
      "#000000",
    ],
    color: [
      "#ff1a68",
      "#36a2eb",
      "#ffce56",
      "#4bc0c0",
      "#9966ff",
      "#ff9f40",
      "#000000",
      "#ff1a68",
      "#36a2eb",
      "#ffce56",
      "#4bc0c0",
      "#9966ff",
      "#ff9f40",
      "#000000",
    ],

    title: {
      display: false,
      text: "Word Cloud Poll",
    },
    plugins: {
      legend: {
        display: false,
      },
    },
  },
};
// render init block
// JS - Destroy exiting Chart Instance to reuse <canvas> element
let chartStatus = Chart.getChart("myChart"); // <canvas> id
if (chartStatus != undefined) {
  chartStatus.destroy();
}
//-- End of chart destroy
var chartCanvas = $("#myChart"); //<canvas> id
chartInstance = new Chart(chartCanvas, config);
// render init block

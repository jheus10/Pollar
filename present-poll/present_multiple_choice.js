$(".poll-container").hide();
var updated_data = [];
updated_data = res.data_values;
var my_data = updated_data;
//AJAX call for updating values
setInterval(function () {
  $.ajax({
    type: "POST",
    url: "ajax/view-analytics.php",
    datatype: "json",

    data: {
      event_id: event_id,
      poll_code: poll_code,
    },
    success: function (db_call) {
      var res2 = jQuery.parseJSON(db_call);
      var x = 0;
      while (x < res2.data_values.length) {
        res2.data_values[x] = Number(res2.data_values[x]).toFixed(0);
        x++;
      }
      updated_data = res2.data_values;
    },
  });
}, 5000);
var x = 0;
while (x < res.data_values.length) {
  res.data_values[x] = Number(res.data_values[x]).toFixed(0);
  x++;
}
document.getElementById("question").innerHTML = res.poll_question;
const data = {
  labels: res.data_labels,
  datasets: [
    {
      label: "Poll",
      data: my_data,
      borderColor: [
        "rgba(255, 26, 104, 0.2)",
        "rgba(54, 162, 235, 0.2)",
        "rgba(255, 206, 86, 0.2)",
        "rgba(75, 192, 192, 0.2)",
        "rgba(153, 102, 255, 0.2)",
        "rgba(255, 159, 64, 0.2)",
        "rgba(0, 0, 0, 0.2)",
        "rgba(255, 26, 104, 0.2)",
        "rgba(54, 162, 235, 0.2)",
        "rgba(255, 206, 86, 0.2)",
        "rgba(75, 192, 192, 0.2)",
        "rgba(153, 102, 255, 0.2)",
        "rgba(255, 159, 64, 0.2)",
        "rgba(0, 0, 0, 0.2)",
      ],
      backgroundColor: [
        "rgba(255, 26, 104, 1)",
        "rgba(54, 162, 235, 1)",
        "rgba(255, 206, 86, 1)",
        "rgba(75, 192, 192, 1)",
        "rgba(153, 102, 255, 1)",
        "rgba(255, 159, 64, 1)",
        "rgba(0, 0, 0, 1)",
      ],
      //size of bar
      borderWidth: 0,
      borderSkipped: false,
      borderRadius: 5,
      barPercentage: 0.5,
      categoryPercentage: 0.8,
    },
  ],
};
// progressBar plugin block

const progressBar = {
  id: "progressBar",
  beforeDatasetsDraw(chart, args, pluginOptions) {
    const {
      ctx,
      data,
      chartArea: { top, bottom, left, right, width, height },
      scales: { x, y },
    } = chart;
    ctx.save();
    const barHeight =
      (height / y.ticks.length) *
      data.datasets[0].barPercentage *
      data.datasets[0].categoryPercentage;

    data.datasets[0].data.forEach((datapoint, index) => {
      //label txt
      ctx.font = "20px sans-serif";
      ctx.fillStyle = "rgba(102,102,102,1)";
      ctx.textAlign = "left";
      ctx.textBaseline = "middle";
      ctx.fillText(
        data.labels[index],
        left,
        y.getPixelForValue(index) - barHeight
      );

      //value txt
      const fontDatapoint = 20;
      ctx.font = "20px sans-serif";
      ctx.fillStyle = "rgba(102,102,102,1)";
      ctx.textAlign = "right";
      ctx.textBaseline = "middle";
      ctx.fillText(
        datapoint + "%",
        right,
        y.getPixelForValue(index) - barHeight
      );

      //bg color progress bar
      ctx.beginPath();
      ctx.fillStyle = data.datasets[0].borderColor[index];
      ctx.fillRect(
        left,
        y.getPixelForValue(index) - barHeight / 2,
        width,
        barHeight
      );
    });
  },
};
// config
const config = {
  type: "bar",
  data,
  options: {
    responsive: true,
    indexAxis: "y",
    layout: {
      padding: {
        top: 20,
      },
    },
    hover: {
      mode: "dataset",
    },
    plugins: {
      legend: {
        display: false,
      },
    },
    scales: {
      x: {
        suggestedMax: 100,
        grid: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          display: false,
        },
      },
      y: {
        beginAtZero: true,

        grid: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          display: false,
        },
      },
    },
  },
  plugins: [progressBar],
};
// JS - Destroy exiting Chart Instance to reuse <canvas> element
let chartStatus = Chart.getChart("myChart"); // <canvas> id
if (chartStatus != undefined) {
  chartStatus.destroy();
}
//-- End of chart destroy
var chartCanvas = $("#myChart"); //<canvas> id
chartInstance = new Chart(chartCanvas, config);
// render init block
setInterval(function () {
  chartInstance.data.datasets[0].data = updated_data;
  chartInstance.update();
  //console.log(updated_data);
}, 5000);

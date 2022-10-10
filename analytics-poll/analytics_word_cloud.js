$('.msger').hide();
            $('#myChart').show();
            $('.question').show();
            const words = res.data_values;
            document.getElementById('question').innerHTML=res.poll_question;
            const config = {
              type: "wordCloud",
              data: {
                labels: words.map((d) => d.key),
                datasets: [
                  {
                    label: "Score",
                    data: words.map((d) => 10 + d.value * 20)
                  }
                ]
              },
              options: {
                title: {
                  display: false,
                  text: "Word Cloud Poll"
                },
                plugins: {
                  legend: {
                    display: false
                  }
                }
              }
            }
            // render init block
          // JS - Destroy exiting Chart Instance to reuse <canvas> element
          let chartStatus = Chart.getChart("myChart"); // <canvas> id
            if (chartStatus != undefined) {
              chartStatus.destroy();
            }
        //-- End of chart destroy   
            var chartCanvas = $('#myChart'); //<canvas> id
            chartInstance = new Chart(chartCanvas, config);
            // render init block
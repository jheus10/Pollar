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
                    data: words.map((d) => 10+ d.value * 5)
                  }
                ]
              },
              
                options: {
                  minRotation: 0,
                  hoverColor:[
                   'rgba(255, 26, 104, 0.5)',
                   'rgba(54, 162, 235, 0.5)',
                   'rgba(255, 206, 86, 0.5)',
                   'rgba(75, 192, 192, 0.5)',
                   'rgba(153, 102, 255, 0.5)',
                   'rgba(255, 159, 64, 0.5',
                   'rgba(0, 0, 0, 0.5)',
                   'rgba(255, 26, 104, 0.5)',
                   'rgba(54, 162, 235, 0.5)',
                   'rgba(255, 206, 86, 0.5)',
                   'rgba(75, 192, 192, 0.5)',
                   'rgba(153, 102, 255, 0.5)',
                   'rgba(255, 159, 64, 0.5)',
                   'rgba(0, 0, 0, 0.5)',
                  ],
                   color:[
                     'rgba(255, 26, 104,1)',
                     'rgba(54, 162, 235, 1)',
                     'rgba(255, 206, 86, 1)',
                     'rgba(75, 192, 192, 1)',
                     'rgba(153, 102, 255, 1)',
                     'rgba(255, 159, 64, 1)',
                     'rgba(0, 0, 0, 1)',
                     'rgba(255, 26, 104, 1)',
                     'rgba(54, 162, 235, 1)',
                     'rgba(255, 206, 86, 1)',
                     'rgba(75, 192, 192, 1)',
                     'rgba(153, 102, 255, 1)',
                     'rgba(255, 159, 64, 1)',
                     'rgba(0, 0, 0, 1)',
                   ],
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
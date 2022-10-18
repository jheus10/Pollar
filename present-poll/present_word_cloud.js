$('.poll-container').hide();
                    var updated_data=[];
                    updated_data=res.data_values;
                    var my_data=updated_data;
                    document.getElementById('question').innerHTML=res.poll_question;
                    document.getElementById("chartBox").style.height = "80%";
                    //AJAX call for updating values
                    
                    
                    
                    if(my_data.length==0){
                      document.getElementById('no_data').innerHTML="No responses yet.";
                   
                    }
                    setInterval(function() {
                                    $.ajax({
                                  type:"POST",
                                  url: "ajax/view-analytics.php",
                                  datatype:'json',
                                                  
                                  data: {
                                      'event_id': event_id,
                                      'poll_code': poll_code,
                                                      
                                    },
                                  success: function(db_call) {
                                    var res2 = jQuery.parseJSON(db_call);
                                    updated_data=res2.data_values;
                                    
                                  }
                                });
                              if(my_data.length==0){
                                
                                location.reload();
                              }
                               
                             
                            }, 5000);   
                            var canvas = document.getElementById("myChart");
                            var ctx = canvas.getContext("2d");
                            ctx.fillText("Hello World", 10, 50);
                            const size= 20;
                            const words = res.data_values;
                            document.getElementById('question').innerHTML=res.poll_question;
                            const config = {
                              type: "wordCloud",
                              data: {
                                labels: words.map((d) => d.key),
                                datasets: [
                                  {
                                   
                                    label: "Score",
                                    data: words.map((d) =>  d.value * 15)
                                  }
                                ]
                              },
                              options: {
                               family: "Verdana",
                               minRotation: 0,
                               maxRotation: 0,
                               
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
                                minAngle: 0,
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
                            let chartStatus = Chart.getChart("myChart"); // <canvas> id
                            if (chartStatus != undefined) {
                              chartStatus.destroy();
                            }
                        //-- End of chart destroy   
                            var chartCanvas = $('#myChart'); //<canvas> id
                            chartInstance = new Chart(chartCanvas, config);
                            // render init block
                     
                            // UPDATES THE DATA TO THE CHART
                            setInterval(function() {
                              chartInstance.data.labels = updated_data.map((d) => d.key);
                              chartInstance.data.datasets[0].data = updated_data.map((d) =>  d.value * 15);
                              chartInstance.update();
                              //.log(updated_data);
                            },5000);
                         
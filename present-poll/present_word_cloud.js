$('.poll-container').hide();
                    var updated_data=[];
                    updated_data=res.data_values;
                    var my_data=updated_data;
                    document.getElementById('question').innerHTML=res.poll_question;
                    document.getElementById("chartBox").style.height = "80%";
                    //AJAX call for updating values
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
                              
                            }, 5000);   


                            const config = {
                              type: "wordCloud",
                              data: {
                                labels: my_data.map((d) => d.key),
                                datasets: [
                                  {
                                    label: "Score",
                                    data: my_data.map((d) => 10 + d.value * 20)
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
                        
                            setInterval(function() {
                              chartInstance.data.labels = updated_data.map((d) => d.key);
                              chartInstance.data.datasets[0].data = updated_data.map((d) => 10 + d.value * 20);
                              chartInstance.update();
                              //.log(updated_data);
                            },5000);
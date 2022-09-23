<?php
// Initialize the session

session_start();
require_once('config.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$_SESSION['event_id'] = $_GET['event_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Analytics</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="css/analytics.css" rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://unpkg.com/chartjs-chart-wordcloud@3"></script>
        <style>
        .poll_preview {
        width: 100%;
        height: 100%;
        background: rgba(255, 26, 104, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
       
        overflow: hidden;
      }
      .chartBox {
        position: relative;
        height: 500px;
        width: 100%;
        padding: 20px;
        border-radius: 20px;
        background: white;
        max-height: 80%;
        overflow-y:scroll;
        
      }
      .chartBox::-webkit-scrollbar {
        display: none;
      }
      .question{
        margin-bottom: 0px;
      }
        </style>
</head>
<body>

<div class="flex-container">
  <div class="my_polls">
  <?php
$event_id=$_GET['event_id'];
$sql = "SELECT * FROM poll_list WHERE event_id = $event_id ";

$result = $link->query($sql);

if ($result = mysqli_query($link, $sql)) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $sql2 = "SELECT * FROM poll_answers WHERE event_id = $event_id AND poll_code = $row[poll_code]";
    $result2 = $link->query($sql2);
    echo ' <button class="viewPollBtn child--poll" value='.$row["event_id"].' id='.$row["poll_code"].'>';
    echo '<div class="child--content">';
    echo '<input type="text" value='.$row['id'].'" hidden>';
    echo '<h3>'.$row['poll_type'].'</h3>';
    echo '<h2>'.$row['poll_question'].'</h2>';
    echo "</div>";
    echo '<div class="number_participants"><p>'.mysqli_num_rows($result2).'</p><i class="fa-solid fa-users"> </i></div>'; 

  echo "</button>";

  }
} else {
  echo "0 results";
}
?>
  </div>
  
<div class="poll_preview" id="poll_preview">
      
      <div class="chartBox" id="chartBox" >
      <div class="question" id="question"></div>
        <canvas id="myChart"></canvas>
      </div>

</div>
</div>
           
</body>

<script>
  $(document).on('click', '.viewPollBtn', function (e) {
            e.preventDefault();
              var event_id = $(this).val();
              var poll_code = this.id;
                $.ajax({
                    type: "POST",
                    url: "view-analytics.php",
                    datatype:'json',
                    
                    data: {
                        'event_id': event_id,
                        'poll_code': poll_code,
                        
                    },
                    success: function (response) {
                     
                      var res = jQuery.parseJSON(response);
                      if(res.status == 500) {
                        
                      alert(res.message);
                      }else{
                        
                        if (res.poll_type=='Multiple Choice'){
                            var x = 0;
                            while(x < res.data_values.length){ 
                              res.data_values[x] = Number(res.data_values[x]).toFixed(0); 
                                x++;
                            }
                          document.getElementById('question').innerHTML=res.poll_question;
                          const data = {
      labels: res.data_labels,
      datasets: [{
        label: 'Weekly Sales',
        data: res.data_values,
        borderColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)',
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)',
        ],
        backgroundColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        //size of bar
        borderWidth: 0,
        borderSkipped: false,
        borderRadius: 5,
        barPercentage: 0.5,
        categoryPercentage: 0.8,
      }]
    };
    // progressBar plugin block
    if (res.data_labels.length ==2){

    }
    const progressBar = {
        id: 'progressBar',
        beforeDatasetsDraw(chart,args,pluginOptions){
            const { ctx, data, chartArea: { top,bottom,left,right,width,height}
            , scales: {x, y} } = chart;
            ctx.save();
            const barHeight= height/y.ticks.length * data.datasets[0].barPercentage*data.datasets[0].categoryPercentage;
            
        data.datasets[0].data.forEach((datapoint, index)=>{
        //label txt
        ctx.font = '20px sans-serif';
        ctx.fillStyle = 'rgba(102,102,102,1)';
        ctx.textAlign = 'left';
        ctx.textBaseline = 'middle';
        ctx.fillText(data.labels[index],left,y.getPixelForValue(index)- barHeight);
        
        //value txt
        const fontDatapoint = 20;
        ctx.font = '20px sans-serif';
        ctx.fillStyle = 'rgba(102,102,102,1)';
        ctx.textAlign = 'right';
        ctx.textBaseline = 'middle';
        ctx.fillText(datapoint+"%",right,y.getPixelForValue(index)-barHeight);

        //bg color progress bar
        ctx.beginPath();
        ctx.fillStyle= data.datasets[0].borderColor[index];
        ctx.fillRect(left,y.getPixelForValue(index)-barHeight/2,width, barHeight);
        })
       
        }
        
    }
    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        responsive: true,
        indexAxis: 'y',
        layout: {
            padding: {
                top: 20
            }
        },
        hover: {
            mode: 'dataset'
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
                drawBorder:false
            },
            ticks: {
                display: false,
            }
          },
          y: {
            beginAtZero: true,
           
            grid: {
                display: false,
                drawBorder:false
            },
            ticks: {
                display: false
            }
          }
          
        }
      },
      plugins: [progressBar]
    };
    // JS - Destroy exiting Chart Instance to reuse <canvas> element
    let chartStatus = Chart.getChart("myChart"); // <canvas> id
    if (chartStatus != undefined) {
      chartStatus.destroy();
    }
//-- End of chart destroy   
    var chartCanvas = $('#myChart'); //<canvas> id
    chartInstance = new Chart(chartCanvas, config);
    // render init block
 
    
    console.log(res);

    
  }else if(res.poll_type="Word Cloud"){
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
 

    console.log(res);
  }
                         
} 
}
});
});           

</script>
<script>     
    
    </script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

          <!-- <script>
   $(document).ready(function(){
   window.setInterval(function(){
     $("#poll_question").load(window.location.href + " #poll_question" );
   }, 5000);
   });
</script>  -->
</html>
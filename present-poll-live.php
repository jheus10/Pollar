<?php
session_start();
 
require_once('config.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
  
        ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Getting Started with Chart JS with www.chartjs3.com</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/chartjs-chart-wordcloud@3"></script>
   
    <style>
      * {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
      }
     
      .chartCard {
        width: 100%;
        height: calc(100vh - 20px);
        background: rgba(255, 26, 104, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
       
        overflow: hidden;
      }
      .chartBox {
        position: relative;
        width: 1200px;
        padding: 20px;
        border-radius: 20px;
        background: white;
        max-height: 80%;
        overflow-y:scroll;
        
      }
      .chartBox::-webkit-scrollbar {
        display: none;
      }
      #myChart{
       overflow: scroll

      }
      .question{
        margin-bottom: 0px;
      }
     
    </style>
  </head>
  <body>
  <script>
    var datavalues=[];
    var datalabels=[];
    var word_cloud_key=['key','value'];
    var word_cloud_arrayContainer=[];
    var word_cloud_value={};
    </script>
    <?php 
     $event_id= $_GET['event_id'];  
     $poll_code= $_GET['poll_code'];  
     $sql = "SELECT * FROM poll_list WHERE event_id = $event_id AND poll_code = $poll_code";
     
     if ($result = mysqli_query($link, $sql)) {
       // Fetch one and one row
       while ($row = $result->fetch_assoc()) {
           $trimmed=trim($row['poll_choices']);
           $exploded = explode("," ,$trimmed);
    // MULTIPLE CHOICE
     if ($row['poll_type']=="Multiple Choice"){      
          $result3 = $link->query("SELECT COUNT(*)/100 as total FROM poll_answers WHERE event_id = $event_id AND poll_code = $poll_code");
          $row3 = $result3->fetch_row();
              for ($i=1; $i < count($exploded)-1; $i++){
          $sql2 = "SELECT * FROM poll_answers WHERE event_id = $event_id AND poll_code = $poll_code AND answer_option='$exploded[$i]'";
          $result2 = mysqli_query($link, $sql2);
              try{
              echo '<script>datalabels.push("'.($exploded[$i]).'");datavalues.push("'.((mysqli_num_rows($result2))/$row3[0]).'")</script>';
              }catch (DivisionByZeroError $e){
              echo '<script>datalabels.push("'.($exploded[$i]).'");datavalues.push("'.((mysqli_num_rows($result2))).'")</script>';
              }
              }
       
    ?>
    <div class="chartCard">
      
      <div class="chartBox">
      <div class="question"><?= $row['poll_question']?></div>
        <canvas id="myChart"></canvas>
      </div>
      
    </div> 
    <script>
    // setup 
    var x = 0;
    while(x < datavalues.length){ 
        datavalues[x] = Number(datavalues[x]).toFixed(0); 
        x++;
    }
      
    const data = {
      labels: datalabels,
      datasets: [{
        label: 'Weekly Sales',
        data: datavalues,
        borderColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
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
    if (datalabels.length ==2){

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
        const fontSizeLabel = 20;
        ctx.font = '20px sans-serif';
        ctx.fillStyle = 'rgba(102,102,102,1)';
        ctx.textAlign = 'left';
        ctx.textBaseline = 'middle';
        ctx.fillText(data.labels[index],left,y.getPixelForValue(index)- fontSizeLabel-25);
        
        //value txt
        const fontDatapoint = 20;
        ctx.font = '20px sans-serif';
        ctx.fillStyle = 'rgba(102,102,102,1)';
        ctx.textAlign = 'right';
        ctx.textBaseline = 'middle';
        ctx.fillText(datapoint+"%",right,y.getPixelForValue(index));

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

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
    </script>

<?php
    }// WORD CLOUD
        elseif($row['poll_type']=="Word Cloud"){
          $sql2="SELECT answer_option, COUNT(*) as total_answers FROM poll_answers WHERE poll_code=1655346 AND event_id =6 GROUP BY answer_option";
          if ($result2 = mysqli_query($link, $sql2)) {
            while( $row2 = $result2->fetch_assoc()){           
          ?>

<script>
   var wordz_cloud_arrayContainer={
      "key": "<?= $row2["answer_option"]?>",
      "value": <?= $row2["total_answers"] ?>
    };
    word_cloud_arrayContainer.push(wordz_cloud_arrayContainer);

</script>
<?php
        }    
        }
 ?>
 <script>


 </script>
  <div class="chartCard">
      
      <div class="chartBox" style="height: 80%;">
      <div class="question"><?= $row['poll_question']?></div>
        <canvas id="myChart"></canvas>
      </div>
      
    </div> 
 <script>
const words = word_cloud_arrayContainer;

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
      text: "Chart.js Word Cloud"
    },
    plugins: {
      legend: {
        display: false
      }
    }
  }
}
// render init block
const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );


 </script>

 <?php
          }
        }
        mysqli_free_result($result);
      }

      mysqli_close($link);
      ?>
<!-- <script>

$(document).ready(function(){
window.setInterval(function(){
  myChart.update();
}, 1000);
});


</script> -->
  </body>
</html>
<?php
session_start();
 
require_once('config/config.php');
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
    <title>Present Poll</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/chartjs-chart-wordcloud@3"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link href="css/open-text.css" rel="stylesheet">
   
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
      #word_cloud{

        
      }
      .question{
        margin-bottom: 0px;
      }
      #no_data{
        display: flex;
        justify-content: center;
      }
     
    </style>
  </head>
  <body>

  <?php
$event_id=$_GET['event_id'];
$sql = "SELECT * FROM poll_list WHERE event_id = $event_id ";

$result = $link->query($sql);

if ($result = mysqli_query($link, $sql)) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $sql2 = "SELECT * FROM poll_answers WHERE event_id = $event_id AND poll_code = $row[poll_code]";
    $result2 = $link->query($sql2);

  }
} else {
  echo "0 results";
}
?>

  <div class="chartCard">    
      <div class="chartBox" id="chartBox" >
      <div class="question" id="question"></div>
      <div class="no_data" id="no_data"></div>
        <canvas id="myChart"></canvas>
        
      </div>
  </div> 
      
    <div class="poll-container">
      <section class="msger">
          <header class="msger-header">
            <div class="msger-header-title">
              <i class="fas fa-comment-alt"></i> 
            </div>
              <div class="msger-header-options"></div>           
          </header> 
              <div class="container" id="container">
                <main class="msger-chat" id="msger-chat">
                    
              </div>
              </div>
              </div>
                </main>
        </div> 
      </section>
    </div> 
           
</body>

<script>
      $(document).ready(function () {
              
          var event_id = <?=$_GET['event_id']?>;
          var poll_code = <?=$_GET['poll_code']?>;
                $.ajax({
                  type: "POST",
                  url: "ajax/view-analytics.php",
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
                    <?php include 'present-poll/present_multiple_choice.js' ?>
                
                  }else if(res.poll_type=="Word Cloud"){
                    <?php include 'present-poll/present_word_cloud.js' ?>
        
                  }else if(res.poll_type=="Quiz"){
                    <?php include 'present-poll/present_quiz.js' ?>

                  }else if(res.poll_type=="Rating"){
                    <?php include 'present-poll/present_rating.js' ?>

                  }else if(res.poll_type=="Open Text"){  
                      <?php include 'present-poll/present_open_text.js' ?>
                      
                  }else if(res.poll_type=="Ranking"){
                      <?php include 'present-poll/present_ranking.js' ?>

                  }       
                } 
              }
            });

          });           
</script>

<?php include_once('footer.php')?>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
</html>
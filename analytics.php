<?php
// Initialize the session

session_start();
require_once('config/config.php');
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
        <script src="js/analytics-chartjs-chart-wordcloud@3.js"></script>
        <link href="css/open-text.css" rel="stylesheet">
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
<?='<a href="admin-event.php?event_id='.$_SESSION['event_id'].'"><--- Back</a>'?>
<div class="flex-container">
  <div class="my_polls">
  <?php
$event_id=$_GET['event_id'];
$sql = "SELECT * FROM poll_list WHERE event_id = $event_id ";

$result = $link->query($sql);

if ($result = mysqli_query($link, $sql)) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $sql1 = "SELECT * FROM poll_answers WHERE event_id = $event_id AND poll_code = $row[poll_code]";
    $result1 = $link->query($sql1);
    $sql2 = "SELECT * FROM poll_answers WHERE event_id = $event_id AND poll_code = $row[poll_code] GROUP BY user_id";
    $result2 = $link->query($sql2);
    echo ' <button class="viewPollBtn child--poll" value='.$row["event_id"].' id='.$row["poll_code"].'>';
    echo '<div class="child--content">';
    echo '<input type="text" value='.$row['id'].'" hidden>';
    echo '<h3>'.$row['poll_type'].'</h3>';
    if ($row['poll_type']=="Quiz"){
      echo '<h2>'.$row['poll_title'].'</h2>';
    }else
    echo '<h2>'.$row['poll_question'].'</h2>';
    echo "</div>";
    echo '<div class="number_participants"><p>'.mysqli_num_rows($result2).'</p><i class="fa-solid fa-user"></i><p>'.mysqli_num_rows($result1).'</p><i class="fa-solid fa-users"> </i></div>'; 

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


        
                <section class="msger" style="width: 100%;height: 410px;border-radius: 15px;">
      
                <header class="msger-header">
                      <div class="msger-header-title">
                        <i class="fas fa-comment-alt"></i> 
                        </div>
                        <div class="msger-header-options">
                        </div>
                  </header> 
                  <div class="container" id="#container">
                    <main class="msger-chat" >
                     </div>
                    </div>
                     </div>
            </main>
            </div> 
            </section>
            
      </div>
      
</div>
</div>
           
</body>

<script>
$('.msger').hide();
    
  $(document).on('click', '.viewPollBtn', function (e) {
    

            e.preventDefault();
              var event_id = $(this).val();
              var poll_code = this.id;
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
                          <?php include 'analytics-poll/analytics_multiple_choice.js' ?>
                        
                        }else if(res.poll_type=="Word Cloud"){
                          <?php include 'analytics-poll/analytics_word_cloud.js' ?>
                        
                        }else if(res.poll_type=="Quiz"){
                          <?php include 'analytics-poll/analytics_quiz.js' ?>

                        }
                        else if(res.poll_type=="Rating"){
                          <?php include 'analytics-poll/analytics_rating.js' ?>


                        }else if(res.poll_type=="Open Text"){
                          <?php include 'analytics-poll/analytics_open_text.js' ?>
                          
                        }else if(res.poll_type=="Ranking"){
                          <?php include 'analytics-poll/analytics_ranking.js' ?>

                      }                   
                         
                    } 
                  }
              });
          });           

</script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</html>
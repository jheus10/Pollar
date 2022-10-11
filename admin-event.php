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
    <title>My Event List</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="css/admin.css" rel="stylesheet">
        <link href="css/rating-star.css" rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
       <script src=js/admin-event-functions.js></script>

</head>
<body>
<?='<a href="index.php"><--- Back</a>'?>
<div class="dropdown">
    <div class="textbox"><li><a>Create Poll</a></li></div>
    
<!-- Poll Choices -->    
        <div class="option">
            <div><button type="button" class="create-event" data-toggle="modal" data-target="#add-event-multiple"><ion-icon name="list-outline"></ion-icon>Multiple Choice</button></div>
            <div><button type="button" class="create-event" data-toggle="modal" data-target="#add-event-wordcloud"><ion-icon name="list-outline"></ion-icon>Word Cloud</button></div>
            <div><button type="button" class="create-event" data-toggle="modal" data-target="#add-event-quiz"><ion-icon name="list-outline"></ion-icon>Quiz</button></div>
            <div><button type="button" class="create-event" data-toggle="modal" data-target="#add-event-rating"><ion-icon name="list-outline"></ion-icon>Rating</button></div>
            <div><button type="button" class="create-event" data-toggle="modal" data-target="#add-event-opentext"><ion-icon name="list-outline"></ion-icon>Open Text</button></div>
            <div><button type="button" class="create-event" data-toggle="modal" data-target="#add-event-ranking"><ion-icon name="list-outline"></ion-icon>Ranking</button></div>

        </div>
        
    </div>
<?php 

  function poll($link){
    $poll_code=rand(1000000,9999999);
    $select = "SELECT poll_code FROM poll_list WHERE poll_code = $poll_code";
    $result2 = mysqli_query($link, $select);
      if(mysqli_num_rows($result2)==0){
        echo $poll_code;
      }else{
        poll($link);
      }
 
  }
  

?>
<a href="analytics.php?event_id=<?=$_SESSION['event_id']?>" >Analytics</a>
    <!-- Multiple Choice Modal -->
      <?php include 'modals/modal_multiple_choice.php'?>
    <!-- Word Cloud Modal -->
      <?php include 'modals/modal_word_cloud.php'?>
    <!-- Quiz Modal -->
      <?php include 'modals/modal_quiz.php'?>
    <!-- Rating Modal -->
      <?php include 'modals/modal_rating.php'?>
    <!-- Open Text Modal -->
      <?php include 'modals/modal_open_text.php'?>
    <!-- Ranking Modal -->
      <?php include 'modals/modal_ranking.php'?>


<div class="flex-container">
  <div class="my_polls" id="my_polls">
  <?php
$event_id=$_GET['event_id'];
$sql = "SELECT * FROM poll_list WHERE event_id = $event_id ";
$result = $link->query($sql);

if ($result = mysqli_query($link, $sql)) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if ($row['poll_type']=="Quiz"){
    echo ' <div class="child--poll" id="child--poll">';
    echo '<div class="child--content">';
    echo '<input type="text" value='.$row['id'].'" hidden>';
    echo '<h3>'.$row['poll_type'].'</h3>';
    echo '<h2>'.$row['poll_title'].'</h2>';
    echo "</div>";
    echo '<div class="button-wrapper-present"><a class="view-button" name="view-poll" target="_blank" href="present-poll-live.php?event_id='.$row['event_id'].'&poll_code='.$row['poll_code'].'">Present</a></div>';
    echo '<div class="button-wrapper-copy"><a class="view-button" name="view-poll" onclick="copy(this.id)" id="poll.php?event_id='.$row['event_id'].'&poll_code='.$row['poll_code'].'" href="#">Copy </a></div>'; 
    echo '<div class="button-wrapper-delete"><button class="view-button" id="deletePollBtn" value='.$row['id'].'>Delete</button></div>';
    echo "</div>";

    }
    else if($row['poll_type']=="Word Cloud" || $row['poll_type']=="Multiple Choice"||$row['poll_type']=="Rating"||$row['poll_type']=="Open Text"||$row['poll_type']=="Ranking"){
    
    echo ' <div class="child--poll" id="child--poll">';
    echo '<div class="child--content">';
    echo '<input type="text" value='.$row['id'].'" hidden>';
    echo '<h3>'.$row['poll_type'].'</h3>';
    echo '<h2>'.$row['poll_question'].'</h2>';
    echo "</div>";
    echo '<div class="button-wrapper-present"><a class="view-button" name="view-poll" target="_blank" href="present-poll-live.php?event_id='.$row['event_id'].'&poll_code='.$row['poll_code'].'">Present</a></div>';
    echo '<div class="button-wrapper-copy"><a class="view-button" name="view-poll" onclick="copy(this.id)" id="poll.php?event_id='.$row['event_id'].'&poll_code='.$row['poll_code'].'" href="#">Copy </a></div>'; 
    echo '<div class="button-wrapper-delete"><button class="view-button" id="deletePollBtn" value='.$row['id'].'>Delete</button></div>';
    echo "</div>";
  }else {
  echo "0 results";
  } 
  }
}
?>
<script>
    
     $(document).ready(function(){

          
          $("#submit-poll-quiz").on("click",function(e) {
            
            var choices_array=[];
            var event_id=<?=$_SESSION['event_id']?>;
            var poll_code= document.getElementById('poll_code').value;
            var username = '<?=$_SESSION["username"]?>';
        
            var x=2;
            while(x<=question_counter){
            var divIds = $.map($('#span-'+ x+'> input'), span => span.value);
            choices_array.push("//-");
              for (var i=0; i<divIds.length;i++){
                choices_array.push(divIds[i]);
                
              }           
              x++
            };
            document.getElementById('choices_array').value=choices_array;
           
          
          });
        });
</script>

<script>

let dropdown=document.querySelector('.dropdown'); 
dropdown.onclick=function(){
    dropdown.classList.toggle('active');
} //dropdown nav
</script>
           
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>


</html>
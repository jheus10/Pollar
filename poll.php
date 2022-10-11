<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poll</title>
    <link rel="stylesheet" href="css/poll.css">
    <link href="css/rating-star.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    
</body>
</html>
<?php
session_start();
 
require_once('config/config.php');
// Check if the user is logged in, if not then redirect him to login page

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    $_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
    header("location: login.php");
    exit;
}
?>
    <?php
      $username=$_SESSION["username"];
      $event_id= $_GET['event_id'];  
      $poll_code= $_GET['poll_code'];  
      $sql = "SELECT * FROM poll_list WHERE event_id = $event_id AND poll_code = $poll_code";
      $sql2 = "SELECT * FROM event_list WHERE id = $event_id";
      $result2=mysqli_query($link,$sql2);
      $sql_check_answered = "SELECT * FROM poll_answers WHERE event_id = $event_id AND poll_code = $poll_code AND user_id='$username'";
      $check_if_answered=mysqli_query($link,$sql_check_answered);
      

      while ($row2 = $result2->fetch_assoc()) {
        if ($row2['active_status']==1) {
      if ($result = mysqli_query($link, $sql)) {
        // Fetch one and one row
       
        while ($row = $result->fetch_assoc()) {
            if ($row['poll_type']=="Quiz"){
                $choices=[];
                $trimmed_quiz_question=trim($row['poll_question']);
                $exploded_quiz_question= explode(",*/" ,$trimmed_quiz_question);
                $trimmed_quiz_option=trim($row['poll_choices']);
                $exploded_quiz_option= explode("//-" ,$trimmed_quiz_option);

            }else{
                $trimmed=trim($row['poll_choices']);
                $exploded = explode(",*/" ,$trimmed);
            }
            

            //MULTIPLE CHOICE
            if ($row['poll_type'] == "Multiple Choice"){
                include 'poll-forms/form_multiple_choice.php';
               
            // WORD CLOUD
            }elseif ($row['poll_type'] == "Word Cloud"){
                include 'poll-forms/form_word_cloud.php';
        
            //QUIZ POLL
            }elseif ($row['poll_type'] == "Quiz"){
                include 'poll-forms/form_quiz.php';

            // RATING POLL
            }else if ($row['poll_type'] == "Rating"){
                include 'poll-forms/form_rating.php';
            
            }else if ($row['poll_type'] == "Open Text"){
                
                $sql_opentext = "SELECT * FROM poll_answers WHERE event_id = $event_id AND poll_code = $poll_code AND user_id='$username'";
                include 'poll-forms/form_open_text.php';
            
            //RANKING
            }else if ($row['poll_type'] == "Ranking"){
                include 'poll-forms/form_ranking.php';
            
            }
        }
    }     
        mysqli_free_result($result);
    }else{
        echo "<center>This poll is not active";
        }
    }

            mysqli_close($link);
      ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poll</title>
    <link rel="stylesheet" href="css/poll.css">
    <link href="css/rating-star.css" rel="stylesheet">
    <link href="css/open-text.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet">
</head>
<body>
    
</body>
</html>
<?php
session_start();
 
require_once('config.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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
            
            
            
        ?>
    <?php 
    //MULTIPLE CHOICE
    if ($row['poll_type'] == "Multiple Choice"){
    
    ?>

    <center>
    <div class="poll-container">
        <div class="question"><?php echo $row['poll_question']?></div>
        <form method = 'post' action='submit-answer.php?event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
        
        <div class="options">
        <?php
            for ($i=1; $i < count($exploded)-1; $i++){
           echo '<div class="option-child"><input type="radio" name="answer" id="answer" value="'.($exploded[$i]).'"><input type="text" value="'.($exploded[$i]).'" readonly></div>';
            }
        ?>
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden >
        </div>
        <button type="submit" class="btn btn-primary">Submit Poll</button>
        </form>    

    
    </div>
    <?php
    // WORD CLOUD
    }elseif ($row['poll_type'] == "Word Cloud"){
    
    ?>
    <center>
    <div class="poll-container">
        <div class="question"><?php echo $row['poll_question']?></div>
        <form method = 'post' action='submit-answer.php?event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
        
        <div class="options">
       
        <input type="text" id="answer" name="answer" value=""></div>
         
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden >
        </div>
        <button type="submit" class="btn btn-primary">Submit Poll</button>
        </form>    

        </div>
    <?php
    //QUIZ POLL
    }elseif ($row['poll_type'] == "Quiz"){
        
    ?>
    <center>
    <div class="poll-container">
       <h1><?=$row["poll_title"]?>
        <form method = 'post' action='submit-answer-quiz.php?event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
        
        
        <?php
       $counter=1;
    
        for ($j=1; $j<count($exploded_quiz_option);$j++){
            $explode=explode("," ,$exploded_quiz_option[$j]);
            echo '<div class="question">'.$exploded_quiz_question[$j].'</div>';
            for ($f=1; $f<count($explode);$f++){
                if (!empty($explode[$f])){
                echo '<div class="option-child"><input type="radio" name=q-'.$counter.' id=q-'.$counter.' value="'.($explode[$f]).'"><input type="text" value="'.($explode[$f]).'" readonly></div>';
                }
            }
               
                
             $counter++;
         }
         echo '<input type="text" name="counter" id="counter" value='.--$j.' hidden>';
        ?>
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden >
        </div>
        <button type="submit" class="btn btn-primary">Submit Poll</button>
        </form>    

    
    </div>

        <?php

// RATING POLL
    }else if ($row['poll_type'] == "Rating"){
    
        ?>
    
        <center>
        <div class="poll-container">
            <div class="question"><?php echo $row['poll_question']?></div>
            <form method = 'post' action='submit-answer.php?event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
        <div class="rate-container">
            <ul class="rate-area">
        <?php 
        $formatter=$row['poll_correct']+1;
        for ($i=1; $i<=$row['poll_correct']; $i++){
          echo '<input type="radio" id="'.($formatter-$i).'-star" name="answer" value="'.($formatter-$i).'" onclick=""/><label for="'.($formatter-$i).'-star">'.($formatter-$i).' stars</label>';
        }
        
        ?>
        
        </ul>
        </div> 
            <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden >
            </div>
            <br><br><br>
            <button type="submit" class="btn btn-primary">Submit Poll</button>
            </form>    
    
        
        </div>
        <?php
        
    }else if ($row['poll_type'] == "Open Text"){
        $sql_opentext = "SELECT * FROM poll_answers WHERE event_id = $event_id AND poll_code = $poll_code AND user_id='$username'";
        
        ?>
        <center>
        <div class="poll-container">
           
            <section class="msger">
            <header class="msger-header">
                <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i> <?php echo $row['poll_question']?>
                </div>
                <div class="msger-header-options">
                </div>
            </header>
            
           
                
            <main class="msger-chat">
            <?php 
                            if($result_opentext=mysqli_query($link,$sql_opentext)){

                            
                            while($row_open = $result_opentext->fetch_assoc()){     
                        ?>
                        
                <div class="msg right-msg">
                <div class="msg-img"></div>
                
                <div class="msg-bubble">
                    <div class="msg-info">
                    <div class="msg-info-name"><?=$row_open['user_id']?></div>
                    <div class="msg-info-time"></div>
                    </div>

                    <div class="msg-text">
                    <?=$row_open['answer_option']?>
                    </div>
                </div>
                </div>
                <?php
            }
        }
        ?>
            
            </main>
        
  <form class="msger-inputarea" method = 'post' action='submit-answer.php?event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
    <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden >
    <input type="text" class="msger-input" id="answer" name="answer" value="" placeholder="Enter your message..." autocomplete=off>
    <button type="submit" class="msger-send-btn">Send</button>
  </form>
</section>
        <?php


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
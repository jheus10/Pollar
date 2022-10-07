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
 
require_once('config.php');
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
        <head>
        <link href="css/open-text.css" rel="stylesheet">
        </head>
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
            
           
             <div class="container" id="#container">
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
            </div>
  <form class="msger-inputarea" method = 'post' action='submit-answer.php?event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
    <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden >
    <input type="text" class="msger-input" id="answer" name="answer" value="" placeholder="Enter your message..." autocomplete=off>
    <button type="submit" class="msger-send-btn">Send</button>
  </form>
</section>
        <?php


    }//RANKING
    else if ($row['poll_type'] == "Ranking"){
    
        ?>
        <head>
        <link href="css/ranking-poll.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="jquery.ui.touch-punch.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        </head>
        <center>
        <div class="poll-container" id="drag_container">
        <h3><?=$row['poll_question']?></h3>
        <h6>note: drag the elements from the left to your desired ranking on the right.</h6>
            <div class='container' >
            <div class="source-container">
            <?php
            for ($i=1; $i < count($exploded)-1; $i++){
            ?>
                <div class='source'>
                <div class='item'>
                    <p><?=($exploded[$i])?></p>
                </div>
                </div>
                
            <?php
            }
            ?>
            
            </div>
            <div class='move-back'>
            </div>
            <div class='destination-container'>
            <?php
            for ($i=1; $i < count($exploded)-1; $i++){
            ?>
            <div class="destination" id="dest<?=$i?>">
                <span  id="ranking"><?=$i?></span>
            </div>
            <?php
            }
            ?>
            
            
            </div>
            
            </div>
            <form id="ranking-form" method = 'post' > 
        <div class="options">
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?>  hidden>
        <input type="text" name="event_id" id="event_id" value=<?php echo $row['event_id']?>  hidden>
        <input type="text" name="poll_code" id="poll_code" value=<?php echo $row['poll_code']?>  hidden>
        </div>
        <button type="submit" id="ranking-form" class="btn btn-primary">Submit Poll</button>
        
        </form> 
  
        
        </div>
        
        <script>//SCRIPT FOR DROPPABLE INPUTS
       
        $(function(){
  
        item_height=$(".item").outerHeight(true);
        height=(item_height+4)*($(".item").length+1);
        $(".source-container,.destination-container").height(height);
        
            

        $(".source .item").draggable({
            revert:"invalid",
            start:function(){
            
            $(this).data("index",$(this).parent().index());
            
            }
        });
        
        $(".destination").droppable({
            drop:function(evern,ui){
                if($(this).has(".item").length){
                    if(ui.draggable.parent().hasClass("source")){
                        index=ui.draggable.data("index");
                        ui.draggable.css({left:"0",top:"0"}).appendTo($(".source").eq(index));
                    }
                    else{
                    ui.draggable.css({left:"0",top:"0"}).appendTo($(this));
                    index=ui.draggable.data("index");
                    $(this).find(".item").eq(0).appendTo($(".destination").eq(index))
                    }
                }
                else{
                ui.draggable.css({left:"1px",top:"1px"});
                ui.draggable.appendTo($(this));
                $(".destination").removeClass("ui-droppable-active");
                }
            }
        });
        
        $(".source").droppable({
            accept: function(draggable) {
                return $(this).find("*").length == 0;
            },
        drop:function(event,ui){
            ui.draggable.css({left:"0",top:"0"}).appendTo($(this))
        }
        })
        })
        $(document).ready(function () {
            
 
           $("#ranking-form").submit(function (event) {
            event.preventDefault();
            var answer_array=[];
            <?php
                for ($index=0; $index < count($exploded)-2; $index++){
                ?>
                var rank=document.getElementsByClassName("destination ui-droppable")[<?=$index?>];
                if (rank.getElementsByTagName("p")[0]==undefined || rank.getElementsByTagName("p")[0]==null){
                    alert("Please be sure to rank all choices.")
                    return false;
                       
                }else{
                    answer_array.push(rank.getElementsByTagName("p")[0].innerHTML+"***");
                }
                
            <?php
                }
                ?>   
                answer_array.push(",");
                $.ajax({
                type: "POST",
                url: "submit-answer-ranking.php?ranking_array="+answer_array+"&username=<?php echo $_SESSION["username"]?>&poll_code=<?php echo $row['poll_code']?>&event_id=<?php echo $row['event_id']?>",
                data: $('#ranking-form').serialize(),
                success : function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 500) {
                        alertify.set('notifier','position', 'top-right');
                        alertify.error(res.message);
                    }else{
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        location.reload(); //reloads the website after submitting for RANKING POLL. 
                    }
                 } 
                });
                
            });
           
            });
        
        </script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        
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
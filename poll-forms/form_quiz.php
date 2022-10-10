<?php
         if(mysqli_num_rows($check_if_answered)){
 
            include 'responses/thankyou_for_submit.php';
        }else{
            
        ?>
<center>
    <div class="poll-container">
       <h1><?=$row["poll_title"]?>
        <form method = 'post' action='ajax/submit-answer-quiz.php?event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
        
        
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
        <?php
         

        }
        ?>
    
    </div>
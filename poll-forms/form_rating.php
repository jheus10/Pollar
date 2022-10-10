<center>
<?php
         if(mysqli_num_rows($check_if_answered)){
 
            include 'responses/thankyou_for_submit.php';
        }else{


        ?>
        <div class="poll-container">
            <div class="question"><?php echo $row['poll_question']?></div>
            <form method = 'post' action='ajax/submit-answer.php?event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
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
    <?php
        }


    ?>
        </div>
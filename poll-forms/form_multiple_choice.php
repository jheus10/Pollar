<center>
        <?php
         if(mysqli_num_rows($check_if_answered)){
 
            include 'responses/thankyou_for_submit.php';
        }else{


        ?>
    <div class="poll-container">
        <div class="question"><?php echo $row['poll_question']?></div>
        <form method = 'post' action='ajax/submit-answer.php?event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
        
        <div class="options">
        <?php
            for ($i=1; $i < count($exploded)-1; $i++){
           echo '<div class="option-child"><input type="radio" name="answer" id="answer" value="'.($exploded[$i]).'" required><input type="text" value="'.($exploded[$i]).'" readonly></div>';
            }
        ?>
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden >
        <button type="submit" class="btn btn-primary">Submit Poll</button>
        </div>
        
          <?php 
        
      
        }

       ?>
        
        
        
        </form>    

    
    </div>
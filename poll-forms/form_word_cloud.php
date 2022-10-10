<center>
    <div class="poll-container">
        <div class="question"><?php echo $row['poll_question']?></div>
        <form method = 'post' action='ajax/submit-answer.php?event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
        
        <div class="options">
       
        <input type="text" id="answer" name="answer" value=""></div>
         
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden >
        </div>
        <button type="submit" class="btn btn-primary">Submit Poll</button>
        </form>    

        </div>
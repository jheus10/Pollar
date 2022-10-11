<center>

    <div class="poll-container">
        <div class="question"><?php echo $row['poll_question']?></div>
        <form method = 'post' action='ajax/submit-answer.php?user_id=<?=$_SESSION["username"]?>&event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
        
        <div class="options">
       
        <input type="text" id="answer" name="answer" value="" ></div>
         <?php
       
            if (!isset($_GET['answer'])){
                
            }else{
                $answer_check=$_GET['answer'];
                if ($answer_check=='empty'){
                    echo "<p style='color:red'>Please answer the poll before submitting</p>";
                    
                }else if($answer_check=='successful'){
                    echo "<p style='color:green'>Answered Successfully</p>";
                }
            }
         ?>
    
        </div>
        <?php
         if(mysqli_num_rows($check_if_answered)){
 
            echo '<button type="submit" class="btn btn-primary">Add another response</button>';
        }else{


        ?>
        <button type="submit" class="btn btn-primary">Submit Poll</button>
        </form>    

        </div>

        <?php
        }
        ?>
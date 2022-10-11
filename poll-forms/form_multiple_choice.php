<center>
        <?php
         if(mysqli_num_rows($check_if_answered)){
 
            include 'responses/thankyou_for_submit.php';
        }else{


        ?>
    <div class="poll-container">
        <div class="question"><?php echo $row['poll_question']?></div>
        <form method = 'post' action='ajax/submit-answer.php?user_id=<?=$_SESSION["username"]?>&event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
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
        <div class="options">
        <?php
            for ($i=1; $i < count($exploded)-1; $i++){
           echo '<div class="option-child"><input type="radio" name="answer" id="answer" value="'.($exploded[$i]).'" ><input type="text" value="'.($exploded[$i]).'" readonly></div>';
            }
        //     $choices_array=json_decode($row['poll_choices']);

        //    print_r(array_values($choices_array));
        ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit Poll</button>
        
        
          <?php 
        
      
        }

       ?>
        
        
        
        </form>    

    
    </div>
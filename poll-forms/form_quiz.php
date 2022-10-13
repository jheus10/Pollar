<?php
         if(mysqli_num_rows($check_if_answered)){
 
            include 'responses/thankyou_for_submit.php';
        }else{
            
        ?>
<center>
    <script>
        function submit_info(){
            if(!confirm('Are you sure you want to submit this quiz?')){
                return false;
            }else{
                return true;
            }
        }
        
        </script>
    <div class="poll-container">
    
       <h1><?=$row["poll_title"]?>
       <?php
       
            if (!isset($_GET['answer'])){
                
            }else{
                $answer_check=$_GET['answer'];
                if ($answer_check=='empty'){
                    echo "<script>alert('Please answer the poll before submitting')</script>";
                    
                }else if($answer_check=='successful'){
                    echo "<p style='color:green'>Answered Successfully</p>";
                }
            }
         ?>
        <form method = 'post' action='ajax/submit-answer-quiz.php?user_id=<?=$_SESSION["username"]?>&event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
        
        
        <?php
       $counter=1;
    
        for ($j=1; $j<count($exploded_quiz_option);$j++){
            $explode=explode("," ,$exploded_quiz_option[$j]);
            if(!empty($exploded_quiz_option[$j])){
            echo '<div class="question">'.$exploded_quiz_question[$j].'</div>';
            }
            for ($f=1; $f<count($explode);$f++){
                if (!empty($explode[$f])){
                echo '<div class="option-child"><input type="radio" name=q-'.$counter.' id=q-'.$counter.' value="'.($explode[$f]).'"><input type="text" value="'.($explode[$f]).'" readonly></div>';
                }
            }
               
                
             $counter++;
         }
         echo '<input type="text" name="counter" id="counter" value='.--$j.' hidden>';
        ?>
        </div>
        <button type="submit" class="btn btn-primary" onclick="return submit_info()">Submit Poll</button>
        </form>    
        <?php
         

        }
        ?>
    
    </div>
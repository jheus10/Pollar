

        <?php
        $event_ids=$_GET['event_id'];
 require_once('../config/config.php');
       
        $poll_type=  mysqli_real_escape_string($link,$_GET['poll_type']);
        $event_id= mysqli_real_escape_string($link,$_GET['event_id']);
        $option_counter= mysqli_real_escape_string($link,$_GET['option_counter']);
        $question_counter= mysqli_real_escape_string($link,$_GET['question_counterbox']);
        $poll_code = mysqli_real_escape_string($link,$_POST['poll_code']);
        $poll_title=mysqli_real_escape_string($link,$_POST['poll_title']);
        $choices_names=json_decode(stripslashes($_GET['json_choices']));
        $quiz_choices = "";
        $questions= ",*/";
        $correct_choice= ",*/";
        $x=0;
        $y=0;
        $z=0;
        
        for($i=0;$i<count($choices_names);$i++){
            if($choices_names[$i]=="--"){
                $quiz_choices.="--";
                $quiz_choices.=",*/";
            }

            else{
                if(!empty($_POST[$choices_names[$i]])){
                $get_choice=mysqli_real_escape_string($link,$_POST[$choices_names[$i]]);
                $quiz_choices.=$get_choice;
                $quiz_choices.=",*/";
                }
            }
        }


  
       while ($y <= $question_counter){
        if (!empty($_POST['quiztextquestion-'.$y])){
            $questions_container = $_POST['quiztextquestion-'.$y];
            $questions .= $questions_container.",*/";    
            $y++;
            }else{
                $y++;
            }
       }
       while($z <= $question_counter){
        if (!empty($_POST['quizoption-question_block'.$z])){
        $quiz_correct_choice = $_POST['quizoption-question_block'.$z];
        $correct_choice .= $quiz_correct_choice.",*/";    
        $z++;
        }else{
        $z++;
        }
    }
        $sql = "INSERT INTO poll_list(poll_type,poll_title,poll_question,poll_correct,poll_choices,poll_code,event_id)  VALUES ('$poll_type','$poll_title',' $questions','$correct_choice','$quiz_choices','$poll_code','$event_id')";
         
        if(mysqli_query($link, $sql)){
            header("Location:../admin-event.php?event_id=".$event_ids);
            $res = [
                'status' => 200,
                '$poll_type' =>  $poll_type,  
                '$event_id' => $event_id, 
                '$option_counter' => $option_counter,
                '$question_counter' => $question_counter,
                '$poll_code' => $poll_code,
                
                '$poll_title' => $poll_title,
                '$correct_choice' => $correct_choice,
                '$choices_names'=>$choices_names,
                '$quiz_choices' => $quiz_choices,
                
            ];
            echo json_encode($res);
            return;
        }else{
            $res = [
                'status' => 500,
                '$poll_type' =>  $poll_type,  
                '$event_id' => $event_id, 
                '$option_counter' => $option_counter,
                '$question_counter' => $question_counter,
                '$poll_code' => $poll_code,
              
                '$poll_title' => $poll_title,
                '$correct_choice' => $correct_choice,
                '$choices_names'=>$choices_names,
            ];
            echo json_encode($res);
            return;
            // Close connection
            mysqli_close($link);
        }
        
        ?>

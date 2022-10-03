<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Page page</title>
</head>
 
<body>
    <center>
        <?php
        $event_ids=$_GET['event_id'];
 require_once('config.php');
       
        $poll_type=  mysqli_real_escape_string($link,$_POST['poll_type']);
        $event_id= mysqli_real_escape_string($link,$_POST['event_id']);
        $option_counter= mysqli_real_escape_string($link,$_POST['option_counter']);
        $question_counter= mysqli_real_escape_string($link,$_POST['question_counterbox']);
        $poll_code = mysqli_real_escape_string($link,$_POST['poll_code']);
        $choices_array=mysqli_real_escape_string($link,$_POST['choices_array']);
        $poll_title=mysqli_real_escape_string($link,$_POST['poll_title']);
        $quiz_choices = ",*/";
        $questions= ",*/";
        $correct_choice= ",*/";
        $x=0;
        $y=0;
        $z=0;
        while($x <= $option_counter){
            if (!empty($_POST['quiztextoption-'.$x])){
            $quiz_choice_container = $_POST['quiztextoption-'.$x];
            $quiz_choices .= $quiz_choice_container.",*/";    
            $x++;
            }else{
            $x++;
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
       while($z <= $option_counter){
        if (!empty($_POST['quizoption-'.$z])){
        $quiz_correct_choice = $_POST['quizoption-'.$z];
        $correct_choice .= $quiz_correct_choice.",*/";    
        $z++;
        }else{
        $z++;
        }
    }
        $sql = "INSERT INTO poll_list(poll_type,poll_title,poll_question,poll_correct,poll_choices,poll_code,event_id)  VALUES ('$poll_type','$poll_title',' $questions','$correct_choice','$choices_array','$poll_code','$event_id')";
         
        if(mysqli_query($link, $sql)){
            header("Location:admin-event.php?event_id=".$event_ids);
        }
         
        // Close connection
        mysqli_close($link);
        ?>
    </center>
</body>
 
</html>
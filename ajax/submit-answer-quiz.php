
<!DOCTYPE html>
<html>
 
<head>
    <title>Submit Page</title>
</head>
 
<body>
    <center>
        <?php
 require_once('../config/config.php');
        
        
        
        $counter = mysqli_real_escape_string($link,$_POST['counter']);
        for ($i=1;$i<=$counter+1;$i++){
        $poll_code =  $_GET['poll_code'];
        $event_id =  $_GET['event_id'];
        $user_id =  mysqli_real_escape_string($link,$_GET['user_id']);
        $poll_answer =  $_POST['q-'.$i];
        // Performing insert query execution
        $sql_correct = "INSERT INTO poll_answers(poll_code,answer_option,answer_status,event_id,user_id)  VALUES ('$poll_code','$poll_answer','correct','$event_id','$user_id')";
        $sql_incorrect = "INSERT INTO poll_answers(poll_code,answer_option,answer_status,event_id,user_id)  VALUES ('$poll_code','$poll_answer','incorrect','$event_id','$user_id')";
        $sql2 = "SELECT * FROM poll_list WHERE event_id = $event_id AND poll_code = $poll_code";
        if(empty($poll_answer)){
            $answer_error="Answer all fields";
            header("Location:../poll.php?answer=empty&event_id=".$event_id."&poll_code=".$poll_code);
            
        }
        else{

        
        $result=mysqli_query($link,$sql2);
        
        $row = $result->fetch_assoc();
        $poll_correct=$row['poll_correct'];
        $exploded_poll_correct=explode(",*/",$poll_correct);
            if ($poll_answer == $exploded_poll_correct[$i]){
                (mysqli_query($link,  $sql_correct));
            }else{
                (mysqli_query($link,  $sql_incorrect));
            }
            
        }
        
    }
        
        header("Location:../poll.php?event_id=".$event_id."&poll_code=".$poll_code);
        ?>
        <script>
            alert('your answer has been recorded');
        </script>
        <?php
        
        // Close connection
        mysqli_close($link);
        ?>
    </center>
    
</body>
 
</html>
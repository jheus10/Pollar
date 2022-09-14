
<!DOCTYPE html>
<html>
 
<head>
    <title>Submit Page page</title>
</head>
 
<body>
    <center>
        <?php
 require_once('config.php');
        $poll_answer =  $_POST['answer'];
        $poll_code =  $_GET['poll_code'];
        $event_id =  $_GET['event_id'];
        $user_id =  $_POST['user_id'];
        // Performing insert query execution
        $sql = "INSERT INTO poll_answers(poll_code,answer_option,event_id,user_id)  VALUES ('$poll_code','$poll_answer','$event_id','$user_id')";
         
        if(mysqli_query($link, $sql)){
            header("Location:poll.php?event_id=".$event_id."&poll_code=".$poll_code);
        ?>
        <script>
            alert('your answer has been recorded');
        </script>
        <?php
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($link);
        }
         
        // Close connection
        mysqli_close($link);
        ?>
    </center>
    
</body>
 
</html>
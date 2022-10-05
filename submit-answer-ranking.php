
<?php
 require_once('config.php');
        
 if(isset($_POST["ranking_array"]) && !empty($_POST["ranking_array"])){
        $poll_answer = mysqli_real_escape_string($link,$_POST['ranking_array']);
        $poll_code= mysqli_real_escape_string($link,$_POST['poll_code']);
        $event_id= mysqli_real_escape_string($link,$_POST['event_id']);
        $user_id =  mysqli_real_escape_string($link,$_POST['user_id']);
        // Performing insert query execution
        $sql = "INSERT INTO poll_answers(poll_code,answer_option,event_id,user_id)  VALUES ('$poll_code','$poll_answer','$event_id','$user_id')";
        
        
        if(mysqli_query($link,  $sql)){
            $res = [
                'status' => 200,
                'message' => 'Answered successfully.',
                'poll_code' => $poll_code,
                'event_id' => $event_id,
                'poll_answer' => $poll_answer, 
                'user_id' => $user_id, 
            ];
            echo json_encode($res);
            return;
            header("Location:poll.php?event_id=".$event_id."&poll_code=".$poll_code);
        }else{
            $res = [
                'status' => 500,
                'message' => 'Unsuccessful.',   
            ];
            echo json_encode($res);
            return;
            
        }
 }  else{
    $res = [
        'status' => 500,
        'message' => 'Please fill out all fields.',   
    ];
    echo json_encode($res);
    return;
    
}
  
        // Close connection
        mysqli_close($link);
        
        ?>

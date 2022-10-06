
<?php
 require_once('config.php');
        
 if(isset($_POST["ranking_array"]) && !empty($_POST["ranking_array"])){
        $poll_answer = mysqli_real_escape_string($link,$_POST['ranking_array']);
        $poll_code= mysqli_real_escape_string($link,$_POST['poll_code']);
        $event_id= mysqli_real_escape_string($link,$_POST['event_id']);
        $user_id =  mysqli_real_escape_string($link,$_POST['user_id']);
        // Performing insert query execution
        
        $trimmed=trim($poll_answer);
        $exploded = explode("***," ,$trimmed);
        $ranking_score=count($exploded);
        for($i=0; $i <= count($exploded)-2; $i++ ){
            //if(!empty($exploded[$i])){
                $ranking_score--;
                $sql = "INSERT INTO poll_answers(poll_code,answer_option,answer_status,event_id,user_id)  VALUES ('$poll_code','$exploded[$i]',$ranking_score,'$event_id','$user_id')";
                if(mysqli_query($link,  $sql)){
                   
                    $res = [
                        'status' => 200,
                        'message' => 'Answered successfully.',
                        'poll_code' => $poll_code,
                        'event_id' => $event_id,
                        'poll_answer_raw' => $poll_answer, 
                        'poll_answer' => $exploded, 
                        'user_id' => $user_id, 
                    ];
                    echo json_encode($res);
                    header("Location:poll.php?event_id=".$event_id."&poll_code=".$poll_code);
                    
                }else{
                    $res = [
                        'status' => 500,
                        'message' => 'Unsuccessful.',   
                        'poll_code' => $poll_code,
                        'event_id' => $event_id,
                        'poll_answer' => $exploded, 
                        'user_id' => $user_id, 
                    ];
                    echo json_encode($res);
                    return;
                    
                }
            // }else{
            //     continue;
            // }
            
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

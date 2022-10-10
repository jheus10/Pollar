
<?php
 require_once('../config/config.php');
        
 if(isset($_GET["ranking_array"]) && !empty($_GET["ranking_array"])){
        $poll_answer = mysqli_real_escape_string($link,$_GET['ranking_array']);
        $poll_code= mysqli_real_escape_string($link,$_GET['poll_code']);
        $event_id= mysqli_real_escape_string($link,$_GET['event_id']);
        $user_id =  mysqli_real_escape_string($link,$_GET['username']);
        // Performing insert query execution
        
        $trimmed=trim($poll_answer);
        $exploded = explode("***," ,$trimmed);
        $ranking_score=count($exploded);
        for($i=0; $i <= count($exploded)-2; $i++ ){
                $ranking_score--;
                $sql = "INSERT INTO poll_answers(poll_code,answer_option,answer_status,event_id,user_id)  VALUES ('$poll_code','$exploded[$i]',$ranking_score,'$event_id','$user_id')";
                mysqli_query($link,  $sql);
                
        
            
        }

                   
            $res = [
                'status' => 200,
                'message' => 'Answered successfully.',
    
            
            ];
            echo json_encode($res);
            
            return;
       
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

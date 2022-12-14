
<?php
// Process delete operation after confirmation
if(isset($_POST["event_id"]) && !empty($_POST["event_id"])){
    // Include config file
    require_once "../config/config.php";
    $event_id= mysqli_real_escape_string($link,$_POST['event_id']);  
    $poll_code= mysqli_real_escape_string($link,$_POST['poll_code']);  
    // Prepare a delete statement
    $sql = "SELECT * FROM poll_list WHERE event_id = $event_id AND poll_code = $poll_code";
    $result = $link->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()){ 
        $trimmed=trim($row['poll_choices']);
           $exploded = explode(",*/" ,$trimmed);
        if ($row['poll_type']=="Multiple Choice"){
        $result3 = $link->query("SELECT COUNT(*)/100 as total FROM poll_answers WHERE event_id = $event_id AND poll_code = $poll_code");
          $row3 = $result3->fetch_row();
          $data_labels=array();
          $data_values=array();
              for ($i=1; $i < count($exploded)-1; $i++){
          $sql2 = "SELECT * FROM poll_answers WHERE event_id = $event_id AND poll_code = $poll_code AND answer_option='$exploded[$i]'";
          $result2 = mysqli_query($link, $sql2);
              try{
                array_push($data_labels, $exploded[$i]);
                array_push($data_values,(mysqli_num_rows($result2))/$row3[0]);
              }catch (DivisionByZeroError $e){
                array_push($data_values,mysqli_num_rows($result2));
              }
              }
            $res = [
                'status' => 200,
                'message' => 'View successfully.',
                'poll_question' => $row['poll_question'],
                'data_labels' => $data_labels,
                'data_values' => $data_values,
                'poll_type' =>$row['poll_type'],
               
                
            ];
            echo json_encode($res);
            return;
        }elseif ($row['poll_type']=="Word Cloud"){
          $sql2="SELECT answer_option, COUNT(*) as total_answers FROM poll_answers WHERE poll_code=$poll_code AND event_id =$event_id GROUP BY answer_option";
          if ($result2 = mysqli_query($link, $sql2)) {
            $word_cloud_arrayContainer=array();
            while( $row2 = $result2->fetch_assoc()){       
              $wordz_cloud_arrayContainer["key"]=$row2["answer_option"];
              $wordz_cloud_arrayContainer["value"]=$row2["total_answers"];
              array_push($word_cloud_arrayContainer,$wordz_cloud_arrayContainer);
              
            }    
            $res = [
              'status' => 200,
              'message' => 'View successfully.',
              'poll_question' => $row['poll_question'],
              'data_values' => $word_cloud_arrayContainer,
              'poll_type' =>$row['poll_type'],
            ];
            echo json_encode($res);
            return;
          }
              
        }
        elseif ($row['poll_type']=="Quiz"){
          $sql2="SELECT user_id, COUNT(*) as total FROM `poll_answers` WHERE event_id=$event_id AND poll_code=$poll_code AND answer_status='correct' GROUP BY user_id ORDER BY total DESC";
          $sql3="SELECT SUM(length(poll_question) - length(replace(poll_question, ',', '')) -1) AS TotalCount FROM poll_list WHERE poll_code = $poll_code AND event_id= $event_id";
          $result3 = mysqli_query($link, $sql3);
          $row3 = $result3->fetch_assoc();
          if ($result2 = mysqli_query($link, $sql2)) {
            $top_contestants=array();
            $total_correct=array();
            while( $row2 = $result2->fetch_assoc()){       
              
              array_push($top_contestants,$row2['user_id']);
              array_push($total_correct,$row2['total']);
              
            }    
            $res = [
              'status' => 200,
              'message' => 'View successfully.',
              'poll_question' => $row['poll_title'],
              'data_labels' => $top_contestants,
              'data_values' => $total_correct,
              'TotalCount' => $row3['TotalCount'],
              'poll_type' =>$row['poll_type'],
            ];
            echo json_encode($res);
            return;
          }
              
        }elseif ($row['poll_type']=="Rating"){
          $data_labels=[];
         
          $data_values=[];
          for ($i=1;$i<=$row['poll_correct'];$i++){
            $sql1="SELECT * FROM poll_answers WHERE answer_option=$i AND event_id=$event_id AND poll_code=$poll_code ";
            ($result1 = mysqli_query($link, $sql1)); 
            array_push($data_values,mysqli_num_rows($result1));
          }
          for($j=1; $j<=$row['poll_correct'];$j++){
            array_push($data_labels,$j."???");
          }
          
      
            $res = [
              'status' => 200,
              'message' => 'View successfully.',
              'poll_question' => $row['poll_question'],
              'data_labels' => $data_labels,
              'data_values' => $data_values,
              'poll_type' =>$row['poll_type'],
              
            ];
            echo json_encode($res);
            return;
          
              
        }
        elseif ($row['poll_type']=="Open Text"){
          $sql2="SELECT * FROM poll_answers WHERE poll_code=$poll_code AND event_id =$event_id";
          if ($result2 = mysqli_query($link, $sql2)) {
            $messages_Container=array();
            $userid_Container=array();
            while( $row2 = $result2->fetch_assoc()){       
            
              array_push($messages_Container,$row2['answer_option']);
              array_push($userid_Container,$row2['user_id']);
            }    
            $res = [
              'status' => 200,
              'message' => 'View successfully.',
              'poll_question' => $row['poll_question'],
              'user_id' => $userid_Container,
              'messages' => $messages_Container,
              'poll_type' =>$row['poll_type'],
            ];
            echo json_encode($res);
            return;
          }
              
        }elseif ($row['poll_type']=="Ranking"){
          $data_labels=array();
          $data_values=array();
              
          $sql4 = "SELECT * , avg(answer_status) as answer_rank FROM poll_answers WHERE event_id = $event_id AND poll_code = $poll_code GROUP BY answer_option ORDER BY answer_rank desc";
          $result4 = mysqli_query($link, $sql4);
          while($row4 = $result4->fetch_assoc()){ 
            array_push($data_labels, $row4['answer_option']);
            array_push($data_values, number_format((float)$row4['answer_rank'], 2, '.', ''));
          }
          
            $res = [
              'status' => 200,
              'message' => 'View successfully.',
              'poll_question' => $row['poll_question'],
              'data_labels' => $data_labels,
              'data_values' => $data_values,
              'poll_type' =>$row['poll_type'],
              
            ];
            echo json_encode($res);
            return;
          
              
        }

    }
        
        
        
    }else{
        $res = [
            'status' => 500,
            'message' => 'Cannot Show this Poll'
        ];
        echo json_encode($res);
        return;
        echo "0 results";
      }

     
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["event_id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>


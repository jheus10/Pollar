
<?php
// Process delete operation after confirmation
if(isset($_POST["event_id"]) && !empty($_POST["event_id"])){
    // Include config file
    require_once "config.php";
    $event_id= $_POST['event_id'];  
    $poll_code= $_POST['poll_code'];  
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
        ?>
    <?php
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
        
        
        
      } 
      
      
      else {
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


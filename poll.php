<?php
session_start();
 
require_once('config.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    $_SESSION["username"] = "anonymous";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/poll.css">
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

</head>
<body>
    <?php
   
      $event_id= $_GET['event_id'];  
      $poll_code= $_GET['poll_code'];  
      $sql = "SELECT * FROM poll_list WHERE event_id = $event_id AND poll_code = $poll_code";
      $sql2 = "SELECT * FROM event_list WHERE id = $event_id";
      $result2 = mysqli_query($link, $sql2);
      
        while ($row2 = $result2->fetch_assoc()) {
            if ($row2['active_status']==1){
      if ($result = mysqli_query($link, $sql)) {
        // Fetch one and one row
        while ($row = $result->fetch_assoc()) {
            $trimmed=trim($row['poll_choices']);
            $exploded = explode("," ,$trimmed);
            
            
        ?>

    <center>
    <div class="poll-container" id="options">
        <div class="question"><?php echo $row['poll_question']?></div>
        <form method = 'post' action='submit-answer.php?event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
        
        <div class="options" >
        <?php
            for ($i=1; $i < count($exploded)-1; $i++){
           echo '<div class="option-child"><input type="radio" name="answer" id="answer" value="'.($exploded[$i]).'"required><input type="text" value="'.($exploded[$i]).'" readonly></div>';
            }
        ?>
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden >
        </div>
        <button type="submit" class="btn btn-primary">Submit Poll</button>
        </form>    

    
    </div>
    <?php
        }
        mysqli_free_result($result);
      }
    } 
    else{
        echo "<center>Poll not active";
    }
    }
      mysqli_close($link);
      ?>
      <!-- <script>
   $(document).ready(function(){
   window.setInterval(function(){
     $("#options").load(window.location.href + " #options" ).fadeIn('slow');
   }, 1000);
   });
</script> -->
</body>
</html>
<?php
session_start();
 
require_once('config.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
</head>
<body>
    <?php
   
      $event_id= $_GET['event_id'];  
      $poll_code= $_GET['poll_code'];  
      $sql = "SELECT * FROM poll_list WHERE event_id = $event_id AND poll_code = $poll_code";

      if ($result = mysqli_query($link, $sql)) {
        // Fetch one and one row
        while ($row = $result->fetch_assoc()) {
            $trimmed=trim($row['poll_choices']);
            $exploded = explode("," ,$trimmed);
            
            
        ?>

    <center>
    <div class="poll-container">
        <div class="question"><?php echo $row['poll_question']?></div>
        <form method = 'post' action='submit-answer.php?event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
        
        <div class="options">
        <?php
            for ($i=1; $i < count($exploded)-1; $i++){
           echo '<div class="option-child"><input type="radio" name="answer" id="answer" value="'.($exploded[$i]).'"><input type="text" value="'.($exploded[$i]).'" ></div>';
            }
        ?>
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> >
        </div>
        <button type="submit" class="btn btn-primary">Create Poll</button>
        </form>    

    
    </div>
    <?php
        }
        mysqli_free_result($result);
      }

      mysqli_close($link);
      ?>
</body>
</html>
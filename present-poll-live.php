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
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <script>
            $(document).ready(function(){
                $('#answer').load("http://localhost/miles-polling/present-poll.php?event_id=6&poll_code=4575508");
            });
            </script>
    <div class="poll-container">
        <div class="question"><?php echo $row['poll_question']?></div>
        
        <div class="options" id="options">
        <?php
        //$sql3 = "SELECT COUNT(*)*100 as total FROM poll_answers WHERE event_id = $event_id AND poll_code = $poll_code";
        $result3 = $link->query("SELECT COUNT(*)/100 as total FROM poll_answers WHERE event_id = $event_id AND poll_code = $poll_code");
        $row3 = $result3->fetch_row();
            for ($i=1; $i < count($exploded)-1; $i++){
        $sql2 = "SELECT * FROM poll_answers WHERE event_id = $event_id AND poll_code = $poll_code AND answer_option='$exploded[$i]'";
        $result2 = mysqli_query($link, $sql2);
           echo '<div class="option-child" id="mydiv"><input type="text" value="'.($exploded[$i]).'" readonly><br><div class="progress"><div class="progress-bar" role="progressbar" style="width:'.((mysqli_num_rows($result2))/$row3[0]).'%;"aria-valuenow="'.((mysqli_num_rows($result2))/$row3[0]).'" aria-valuemin="0" aria-valuemax="100">'.((mysqli_num_rows($result2))/$row3[0]).'%</div></div>';
            }
        ?>
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden >
        </div>
       

    
    </div>
    <?php
        }
        mysqli_free_result($result);
      }

      mysqli_close($link);
      ?>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>

   $(document).ready(function(){
   window.setInterval(function(){
     $("#options").load(window.location.href + " #options" );
   }, 1000);
   });


</script>
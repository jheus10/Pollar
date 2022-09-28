<?php
// Initialize the session

session_start();
require_once('config.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$_SESSION['event_id'] = $_GET['event_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Event List</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="css/admin.css" rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
       
<script language="Javascript">
  var option_counter=1;
  var question_counter=1;
  const textquestion="quizquestion-";
const labelquestion="quiztextquestion-";
const textoption="option-";
const labeloption="textoption-";

function add_choices_multiple_choice() {

	//Create an input type dynamically.
 
  var div = document.createElement("div");
  var radio = document.createElement("input");
  var radio_value=document.getElementById('select_option').value;
  div.setAttribute('class','form-group');
  div.setAttribute('id','box_'+option_counter);
  radio.setAttribute('class','form-group');
  radio.setAttribute('type','radio');
  radio.setAttribute('id','box_'+option_counter);
  radio.setAttribute('name','options');
  radio.setAttribute('value',radio_value);
  var textbox = "<input type='radio' name='options_radio' value='"+radio_value+"'><input type='text' value='"+radio_value+"' name='"+labeloption+option_counter+"' id='"+labeloption+option_counter+"' readonly> <input type='button' value='-' onclick='removeBox(this)'>"

	var foo = document.getElementById("choices");
      div.innerHTML=textbox;

      foo.appendChild(div);
      document.getElementById('counterbox').value=option_counter;
      option_counter=option_counter+1;
  
}
function add_question() {

var div = document.createElement("div");
var question = document.createElement("input");
var question_value=document.getElementById('add_quiz_question').value;
div.setAttribute('class','form-group');
div.setAttribute('id','box_'+question_counter);
question.setAttribute('class','form-group');
question.setAttribute('type','text');
question.setAttribute('id','box_'+question_counter);
question.setAttribute('name','question');
question.setAttribute('value',question_value);

var textbox = "<div class='question_block' id='question_block'><span id='quiz_question'><input type='text' value='"+question_value+"' name='"+labelquestion + question_counter+"' id='"+labelquestion + question_counter+"' readonly> <input type='button' value='-' onclick='removeBox(this)'></span>"
var concat_question = document.getElementById("quiz_container");
    div.innerHTML=textbox;

    concat_question.appendChild(div);
    document.getElementById('question_counterbox').value=question_counter;
    question_counter=question_counter+1;
}
function add_choices_quiz() {

if (document.getElementById('select_option_quiz').value){


//Create an input type dynamically.
const textoption="quizoption-";
const labeloption="quiztextoption-";
var div = document.createElement("div");
var radio = document.createElement("input");
var radio_value=document.getElementById('select_option_quiz').value;
div.setAttribute('class','form-group');
div.setAttribute('id','box_'+option_counter);
radio.setAttribute('class','form-group');
radio.setAttribute('type','radio');
radio.setAttribute('id','box_'+option_counter);
radio.setAttribute('name','options');
radio.setAttribute('value',radio_value);
var textbox = "<input type='radio' name='"+textoption + question_counter+"' value='"+radio_value+"' required><span name='span-" + question_counter+"' id='span-" + question_counter+"' ><input type='text' value='"+radio_value+"' name='"+labeloption+option_counter+"' id='"+labeloption+option_counter+"' readonly></span> <input type='button' value='-' onclick='removeBox(this)'>"

var foo = document.getElementById("quiz_container");
    div.innerHTML=textbox;

    foo.appendChild(div);
    document.getElementById('option_counter').value=option_counter;
    option_counter=option_counter+1;
  }
}

function removeBox(ele){
  ele.parentNode.remove();
}
//array of delimited choices per question





		</script>
</head>
<body>
<div class="dropdown">
    <div class="textbox"><li><a>Create Poll</a></li></div>
    
<!-- Poll Choices -->    
        <div class="option">
            <div><button type="button" class="create-event" data-toggle="modal" data-target="#add-event-multiple"><ion-icon name="list-outline"></ion-icon>Multiple Choice</button></div>
            <div><button type="button" class="create-event" data-toggle="modal" data-target="#add-event-wordcloud"><ion-icon name="list-outline"></ion-icon>Word Cloud</button></div>
            <div><button type="button" class="create-event" data-toggle="modal" data-target="#add-event-quiz"><ion-icon name="list-outline"></ion-icon>Quiz</button></div>

        </div>
        
    </div>
<a href="analytics.php?event_id=<?=$_SESSION['event_id']?>" >Analytics</a>
<!-- Multiple Choice Modal -->
<div class="modal fade" id="add-event-multiple" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Multiple Choice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="create-poll.php?event_id=<?= $_SESSION['event_id']?>" method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php echo(rand(1000000,9999999)); ?>" readonly/>
        <input type="text" name="multiple_question" id="multiple_question" placeholder="What would you like to ask?" required/><br>
        
        <input type="text" value="Multiple Choice" name="poll_type" id="poll_type" hidden/>  
        <input type="text" value="<?= $_SESSION['event_id']?>" name="event_id" id="event_id" hidden/>  
        <input type="text" value="" name="counterbox" id="counterbox"  hidden/>  
        
        <input type="text" value="" name="select_option" id="select_option"/><input type="button" value="add option" onclick="add_choices_multiple_choice()"/>
    
		<span id="choices">&nbsp;</span>
            
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create Poll</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Word Cloud Modal -->
<div class="modal fade" id="add-event-wordcloud" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Multiple Choice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="create-poll.php?event_id=<?php echo $_SESSION['event_id']?>" method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php echo(rand(1000000,9999999)); ?>" readonly/>
        <input type="text" name="multiple_question" id="multiple_question" placeholder="What would you like to ask?" required/><br>
        
        <input type="text" value="Word Cloud" name="poll_type" id="poll_type" hidden/>  
        <input type="text" value="<?php echo $_SESSION['event_id']?>" name="event_id" id="event_id" hidden/>  
        <input type="text" value="" name="counterbox" id="counterbox" hidden />  
        
       
            
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create Poll</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Quiz Modal -->
<div class="modal fade" id="add-event-quiz" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Quiz</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  id="quiz-form" action="create-poll-quiz.php?event_id=<?= $_SESSION['event_id']?>" method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php echo(rand(1000000,9999999)); ?>" readonly/>
        <input type="text" value="" name="poll_title" id="poll_title" placeholder="Enter Quiz Title" /><br> 
        <input type="text" name="add_quiz_question" id="add_quiz_question" placeholder="What would you like to ask?" required/><input type="button" value="add question" onclick="add_question()"/>
        
        <input type="text" value="Quiz" name="poll_type" id="poll_type" hidden/>  
        <input type="text" value="<?= $_SESSION['event_id']?>" name="event_id" id="event_id" hidden />  
        <input type="text" value="" name="option_counter" id="option_counter"  hidden />  
        <input type="text" value="" name="question_counterbox" id="question_counterbox" hidden  /> 
        <input type="text" value="" name="choices_array" id="choices_array"  hidden /> 
        <input type="text" value="" name="select_option_quiz" id="select_option_quiz"/><input type="button" value="add option" onclick="add_choices_quiz()"/>
    <div class="quiz_container" id='quiz_container'>

        
    </div>     
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-poll-quiz" class="btn btn-primary">Create Poll</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="flex-container">
  <div class="my_polls" id="my_polls">
  <?php
$event_id=$_GET['event_id'];
$sql = "SELECT * FROM poll_list WHERE event_id = $event_id ";
$result = $link->query($sql);

if ($result = mysqli_query($link, $sql)) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if ($row['poll_type']=="Quiz"){
    echo ' <div class="child--poll" id="child--poll">';
    echo '<div class="child--content">';
    echo '<input type="text" value='.$row['id'].'" hidden>';
    echo '<h3>'.$row['poll_type'].'</h3>';
    echo '<h2>'.$row['poll_title'].'</h2>';
    echo "</div>";
    echo '<div class="button-wrapper-present"><a class="view-button" name="view-poll" target="_blank" href="present-poll-live.php?event_id='.$row['event_id'].'&poll_code='.$row['poll_code'].'">Present</a></div>';
    echo '<div class="button-wrapper-copy"><a class="view-button" name="view-poll" onclick="copy(this.id)" id="poll.php?event_id='.$row['event_id'].'&poll_code='.$row['poll_code'].'" href="#">Copy </a></div>'; 
    //echo '<div class="button-wrapper-view"><a class="view-button" name="view-poll" onclick="update(this.id)" id="present-poll.php?event_id='.$row['event_id'].'&poll_code='.$row['poll_code'].'" href="#">View </a></div>'; 
    echo '<div class="button-wrapper-delete"><button class="view-button" id="deletePollBtn" value='.$row['id'].'>Delete</button></div>';
    echo "</div>";

    }
    else if($row['poll_type']=="Word Cloud" || $row['poll_type']=="Multiple Choice"){
    
    echo ' <div class="child--poll" id="child--poll">';
    echo '<div class="child--content">';
    echo '<input type="text" value='.$row['id'].'" hidden>';
    echo '<h3>'.$row['poll_type'].'</h3>';
    echo '<h2>'.$row['poll_question'].'</h2>';
    echo "</div>";
    echo '<div class="button-wrapper-present"><a class="view-button" name="view-poll" target="_blank" href="present-poll-live.php?event_id='.$row['event_id'].'&poll_code='.$row['poll_code'].'">Present</a></div>';
    echo '<div class="button-wrapper-copy"><a class="view-button" name="view-poll" onclick="copy(this.id)" id="poll.php?event_id='.$row['event_id'].'&poll_code='.$row['poll_code'].'" href="#">Copy </a></div>'; 
    //echo '<div class="button-wrapper-view"><a class="view-button" name="view-poll" onclick="update(this.id)" id="present-poll.php?event_id='.$row['event_id'].'&poll_code='.$row['poll_code'].'" href="#">View </a></div>'; 
    echo '<div class="button-wrapper-delete"><button class="view-button" id="deletePollBtn" value='.$row['id'].'>Delete</button></div>';
    echo "</div>";
  }else {
  echo "0 results";
  } 
  }
}
?>
  </div>
  
  <!-- <div class="poll_preview" id="poll_preview"><div class="poll_question" id="poll_question"></div></div> -->
</div>
<script>
    
     $(document).ready(function(){

          
          $("#submit-poll-quiz").on("click",function(e) {
            
            var choices_array=[];
            var event_id=<?=$_SESSION['event_id']?>;
            var poll_code= document.getElementById('poll_code').value;
            var username = '<?=$_SESSION["username"]?>';
        
            var x=2;
            while(x<=question_counter){
            var divIds = $.map($('#span-'+ x+'> input'), span => span.value);
            choices_array.push("//-");
              for (var i=0; i<divIds.length;i++){
                choices_array.push(divIds[i]);
                
              }           
              x++
            };
            document.getElementById('choices_array').value=choices_array;
           
          
          });
        });
        </script>
<script>
  $(document).on('click', '#deletePollBtn', function (e) {
            e.preventDefault();
            
            if(confirm('Are you sure you want to delete this data?'))
            {
              var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "delete-poll.php",
                    data: {
                        'id': id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);
                            $('#my_polls').load(location.href + " #my_polls");
                        }
                    }
                });
            }
        });
</script>
<script>

let dropdown=document.querySelector('.dropdown'); 
dropdown.onclick=function(){
    dropdown.classList.toggle('active');
} //dropdown nav
</script>
           
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>
<script>
  function copy(copy_id) {
  // Get the text field
  const link="http://localhost/miles-polling/";


   // Copy the text inside the text field
  navigator.clipboard.writeText(link+copy_id);

  // Alert the copied text
  alert("Copied the text: " + link+copy_id);
}
 function update(button_id)
{
 
        $(document).ready(function(){
       
          $("#poll_question").load(button_id);         
      });
    }
        </script>
          <!-- <script>
   $(document).ready(function(){
   window.setInterval(function(){
     $("#poll_question").load(window.location.href + " #poll_question" );
   }, 5000);
   });
</script>  -->
</html>
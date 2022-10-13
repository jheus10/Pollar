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
        <form  id="quiz-form" action="ajax/create-poll-quiz.php?event_id=<?= $_SESSION['event_id']?>" method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php poll($link) ?>" readonly/>
        <input type="text" value="" name="poll_title" id="poll_title" placeholder="Enter Quiz Title" />
        <input type="button" value="add question" onclick="add_question()"/>      
        <input type="text" value="Quiz" name="poll_type" id="poll_type" hidden/>  
        <input type="text" value="<?= $_SESSION['event_id']?>" name="event_id" id="event_id" hidden />  
        <input type="text" value="" name="option_counter" id="option_counter"  hidden />  
        <input type="text" value="" name="question_counterbox" id="question_counterbox" hidden  /> 
        <input type="text" value="" name="choices_array" id="choices_array"  hidden /> 
        
    <div class="quiz_container" id='quiz_container'>

        
    </div>     
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  type="submit" id="submit-poll-quiz" class="btn btn-primary">Create Poll</button>
        </form>

        <script>
      
  </script>
      </div>
    </div>
  </div>
</div>
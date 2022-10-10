<div class="modal fade" id="add-event-rating" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Rating</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  action="ajax/create-poll.php?event_id=<?= $_SESSION['event_id']?>" method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php poll($link) ?>" readonly/><br>
        <input type="text" name="rating_question" id="rating_question" placeholder="What would you like to ask?" required/><br>

        <input type="text" value="Rating" name="poll_type" id="poll_type" hidden/>  
        <input type="text" value="<?= $_SESSION['event_id']?>" name="event_id" id="event_id" hidden />  
    <div class="quiz_container" id='quiz_container'>
      <span id="max_text">Max Value: </span><input type="text" id="max_value" name="max_value" value="5" readonly/>
      
    <ul class="rate-area">
    <?php 
       
        for ($i=10; $i>=1; $i--){
          echo ($i ===5) ? '<input type="radio" id="'.($i).'-star" name="answer" value="'.($i).'" onclick="star_rate(event)" checked/><label for="'.($i).'-star">'.($i).' stars</label>' :
          '<input type="radio" id="'.($i).'-star" name="answer" value="'.($i).'" onclick="star_rate(event)"/><label for="'.($i).'-star">'.($i).' stars</label>';
        }
        
        ?>
      
    </ul>
    <script>
      function star_rate(event){
     
        document.getElementById('max_value').value=event.target.value;
      }
       
      </script>  
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
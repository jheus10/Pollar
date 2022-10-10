<div class="modal fade" id="add-event-ranking" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ranking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="ajax/create-poll.php?event_id=<?= $_SESSION['event_id']?>" method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php poll($link) ?>" readonly/><br>
        <input type="text" name="ranking_question" id="ranking_question" placeholder="What would you like to ask?" required/><br>
        
        <input type="text" value="Ranking" name="poll_type" id="poll_type" hidden/>  
        <input type="text" value="<?= $_SESSION['event_id']?>" name="event_id" id="event_id" hidden/>  
        <input type="text" value="" name="counterbox_ranking" id="counterbox_ranking"  hidden/>  
        
        <input type="text" value="" name="select_option_ranking" id="select_option_ranking"/><input type="button" value="add option" onclick="add_choices_ranking()"/>
    
		<span id="choices_ranking">&nbsp;</span>
            
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
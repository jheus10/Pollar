<div class="modal fade" id="add-event-wordcloud" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Word Cloud</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="ajax/create-poll.php?event_id=<?php echo $_SESSION['event_id']?>" method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php poll($link) ?>" readonly/>
        <input type="text" name="wordcloud_question" id="wordcloud_question" placeholder="What would you like to ask?" required/><br>
        
        <input type="text" value="Word Cloud" name="poll_type" id="poll_type" hidden/>  
        <input type="text" value="<?php echo $_SESSION['event_id']?>" name="event_id" id="event_id" hidden/>  
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
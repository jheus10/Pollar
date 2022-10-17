<div class="modal fade" id="add-event-wordcloud" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
<script>
    function discardChanges_wordcloud(){
      if($('#wordcloud_question').val()){
        
      
        $('#discard_message_wordcloud').modal('show');
        
        }
        else{
        $('#add-event-wordcloud').modal('toggle');
      }
      
      }
      function discard_wordcloud(){
        
        $('#add-event-wordcloud').on('hidden.bs.modal', function () {
        $(this).find('#wordcloud_form').trigger('reset');
        
        });
        $('#add-event-wordcloud').modal('toggle');
        $('#discard_message_wordcloud').modal('toggle');
        $("#wordcloud_form").load(location.href + " #wordcloud_form");
      }
      function close_wordcloud(){
        $('#discard_message_wordcloud').modal('toggle');
      }
    </script>

<!-- Modal -->
<div class="modal fade" id="discard_message_wordcloud" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Unsaved changes</h5>
      </div>
      <div class="modal-body">
      Would you like to close without saving current poll?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="close_wordcloud()">Cancel</button>
        <button type="button" class="btn btn-danger" id="discard_change" onclick="discard_wordcloud()">Discard changes</button>
      </div>
    </div>
  </div>
</div>

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Word Cloud</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        <form action="ajax/create-poll.php?event_id=<?php echo $_SESSION['event_id']?>" id="wordcloud_form" method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php poll($link) ?>" readonly/>
        <input type="text" name="wordcloud_question" id="wordcloud_question" placeholder="What would you like to ask?" required/><br>
        
        <input type="text" value="Word Cloud" name="poll_type" id="poll_type" hidden/>  
        <input type="text" value="<?php echo $_SESSION['event_id']?>" name="event_id" id="event_id" hidden/>  
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="discardChanges_wordcloud()">Close</button>
        <button type="submit" class="btn btn-primary">Create Poll</button>
        </form>
      </div>
    </div>
  </div>
</div>
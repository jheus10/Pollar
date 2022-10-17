<div class="modal fade" id="add-event-opentext" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
<script>
  
    function discardChanges_opentext(){
      if($('#opentext_question').val()){
        
      
        $('#discard_message_opentext').modal('show');
        
        }
        else{
        $('#add-event-opentext').modal('toggle');
      }
    }
      
      
      function discard_opentext(){
        
        $('#add-event-opentext').on('hidden.bs.modal', function () {
        $(this).find('#opentext_form').trigger('reset');
        
        });
        $('#add-event-opentext').modal('toggle');
        $('#discard_message_opentext').modal('toggle');
        $("#opentext_form").load(location.href + " #opentext_form");
      }
      function close_opentext(){
        $('#discard_message_opentext').modal('toggle');
      }
    </script>

<!-- Modal -->
<div class="modal fade" id="discard_message_opentext" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Unsaved changes</h5>
      </div>
      <div class="modal-body">
      Would you like to close without saving current poll?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="close_opentext()">Cancel</button>
        <button type="button" class="btn btn-danger" id="discard_change" onclick="discard_opentext()">Discard changes</button>
      </div>
    </div>
  </div>
</div>





  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Open Text</h5>
        <!-- <button type="button" class="close" onclick=" discardChanges_opentext()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        <form action="ajax/create-poll.php?event_id=<?php echo $_SESSION['event_id']?>" id="opentext_form" method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php poll($link) ?>" readonly/>
        <input type="text" name="opentext_question" id="opentext_question" placeholder="What would you like to ask?" required/><br>
        
        <input type="text" value="Open Text" name="poll_type" id="poll_type" hidden/>  
        <input type="text" value="<?php echo $_SESSION['event_id']?>" name="event_id" id="event_id" hidden/>   
         
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick=" discardChanges_opentext()">Close</button>
        <button type="submit" class="btn btn-primary">Create Poll</button>
        </form>
      </div>
    </div>
  </div>
</div>
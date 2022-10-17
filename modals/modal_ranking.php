<div class="modal fade" id="add-event-ranking" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
<script>
  
    function discardChanges_ranking(){
      if($('#ranking_question').val()){
        
      
        $('#discard_message_ranking').modal('show');
        
        }
        else{
        $('#add-event-ranking').modal('toggle');
      }
      
      }
      function discard_ranking(){
        
        $('#add-event-ranking').on('hidden.bs.modal', function () {
        $(this).find('#ranking_form').trigger('reset');
        
        });
        $('#add-event-ranking').modal('toggle');
        $('#discard_message_ranking').modal('toggle');
        $("#ranking_form").load(location.href + " #ranking_form");
      }
      function close_ranking(){
        $('#discard_message_ranking').modal('toggle');
      }
    </script>

<!-- Modal -->
<div class="modal fade" id="discard_message_ranking" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Unsaved changes</h5>
      </div>
      <div class="modal-body">
      Would you like to close without saving current poll?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="close_ranking()">Cancel</button>
        <button type="button" class="btn btn-danger" id="discard_change" onclick="discard_ranking()">Discard changes</button>
      </div>
    </div>
  </div>
</div>






  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ranking</h5>
        <!-- <button type="button" class="close" onclick="discardChanges_ranking()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div class="modal-body">
        <form action="ajax/create-poll.php?event_id=<?= $_SESSION['event_id']?>" id="ranking_form" method="POST">
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
        <button type="button" class="btn btn-secondary" onclick="discardChanges_ranking()">Close</button>
        <button type="submit" class="btn btn-primary">Create Poll</button>
        </form>
      </div>
    </div>
  </div>
</div>
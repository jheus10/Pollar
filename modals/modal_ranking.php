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
        location.reload();
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

      </div>
      <div class="modal-body">
        <form method="POST" id="ranking_form">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php poll($link) ?>" readonly/><br>
        <input type="text" name="ranking_question" id="ranking_question" placeholder="What would you like to ask?" required/><br>
        
        Choices:
        <button type='button' onclick="add_choices_ranking()">Add choices</button>
		<span id="choices_ranking">&nbsp;</span>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="discardChanges_ranking()">Close</button>
        <button type="submit" class="btn btn-primary">Create Poll</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
   $('#ranking_form').submit( function (e) {
   
    
   if($('#ranking_question').val()!==null){
  
    $.ajax({
      type: "POST",
      url: "ajax/create-poll.php?poll_type=Ranking&counterbox_ranking="+option_counter+"&event_id=<?=$_SESSION['event_id']?>&user_id=<?php echo $_SESSION["username"]?>",
      data: $('#ranking_form').serialize(),
      success: function (response) {
  
          var res = jQuery.parseJSON(response);
          if(res.status == 500) {
  
              console.log(res);
          }else{
              alertify.set('notifier','position', 'top-right');
              alertify.success(res.message);
              $('#my_polls').load(location.href + " #my_polls");
          }
      }
  });
}else{
  return false;
}
  });
   
  </script>
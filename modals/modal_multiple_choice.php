<div class="modal fade" id="add-event-multiple" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
<script>
  
    function discardChanges_multiple_choice(){
      if($('#multiple_question').val()){
        
      
      $('#discard_message_multiple').modal('show');
      
      }
      else{
      $('#add-event-multiple').modal('toggle');
    }
  }
      function discard_multiple_choice(){
        
        $('#add-event-multiple').on('hidden.bs.modal', function () {
        $(this).find('#multiple_choice_form').trigger('reset');
        
        });
        $('#add-event-multiple').modal('toggle');
        $('#discard_message_multiple').modal('toggle');
        $("#multiple_choice_form").load(location.href + " #multiple_choice_form");
      }
      function close_multiple_choice(){
        $('#discard_message_multiple').modal('toggle');
      }
    </script>

<!-- Modal -->
<div class="modal fade" id="discard_message_multiple" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Unsaved changes</h5>
      </div>
      <div class="modal-body">
      Would you like to close without saving current poll?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="close_multiple_choice()">Cancel</button>
        <button type="button" class="btn btn-danger" id="discard_change" onclick="discard_multiple_choice()">Discard changes</button>
      </div>
    </div>
  </div>
</div>



  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Multiple Choice</h5>
      
      </div>
      <div class="modal-body">
        <form id="multiple_choice_form" method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php  poll($link) ?>" readonly/><br>
        <input type="text" name="multiple_question" id="multiple_question" placeholder="What would you like to ask?" required/><br>
        
       
        Choices:
        <button type='button' onclick="add_choices_multiple_choice()">Add choices</button>

		<span id="choices">&nbsp;</span>
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  onclick=" discardChanges_multiple_choice()">Close</button>
        <button type="submit" class="btn btn-primary">Create Poll</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
   $('#multiple_choice_form').submit( function (e) {
    
    
   if($('#multiple_question').val()!==null){
  
    $.ajax({
      type: "POST",
      url: "ajax/create-poll.php?poll_type=Multiple Choice&option_counter="+option_counter+"&event_id=<?=$_SESSION['event_id']?>&user_id=<?php echo $_SESSION["username"]?>",
      data: $('#multiple_choice_form').serialize(),
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
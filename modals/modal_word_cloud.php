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
        location.reload();
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
      
      </div>
      <div class="modal-body">
        <form  id="wordcloud_form" method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php poll($link) ?>" readonly/>
        <input type="text" name="wordcloud_question" id="wordcloud_question" placeholder="What would you like to ask?" required/><br>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="discardChanges_wordcloud()">Close</button>
        <button type="submit" class="btn btn-primary">Create Poll</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
   $('#wordcloud_form').submit( function (e) {
    
    
   if($('#wordcloud_question').val()!==null){
 
  
    $.ajax({
      type: "POST",
      url: "ajax/create-poll.php?poll_type=Word Cloud&username=<?php echo $_SESSION["username"]?>&event_id=<?=$_SESSION['event_id']?>",
      data: $('#wordcloud_form').serialize(),
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
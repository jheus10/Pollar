<div class="modal fade" id="add-event-rating" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
<script>
  
    function discardChanges_rating(){
      
      if($('#rating_question').val()){
        
      
        $('#discard_message_rating').modal('show');
        
        }
        else{
        $('#add-event-rating').modal('toggle');
      }
      
      }
      function discard_rating(){
        
        $('#add-event-rating').on('hidden.bs.modal', function () {
        $(this).find('#rating_form').trigger('reset');
        
        });
        $('#add-event-rating').modal('toggle');
        $('#discard_message_rating').modal('toggle');
        $("#rating_form").load(location.href + " #rating_form");
      }
      function close_rating(){
        $('#discard_message_rating').modal('toggle');
      }
    </script>

<!-- Modal -->
<div class="modal fade" id="discard_message_rating" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Unsaved changes</h5>
      </div>
      <div class="modal-body">
      Would you like to close without saving current poll?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="close_rating()">Cancel</button>
        <button type="button" class="btn btn-danger" id="discard_change" onclick="discard_rating()">Discard changes</button>
      </div>
    </div>
  </div>
</div>







  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Rating</h5>
    
      </div>
      <div class="modal-body">
        <form  id="rating_form" method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php poll($link) ?>" readonly/><br>
        <input type="text" name="rating_question" id="rating_question" placeholder="What would you like to ask?" required/><br>

     
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
        <button type="button" class="btn btn-secondary" onclick="discardChanges_rating()">Close</button>
        <button type="submit" id="submit-poll-quiz" class="btn btn-primary">Create Poll</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
   $('#rating_form').submit( function (e) {
    
    
   if($('#rating_question').val()!==null){
  
    $.ajax({
      type: "POST",
      url: "ajax/create-poll.php?poll_type=Rating&event_id=<?=$_SESSION['event_id']?>&user_id=<?php echo $_SESSION["username"]?>",
      data: $('#rating_form').serialize(),
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
<div class="modal fade" id="add-event-quiz" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Quiz</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  id="quiz-form"  method="POST">
        Event Code: <input type="text" name="poll_code" id="poll_code" value="<?php poll($link) ?>" readonly/>
        <input type="text" value="" name="poll_title" id="poll_title" placeholder="Enter Quiz Title" />
        <input type="button" value="add question" onclick="add_question()"/>      
    
   
        
    <div class="quiz_container" id='quiz_container'>

        
    </div>     
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  type="submit" id="submit-poll-quiz" class="btn btn-primary">Create Poll</button>
        </form>

        <script>
   $('#submit-poll-quiz').submit( function (e) {
    
    var choices_con=[];
    
    var inputIdcounter="question_block".concat(question_counter-1);
    for(j=0;j<=(question_counter)-1;j++){
      var inputIdcounter="question_block".concat(j);
    
      var inputIds = $.map($('#'+inputIdcounter+' :input'), input => input.id);
      for(i=0;i<=(inputIds.length)-1;i++){
        if(inputIds[i].includes('quiztextoption-')){
          choices_con.push(inputIds[i])
        }
        else{
          continue;
        }
     
    }
    choices_con.push("--")
    }
    //ASSIGN RADIO BUTTON VALUES ON QUIZ FORM
    for(i=1;i<=option_counter-1;i++){
    
      radio_button=document.getElementById("radio-" + i);
      if((document.getElementById("quiztextoption-"+i))&&(document.getElementById("quiztextoption-"+i).value)){
      input_value=document.getElementById("quiztextoption-"+i).value;
      
       
        radio_button.setAttribute("value",input_value); 
    }
    }   
     //GET json of choices names 
    var json_choices=JSON.stringify(choices_con);
   if($('#poll_title').val()!==null){

  
    $.ajax({
      type: "POST",
      url: "ajax/create-poll-quiz.php?json_choices="+json_choices+"&question_counterbox="+question_counter+"&option_counter="+option_counter+"&poll_type=Quiz&event_id=<?=$_SESSION['event_id']?>",
      data: $('#quiz-form').serialize(),
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
      </div>
    </div>
  </div>
</div>
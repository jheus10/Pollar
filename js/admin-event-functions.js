var option_counter=1;//DETERMINE THE NUMBER OF CHOICES CREATED
var question_counter=1; //DETERMINE THE NUMBER OF QUESTIONS CREATED
const textquestion="quizquestion-"; // FOR QUIZ FORM 
const labelquestion="quiztextquestion-"; // FOR QUIZ FORM 
const textoption="option-";// FOR GENERAL CHOICES
const labeloption="textoption-";// FOR GENERAL CHOICES
const labeloptionrank="textoptionrank-"; // FOR RANK FORM 


//ADD CHOICES FOR MULTIPLE CHOICE POLL
function add_choices_multiple_choice() {
  
	//Create an input type dynamically.
  var div = document.createElement("div");
  // var radio = document.createElement("input");
  // var radio_value=document.getElementById('textoption-0').value;
  div.setAttribute('class','form-group');
  div.setAttribute('id','box_'+option_counter);
  // radio.setAttribute('class','form-group');
  // radio.setAttribute('type','radio');
  // radio.setAttribute('id','box_'+option_counter);
  // radio.setAttribute('name','options');
  // radio.setAttribute('value',radio_value);
  var textbox = /*<input type='radio' name='options_radio' value='"+radio_value+"'>*/"<input type='text' value='' placeholder='Add option' name='"+labeloption+option_counter+"' id='"+labeloption+option_counter+"'> <button type='button' onclick='removeBox(this)'><i class='fa-sharp fa-solid fa-xmark'></i></button>"

	var foo = document.getElementById("choices");
      div.innerHTML=textbox;

      foo.appendChild(div);
      document.getElementById('counterbox').value=option_counter;

      option_counter=option_counter+1;

}

// ADD QUIZ POLL QUESTION DYNAMICALLY
function add_question() {

  var div = document.createElement("div");
  var question = document.createElement("input");

  // div.setAttribute('class','form-group');
  // div.setAttribute('id','box_'+question_counter);
  // question.setAttribute('class','form-group');
  // question.setAttribute('type','text');
  // question.setAttribute('id','box_'+question_counter);
  // question.setAttribute('name','question');


  var textbox = "<div class='question_block"+question_counter+"' id='question_block"+question_counter+"'><input type='text' value='' placeholder='What would you like to ask?' name='"+labelquestion + question_counter+"' id='"+labelquestion + question_counter+"'> <button type='button' onclick='removeBox(this)'><i class='fa-solid fa-trash'></i></button></button><button type='button' id='add-option-"+question_counter+"'  onclick='add_choices_quiz(this)'>add option</button>";
  var concat_question = document.getElementById("quiz_container");
      div.innerHTML=textbox;

      concat_question.appendChild(div);
      document.getElementById('question_counterbox').value=question_counter;
      question_counter=question_counter+1;
}

// ADD QUIZ POLL CHOICES DYNAMICALLY
function add_choices_quiz() {

//Create an input type dynamically.
    const textoption="quizoption-";
    const labeloption="quiztextoption-";
    var div = document.createElement("div");
    // var radio = document.createElement("input");

    // div.setAttribute('class','form-group');
    // div.setAttribute('id','box_'+option_counter);
    // radio.setAttribute('class','form-group');
    // radio.setAttribute('type','radio');
    // radio.setAttribute('id','box_'+option_counter);
    // radio.setAttribute('name','options');

    var textbox = "<div class='question_block"+question_counter+"' id='question_block"+question_counter+"'><input type='text' value='' placeholder='What would you like to ask?' name='"+labelquestion + question_counter+"' id='"+labelquestion + question_counter+"'> <button type='button' onclick='removeBox(this)'><i class='fa-solid fa-trash'></i></button></button><button type='button' id='add-option-"+question_counter+"'  onclick='add_choices_quiz(this)'>add option</button>";
    var foo = document.getElementById("quiz_container");
        div.innerHTML=textbox;

        foo.appendChild(div);
        document.getElementById('option_counter').value=option_counter;
        option_counter=option_counter+1;
  
}

// ADD QUIZ POLL CHOICES DYNAMICALLY
function add_choices_quiz(node) {

  //Create an input type dynamically.
      const textoption="quizoption-";
      const labeloption="quiztextoption-";
     
      var div = document.createElement("div");
      var radio = document.createElement("input");
  
       div.setAttribute('class','form-group');
      // div.setAttribute('id','choices-for-question-'+question_counter);
      // radio.setAttribute('class','form-group');
      // radio.setAttribute('type','radio');
      // radio.setAttribute('id','box_'+option_counter);
      // radio.setAttribute('name','options');
  
      var textbox = "<input type='radio' name='"+textoption + node.parentNode.id+"' id='radio-"+ option_counter+"' value='' required><input type='text' value='' placeholder='add option' name='"+labeloption+option_counter+"' id='"+labeloption+option_counter+"'> <button type='button' onclick='removeBox(this)'><i class='fa-solid fa-x'></i></button";
  
      var choices_container = document.getElementById(node.parentNode.id);
      div.innerHTML=textbox;
      
          choices_container.appendChild(div);
          document.getElementById('option_counter').value=option_counter;
          option_counter=option_counter+1;
  
         
  }


  

 



// ADD RANKING POLL CHOICES DYNAMICALLY
function add_choices_ranking() {
  if (document.getElementById('select_option_ranking').value){
	//Create an input type dynamically.
  
        var div = document.createElement("div");
        var radio = document.createElement("input");
        var radio_value=document.getElementById('select_option_ranking').value;
        div.setAttribute('class','form-group');
        div.setAttribute('id','box_'+option_counter);
        radio.setAttribute('class','form-group');
        radio.setAttribute('type','radio');
        radio.setAttribute('id','box_'+option_counter);
        radio.setAttribute('name','options');
        radio.setAttribute('value',radio_value);
        var textbox = "<input type='text' value='"+radio_value+"' name='"+labeloptionrank+option_counter+"' id='"+labeloptionrank+option_counter+"' readonly> <input type='button' value='-' onclick='removeBox(this)'>"

            var foo = document.getElementById("choices_ranking");
            div.innerHTML=textbox;

            foo.appendChild(div);
            document.getElementById('counterbox_ranking').value=option_counter;
            option_counter=option_counter+1;
  }
}


//REMOVE CHOICES/QUESTION DYNAMICALLY
function removeBox(ele){
  ele.parentNode.remove();
}




//COPY POLL LINK
function copy(copy_id) {
    // Get the text field
    const link="http://localhost/miles-polling/";
  
  
     // Copy the text inside the text field
    navigator.clipboard.writeText(link+copy_id);
  
    // Alert the copied text
    alertify.set('notifier','position', 'top-left');
    alertify.success('Copied to clipboard');
    
  }
  
//DELETE A POLL FROM THE LIST
  $(document).on('click', '#deletePollBtn', function (e) {
    e.preventDefault();
    
    if(confirm('Are you sure you want to delete this data?'))
    {
      var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "ajax/delete-poll.php",
            data: {
                'id': id
            },
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 500) {

                    console.log(res.message);
                }else{
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);
                    $('#my_polls').load(location.href + " #my_polls");
                }
            }
        });
    }
});


<?php
         if(mysqli_num_rows($check_if_answered)){
 
            include 'responses/thankyou_for_submit.php';
        }else{


        ?>
<head>
        <link href="css/ranking-poll.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="jquery.ui.touch-punch.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        </head>
        <center>
        <div class="poll-container" id="drag_container">
        <h3><?=$row['poll_question']?></h3>
        <h6>note: drag the elements from the left to your desired ranking on the right.</h6>
            <div class='container' >
            <div class="source-container">
            <?php
            for ($i=1; $i < count($exploded)-1; $i++){
            ?>
                <div class='source'>
                <div class='item'>
                    <p><?=($exploded[$i])?></p>
                </div>
                </div>
                
            <?php
            }
            ?>
            
            </div>
                <div class='move-back'>
            </div>
            <div class='destination-container'>
            <?php
            for ($i=1; $i < count($exploded)-1; $i++){
            ?>
                <div class="destination" id="dest<?=$i?>">
                    <span  id="ranking"><?=$i?></span>
                </div>
            <?php
            }
            ?>
            
            
            </div>
            
            </div>
            <form id="ranking-form" method = 'post' > 
        <div class="options">

        </div>
        <button type="submit" id="ranking-form" class="btn btn-primary">Submit Poll</button>
        
        </form> 
  
        
        </div>
        
        <script>//SCRIPT FOR DROPPABLE INPUTS
       
        $(function(){
  
        item_height=$(".item").outerHeight(true);
        height=(item_height+4)*($(".item").length+1);
        $(".source-container,.destination-container").height(height);
        
            

        $(".source .item").draggable({
            revert:"invalid",
            start:function(){
            
            $(this).data("index",$(this).parent().index());
            
            }
        });
        
        $(".destination").droppable({
            drop:function(evern,ui){
                if($(this).has(".item").length){
                    if(ui.draggable.parent().hasClass("source")){
                        index=ui.draggable.data("index");
                        ui.draggable.css({left:"0",top:"0"}).appendTo($(".source").eq(index));
                    }
                    else{
                    ui.draggable.css({left:"0",top:"0"}).appendTo($(this));
                    index=ui.draggable.data("index");
                    $(this).find(".item").eq(0).appendTo($(".destination").eq(index))
                    }
                }
                else{
                ui.draggable.css({left:"1px",top:"1px"});
                ui.draggable.appendTo($(this));
                $(".destination").removeClass("ui-droppable-active");
                }
            }
        });
        
        $(".source").droppable({
            accept: function(draggable) {
                return $(this).find("*").length == 0;
            },
        drop:function(event,ui){
            ui.draggable.css({left:"0",top:"0"}).appendTo($(this))
        }
        })
        })
        $(document).ready(function () {
            
 
           $("#ranking-form").submit(function (event) {
            event.preventDefault();
            var answer_array=[];
            <?php
                for ($index=0; $index < count($exploded)-2; $index++){
                ?>
                var rank=document.getElementsByClassName("destination ui-droppable")[<?=$index?>];
                if (rank.getElementsByTagName("p")[0]==undefined || rank.getElementsByTagName("p")[0]==null){
                    alert("Please be sure to rank all choices.")
                    return false;
                       
                }else{
                    answer_array.push(rank.getElementsByTagName("p")[0].innerHTML+"***");
                }
                
            <?php
                }
                ?>   
                answer_array.push(",");
                $.ajax({
                type: "POST",
                url: "ajax/submit-answer-ranking.php?ranking_array="+answer_array+"&username=<?php echo $_SESSION["username"]?>&poll_code=<?php echo $row['poll_code']?>&event_id=<?php echo $row['event_id']?>",
                data: $('#ranking-form').serialize(),
                success : function (response) {
                    var res = jQuery.parseJSON(response);
                    if(res.status == 500) {
                        alertify.set('notifier','position', 'top-right');
                        alertify.error(res.message);
                    }else{
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        location.reload(); //reloads the website after submitting for RANKING POLL. 
                    }
                 } 
                });
                
            });
           
            });
        
        </script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <?php
        
        }


        ?>
<head>
        
        <link href="css/open-text.css" rel="stylesheet">
        </head>
        <center>
        <div class="poll-container">
           
            <section class="msger">
            <header class="msger-header">
                <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i> <?php echo $row['poll_question']?>
                </div>
                <div class="msger-header-options">
                </div>
            </header>
            
           
             <div class="container" id="#container">
            <main class="msger-chat">
            <?php 
                            if($result_opentext=mysqli_query($link,$sql_opentext)){

                            
                            while($row_open = $result_opentext->fetch_assoc()){     
                        ?>
                        
                <div class="msg right-msg">
                <div class="msg-img"></div>
                
                <div class="msg-bubble">
                    <div class="msg-info">
                    <div class="msg-info-name"><?=$row_open['user_id']?></div>
                    <div class="msg-info-time"></div>
                    </div>

                    <div class="msg-text">
                    <?=$row_open['answer_option']?>
                    </div>
                </div>
                </div>
                <?php
            }
        }
        ?>
            
            </main>
            </div>
  <form class="msger-inputarea" method = 'post' action='ajax/submit-answer.php?user_id=<?=$_SESSION["username"]?>&event_id=<?php echo $event_id ?>&poll_code=<?php echo $poll_code ?>' >
    <input type="text" class="msger-input" id="answer" name="answer" value="" placeholder="Enter your message..." autocomplete=off>
    <button type="submit" class="msger-send-btn">Send</button>
  </form>
</section>
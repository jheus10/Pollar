$('.msger').show();
          $('#myChart').hide();
          $('.question').hide();
          
          var updated_data=[];
          var updated_names=[];
          updated_data=res.messages;
          var my_data=updated_data;
                      //AJAX call for updating values
          document.querySelector('.msger-header-title').innerHTML=res.poll_question;
          var user_id = document.querySelector('.msger-chat');
          $('.left-msg').remove();
          for(var i=0;i<=(res.user_id).length-1;i++){
          user_id.innerHTML +='<div class="msg left-msg"><div class="msg-img"></div><div class="msg-bubble"><div class="msg-info"><div class="msg-info-name">'+res.user_id[i]+'</div><div class="msg-info-time"></div></div><div class="msg-text">'+updated_data[i]+'</div></div></div>'; 
                      setInterval(function() {
                        $.ajax({
                      type:"POST",
                      url: "ajax/view-analytics.php",
                      datatype:'json',
                                      
                      data: {
                          'event_id': event_id,
                          'poll_code': poll_code,
                                          
                        },
                      success: function(db_call) {
                        var res2 = jQuery.parseJSON(db_call);   
                       
                        updated_data=res2.messages;
                        updated_names=res2.user_id;
                        var messages_count = $(".msg-info-name").length;
                        
                        if(messages_count != updated_data.length){
            
                          for(var j=updated_data.length-1; j>=messages_count;  j--){
                            user_id.innerHTML +='<div class="msg left-msg"><div class="msg-img"></div><div class="msg-bubble"><div class="msg-info"><div class="msg-info-name">'+updated_names[j]+'</div><div class="msg-info-time"></div></div><div class="msg-text">'+updated_data[j]+'</div></div></div>'; 
                          
                          }
                        }
                      }
                    });
                  
                }, 5000);
                           

          }





        <?php 
        if(isset($_GET['event_id']) && $_GET['event_id'] === true && isset($_GET['poll_type']) && isset($_GET['username']) && isset($_POST['poll_code'])){
        $event_ids=$_GET['event_id'];
        }else{
            header("Location:../responses/error.php");
        }
 require_once('../config/config.php');
       
        
        $poll_type=  mysqli_real_escape_string($link,$_GET['poll_type']);
        $event_id= mysqli_real_escape_string($link,$_GET['event_id']);
        $poll_code = mysqli_real_escape_string($link,$_POST['poll_code']);
        $user_id=mysqli_real_escape_string($link,$_GET['username']);
        $x=0;
        if ($poll_type=="Multiple Choice"){
            $poll_question =  mysqli_real_escape_string($link,$_POST['multiple_question']);
            $counter= mysqli_real_escape_string($link,$_GET['option_counter']); //DETERMINES HOW MANY CHOICES IN THE FORM
          
            
            $correct =  mysqli_real_escape_string($link,$_POST['options_radio']);
            
            $choices = ",*/";
            $mydata=array (
  
                // Every array will be converted
                // to an object
                
            );
            
            
            
            while($x <= $counter){
                
                if(strpos($_POST['textoption-'.$x],"*/")!==false){
                    
                    header("Location:../admin-event.php?event_id=".$event_ids);
                    break;
                }else{

                if (!empty(mysqli_real_escape_string($link,$_POST['textoption-'.$x]))){
               
                $choice_container = $_POST['textoption-'.$x];
                array_push($mydata,array(
                    "choice_no" => "choice".$x,
                    "value" => $_POST['textoption-'.$x]
                ));
                
                    $choices .= $choice_container.",*/";    
                    $x++;
                }else{
                    $x++;
                }
             }
            }
            $myjson=json_encode($mydata);
         
            $sql = "INSERT INTO poll_list(poll_type,poll_question,poll_correct,poll_choices,poll_code,event_id,user_id)  VALUES ('$poll_type',' $poll_question','$correct','$choices ','$poll_code','$event_id','$user_id')";
             
            if(mysqli_query($link, $sql)){
                header("Location:../admin-event.php?event_id=".$event_ids);
                $res = [
                    'status' => 200,
                    'message' => "Poll created.",
                    'poll_type' =>  $poll_type,  
                    'event_id' => $event_id, 

                    'poll_code' => $poll_code,

                    
                ];
                echo json_encode($res);
                return;
            } else{
                echo "ERROR: Hush! Sorry . "
                    . mysqli_error($link);
                    $res = [
                        'status' => 500,
                        'message' => "Unable to create the poll.",
                        'poll_type' =>  $poll_type,  
                        'event_id' => $event_id, 

                        'poll_code' => $poll_code,

                    ];
                    echo json_encode($res);
                    return;
            }
        }
            else if ($poll_type=="Word Cloud"){
                $poll_question =  mysqli_real_escape_string($link,$_POST['wordcloud_question']);

            
                
             
                $sql = "INSERT INTO poll_list(poll_type,poll_question,poll_correct,poll_choices,poll_code,event_id,user_id)  VALUES ('$poll_type',' $poll_question','$correct','$choices','$poll_code','$event_id','$user_id')";
                 
                if(mysqli_query($link, $sql)){
                    header("Location:../admin-event.php?event_id=".$event_ids);
         
                } else{
                    echo "ERROR: Hush! Sorry $sql. "
                        . mysqli_error($link);
                }
              
        }
        else if($poll_type=="Rating"){
            $poll_question =  mysqli_real_escape_string($link,$_POST['rating_question']);
            $max_value = mysqli_real_escape_string($link,$_POST['max_value']);
            $sql = "INSERT INTO poll_list(poll_type,poll_question,poll_correct,poll_code,event_id,user_id)  VALUES ('$poll_type',' $poll_question','$max_value','$poll_code','$event_id','$user_id')";
             
            if(mysqli_query($link, $sql)){
                header("Location:../admin-event.php?event_id=".$event_ids);
     
            } else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($link);
            }
        }
        
        else if ($poll_type=="Open Text"){
            $poll_question =  mysqli_real_escape_string($link,$_POST['opentext_question']);
        
            $sql = "INSERT INTO poll_list(poll_type,poll_question,poll_correct,poll_choices,poll_code,event_id,user_id)  VALUES ('$poll_type',' $poll_question','$correct','$choices','$poll_code','$event_id','$user_id')";
             
            if(mysqli_query($link, $sql)){
                header("Location:../admin-event.php?event_id=".$event_ids);
     
            } else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($link);
            }
        }
        else if ($poll_type=="Ranking"){
            $poll_question =  mysqli_real_escape_string($link,$_POST['ranking_question']);
            $counter= mysqli_real_escape_string($link,$_GET['counterbox_ranking']);

            $choices = ",*/";
            while($x <= $counter){
                if (!empty($_POST['textoptionrank-'.$x])){
                $choice_container = $_POST['textoptionrank-'.$x];
                $choices .= $choice_container.",*/";    
                $x++;
                }else{
                $x++;
                }
            }
         
            $sql = "INSERT INTO poll_list(poll_type,poll_question,poll_correct,poll_choices,poll_code,event_id,user_id)  VALUES ('$poll_type',' $poll_question','$correct','$choices','$poll_code','$event_id','$user_id')";
             
            if(mysqli_query($link, $sql)){
                //header("Location:../admin-event.php?event_id=".$event_ids);
     
            } else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($link);
            }
        }
        
        else{
            header("Location:../responses/error.php");
            $res = [
                'status' => 200,
                'message' => "Poll created.",
                'poll_type' =>  $poll_type,  
                'event_id' => $event_id, 
    
                'poll_code' => $poll_code,
    
                
            ];
            echo json_encode($res);
            return;
            
        }
            // Close connection
            mysqli_close($link);
        
       
        
        ?>

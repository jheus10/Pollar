<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Page page</title>
</head>
 
<body>
    <script>
    
    </script>
    <center>
        <?php
        $event_ids=$_GET['event_id'];
 require_once('config.php');
       
        
        $poll_type=  $_POST['poll_type'];
        $event_id= $_POST['event_id'];
        $poll_code = $_POST['poll_code'];

        $x=0;
        if ($poll_type=="Multiple Choice"){
            $poll_question =  $_POST['multiple_question'];
            $counter= $_POST['counterbox'];
            $question_counter= $_POST['question_counterbox'];
            
            $correct = $_POST['options_radio'];
            $choices = ",*/";
            while($x <= $counter){
                if (!empty($_POST['textoption-'.$x])){
                $choice_container = $_POST['textoption-'.$x];
                $choices .= $choice_container.",*/";    
                $x++;
                }else{
                $x++;
                }
            }
         
            $sql = "INSERT INTO poll_list(poll_type,poll_question,poll_correct,poll_choices,poll_code,event_id)  VALUES ('$poll_type',' $poll_question','$correct','$choices','$poll_code','$event_id')";
             
            if(mysqli_query($link, $sql)){
                header("Location:admin-event.php?event_id=".$event_ids);
     
            } else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($link);
            }
        }else if($poll_type=="Rating"){
            $poll_question =  $_POST['rating_question'];
            $max_value = $_POST['rating'];
            $sql = "INSERT INTO poll_list(poll_type,poll_question,poll_correct,poll_code,event_id)  VALUES ('$poll_type',' $poll_question','$max_value','$poll_code','$event_id')";
             
            if(mysqli_query($link, $sql)){
                header("Location:admin-event.php?event_id=".$event_ids);
     
            } else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($link);
            }
        }else{
            echo " HEYYYY";
        }

        
        
         
        // Close connection
        mysqli_close($link);
        
        ?>
    </center>
</body>
 
</html>
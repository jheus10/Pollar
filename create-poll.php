<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Page page</title>
</head>
 
<body>
    <center>
        <?php
        $event_ids=$_GET['event_id'];
 require_once('config.php');
       
        $poll_question =  $_POST['multiple_question'];
        $poll_type=  $_POST['poll_type'];
        $event_id= $_POST['event_id'];
        $counter= $_POST['counterbox'];
        $poll_code = $_POST['poll_code'];
        $correct = $_POST['options_radio'];
        $choices = "";
        $x=0;
        while($x <= $counter){
            $choice_container = $_POST['textoption-'.$x];
            $choices .= $choice_container.",";    
            $x++;
        }
       
        $sql = "INSERT INTO poll_list(poll_type,poll_question,poll_correct,poll_choices,poll_code,event_id)  VALUES ('$poll_type',' $poll_question','$correct','$choices','$poll_code','$event_id')";
         
        if(mysqli_query($link, $sql)){
            header("Location:admin-event.php?event_id=".$event_ids);
 
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($link);
        }
         
        // Close connection
        mysqli_close($link);
        ?>
    </center>
</body>
 
</html>
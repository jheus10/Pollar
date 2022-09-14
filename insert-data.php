<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Page page</title>
</head>
 
<body>
    <center>
        <?php
 require_once('config.php');
       
        $event_name =  $_POST['event_name'];
        $event_code =  $_POST['event_code'];
        $user_id =  $_POST['user_id'];
         
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO event_list(event_name,user_id)  VALUES ('$event_name','$user_id')";
         
        if(mysqli_query($link, $sql)){
            header("Location:index.php");
 
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
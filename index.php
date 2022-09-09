<?php
// Initialize the session

session_start();
 
require_once('config.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
    <div class="issuer-table">
  <div class="search-box">
  <ion-icon name="search-outline"></ion-icon> <input type="text" class="search-input" placeholder="Search Issuer">
  </div>

<!-- Button trigger modal -->
  <button type="button" class="create-event" data-toggle="modal" data-target="#add-event">Create Event</button>



<!-- Modal -->
<div class="modal fade" id="add-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="insert-data.php" method="POST">
        Event Name:<input type="text" name="event_name" id="event_name" placeholder="Event name" required/><br>
        Start Date: <input type="date"/><br>
        End Date<input type="date"/><br>
        Event Code: <input type="text" name="event_code" id="event_code" value="<?php echo(rand(1000000,9999999)); ?>" readonly/>
        <input type="text" name="user_id" id="user_id" value=<?php echo $_SESSION["username"]?> hidden>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>




  <h1>List of Events</h1>
  <div class="table-container">
      
       
<?php
$sql = "SELECT * FROM event_list";
$result = $link->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<div class="tablelist">';
    echo ' <div class="content">';
    echo '<input type="text" value='.$row['id'].'" hidden>';
    echo "<h3> " . $row["event_name"]."</h3>";
    echo "</div>";
    echo '<div class="button-wrapper"><a class="view-button" href="">Activate</a></div>';
    echo '<div class="button-wrapper"><a class="view-button" href="delete-event.php?id='. $row['id'] .'">Delete</a></div>';
    echo "</div>";
  }
} else {
  echo "0 results";
}
?>
      
      
  </div>
</div>
<script type="text/javascript" src="js/navbar.js"></script>
<script>

  const search_open = document.querySelector(".search-input");
  const border_open = document.querySelector(".search-box");
  
  search_open.addEventListener("focus", () => {
    border_open.style.border = "1px solid #777";
    border_open.style.boxShadow = "0 5px 20px rgba(0,0,0,0.1)";
});

search_open.addEventListener("blur", () => {
    border_open.style.border = "";
    border_open.style.boxShadow = "";
});
</script> 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
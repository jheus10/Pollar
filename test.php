<?php
require "conn.php";

$result = array();
$result['duration'] = '';
$result['entrydatetime'] = '';

$sql = "SELECT  SUM(duration) as duration, 
                DATE(entrydatetime) as entrydatetime 
        FROM `chart` 
        GROUP BY DATE(entrydatetime) 
        LIMIT 0, 1";
$query_result = mysqli_query($conn, $sql);

// Loop the query result
while($row = mysqli_fetch_array($query_result))
{
        $result['duration']       = $row[0];
        $result['entrydatetime']  = $row[1];
}
        mysqli_close($conn);
?>

<div class='chart' style='width:100%'>
   <input type='date' onfocus='(this.type="date")' onchange='callAjax()' placeholder='entrydatetime' 
   id='start'>
   <canvas id='myChart' width='400' height='200'></canvas>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js'></script>
<script type='text/javascript'>
<?php
echo "var dt = ['". $result['duration'] . "'];";
echo "var lbls = ['". $result['entrydatetime'] . "'];";
?>

var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
  type: 'bar',

  // The data for our dataset
  data: {
    labels: lbls,
    // Information about the dataset
    datasets: [{
      label: "Duration (s)",
      backgroundColor: 'orange',
      borderColor: 'royalblue',
      data: dt,
    }]
  },

  // Configuration options
  options: {
    layout: {
      padding: 10,
    },
    legend: {
      position: 'bottom',
    },
    title: {
      display: true,
      text: "Product Durability Test - DevKudos.com"
    },
    scales: {
      yAxes: [{
        scaleLabel: {
          display: true,
          labelString: 'Total Duration'
        }
      }],
      xAxes: [{
        scaleLabel: {
          display: true,
          labelString: 'Entry Date'
        }
      }]
    }
  }
});

// This function will call filter-ajax.php with selected date to retrieve data
function callAjax(){
    var start = document.getElementById("start").value
    var xhr = new XMLHttpRequest();
    var url = "http://localhost/charty/filter-ajax.php?date=" + start;
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            response = JSON.parse(this.responseText)
            chart.data.datasets[0].data[0] = response.duration;
            chart.data.labels[0] = response.entrydatetime;
            chart.update();
        }
    };
    xhr.open("GET", url, true);
    xhr.send();    
}
</script>
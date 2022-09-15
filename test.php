
   
<!DOCTYPE html>
<html>
<head>
    <title>Live Update</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="autoUpdate.js"></script>
</head>
<select name="" id="">
    <option value="">hello</option>
</select>
<div id="liveData">
    <p>Loading Data...</p>
</div>
     <script>
        window.addEventListener('load', function()
{
    var xhr = null;

    getXmlHttpRequestObject = function()
    {
        if(!xhr)
        {               
            // Create a new XMLHttpRequest object 
            xhr = new XMLHttpRequest();
        }
        return xhr;
    };

    updateLiveData = function()
    {
        var now = new Date();
        // Date string is appended as a query with live data 
        // for not to use the cached version 
        var url = 'http://localhost/miles-polling/present-poll.php?event_id=6&poll_code=4575508';
        xhr = getXmlHttpRequestObject();
        xhr.onreadystatechange = evenHandler;
        // asynchronous requests
        xhr.open("GET", url, true);
        // Send the request over the network
        xhr.send(null);
    };

    updateLiveData();

    function evenHandler()
    {
        // Check response is ready or not
        if(xhr.readyState == 3 && xhr.status == 200)
        {
            dataDiv = document.getElementById('liveData');
            // Set current data text
            dataDiv.innerHTML = xhr.responseText;
            // Update the live data every 1 sec
            setTimeout(updateLiveData(), 10000);
        }
    }
});
</script>
</body>
</html>
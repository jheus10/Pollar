<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Example Seemless Video Navigation</title>
  <meta name="description" content="This is my description">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>

  $(function() {
    $('#change-title').click( function() {
      document.title = $('#title').val();
    });

    $('#change-description').click( function() {
      $('meta[name=description]').attr('content', $('#description').val());
    });

    $('#change-url').click( function() {
      window.history.pushState("", "", $('#url').val());
    });

  });


  </script>

  <style>
  input[type="text"] {
  	width: 300px;
  	margin: 1em;
  }


  </style>


</head>

<body>
<h1>Changing page attributes without reload</h1>
<div>
  Title: <input type="text" value="Changing page attributes without reload" id="title"/><input type="submit" value="Change" id="change-title">
</div>
<div>
  Meta Description: <input type="text" value="This is my description" id="description" /><input type="submit" value="Change" id="change-description">
</div>
<div>
  URL: <input type="text" value="meta-test.html" id="url" /><input type="submit" value="Change" id="change-url">
</div>	


</body>
</html>
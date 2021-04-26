<?php

  session_start();

  if ( isset($_POST['reset']) ) {
    $_SESSION['chats'] = Array();
    header("Location: index.php");
    return;
  }

  if ( isset($_POST['message']) ) {
    if ( !isset ($_SESSION['chats']) ) $_SESSION['chats'] = Array();
    $_SESSION['chats'] [] = array($_POST['message'], date(DATE_RFC2822));
    header("Location: index.php");
    return;
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Chat using Forms and jQuery</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  </head>

<body>

      <h1>Chat</h1>

      <form method="post" action="index.php">
      <p>
      <input type="text" name="message" size="60"/>
      <input type="submit" value="Chat"/>
      <input type="submit" name="reset" value="Reset"/>
      <a href="chatlist.php" target="_blank">chatlist.php</a>
      </p>
      </form>

      <div id="chatcontent">
          <img src="img/spinner.gif" alt="Loading..."/>
      </div>


<script type="text/javascript">

function updateMsg() {

  window.console && console.log('Requesting JSON');

  $.getJSON('chatlist.php', function(data){

      setTimeout('updateMsg()', 4000);

      window.console && console.log('JSON Received');
      window.console && console.log(data);

      $('#chatcontent').empty();

      for (var i = 0; i < data.length; i++) {

        arow = data[i];
        $('#chatcontent').append('<p>'+arow[0] + '<br/>&nbsp;&nbsp;'+arow[1]+"</p>\n");
      }

  });
}

// Make sure JSON requests are not cached
$(document).ready(function() {

  $.ajaxSetup({ cache: false });

  updateMsg();

});

</script>
</body>

<?php
session_start();

print($_SESSION["userid"]);
if (!isset($_SESSION["user"]) || $_SESSION["user"] !== true)
{
	header("location: login.php");
	//print_r($_SESSION);
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Create New Thread</title>
  <link rel="stylesheet" href="ipthread.css">
  <script type="text/javascript" src="data.js"></script>
</head>

<body>
  <div class="top-bar">
    <h1>Create New Thread</h1>
  </div>
  <h2>Title:</h2>
  <p>
    <textarea id="title" cols="30" rows="1"></textarea>
  </p>
  <h2>Content:</h2>
  <textarea id="content" cols="100" rows="25"></textarea>
  <br>
  <button onclick="mouseDown()">Submit</button>
  <div>
    <p id="text" style="color:purple; 
            font-weight:bold;font-size:20px;"></p>
  </div>
  <!-- window.location.href= 'index.php'; -->
  <script type="text/javascript">
  
  function mouseDown() {  
                 var loThread = JSON.parse(sessionStorage.getItem("newThreads"));
                 var last = loThread[loThread.length - 1];
  
                 var added = [
      
      {
          id: last.id + 1,
          title: document.getElementById ("title").value,
          author: "ArnavN", //placeholder 
          date: Date.now(),
          content: document.getElementById ("content").value,
          comments: []
      }
  ]
                 
                 loThread.push(added[0]);
                 sessionStorage.setItem("newThreads", JSON.stringify(loThread));
                 window.location.href= 'index.php'; 
             }
  </script>
</body>

</html>
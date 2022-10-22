<?php include_once("index.html"); ?>

<?php
session_start();


if (!isset($_SESSION["user"]) || $_SESSION["user"] !== true)
{
	header("location: login.php");

	exit;
}


?>
<!DOCTYPE html>
<html>

    <head>
        <title>Bulletin Board</title>
        <link rel="stylesheet" href="index.css">
        <script src="data.js"></script>
    </head>		
    <body>
        <div class="top-bar">
            <h1>Bulletin Board</h1>
        </div>
        <div>
	  	<p>
 		<a href="logout.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Log Out</a>
		</p>
	  </div>
        <div class="main">
            <ol>
            <button onClick="window.location.href='resources/php/ipthread.php';">Create thread</button>
            </ol>
        </div>
        <script>
        console.log(threads);
                    var container = document.querySelector('ol');
                    
                    var newThreads1 = JSON.parse(sessionStorage.getItem("newThreads"));
                    for (let thread of newThreads1) {
                        var html = `
                        <li class="row">
                            <a href="../html/thread.html?${thread.id}">
                                <h4 class="title">
                                    ${thread.title}
                                </h4>
                                <div class="bottom">
                                    <p class="timestamp">
                                        ${new Date(thread.date).toLocaleString()}
                                    </p>
                                    <p class="comment-count">
                                        ${thread.comments.length} comments
                                    </p>
                                </div>
                            </a>
                        </li>
                        `
                        container.insertAdjacentHTML('beforeend', html);
                    }
        </script>
    </body>

</html>

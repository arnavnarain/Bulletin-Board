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
<!DOCTYPE HTML>
<html>

<head>
  <Title>Thread</Title>
  <link rel="stylesheet" href="../css/thread.css">
</head>

<body>
  <div class="top-bar">
    <h1>Bulletin Board</h1>
  </div>
  <div class="main">
    <div class="header">
    </div>
    <div class="content" id="content">
    </div>
    <h4>
        Leave a comment
    </h4>
    <textarea></textarea>
    <button>add comment</button>
    <div class="comments">
    </div>
  </div>
  <script src="../data/data.js"></script>
  <script>
  var id = window.location.search.slice(1);
            var foo = JSON.parse(sessionStorage.getItem("newThreads"));
            var thread = foo.find(t => t.id == id);
            var header = document.querySelector('.header');
            let elements = document.getElementById('content');
            var a = `
            <p class="content" id="content">
            <wbr>
                    ${thread.content}
                </wbr>
             </p>
                `
                content.insertAdjacentHTML('beforeend', a)
            
            var headerHtml = `
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
            `
            header.insertAdjacentHTML('beforeend', headerHtml)
    
            function addComment(comment) {
                var commentHtml = `
                    <div class="comment">
                        <div class="top-comment">
                            <p class="user">
                                ${comment.author}
                            </p>
                            <p class="comment-ts">
                                ${new Date(comment.date).toLocaleString()}
                            </p>
                        </div>
                        <div class="comment-content">
                            ${comment.content}
                        </div>
                    </div>
                `
                comments.insertAdjacentHTML('beforeend', commentHtml);
            }
    
            var comments = document.querySelector('.comments');
            for (let comment of thread.comments) {
                addComment(comment);
            }
    
            var btn = document.querySelector('button');
            btn.addEventListener('click', function() {
                var txt = document.querySelector('textarea');
                var comment = {
                    content: txt.value,
                    date: Date.now(),
                    author: 'ArnavN'//placeholder 
                }
                addComment(comment);
                txt.value = '';
        
                let index = foo.findIndex( element => {
                    if (element.name == thread.id) {
                    return true;
                    }
            });

                thread.comments.push(comment);
                foo.splice(index, 1, thread);
                sessionStorage.setItem("newThreads", JSON.stringify(foo));
            })
  </script>
</body>

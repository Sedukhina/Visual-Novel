<?php
	require_once __DIR__.'/../boot.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Chinese novel</title>
        <meta charset="UTF-8">
        <!--Linking external files-->
        <script src="/ajax/forms.js"></script>
        <script src="/../game.js"></script>
        <script src="/../forum/forum.js"></script>
    </head>
    
    <body>
        <div class = "forum">
            <h1 class = "forumText" id = "TopicName"></h1>
            <div class = "displayNone" id = 'NewTopicDiv'> 
                <textarea id = 'NewTopic' placeholder = 'New Topic Name' required></textarea>
                <button onclick = 'CreateTopic()'>Create Topic</button> 
            </div>
            <div id="forum-messages" class = "forum-messages"></div>
            <div id="message-input" class = "displayNone">
                <form enctype="multipart/form-data" id ='writeMessage'>
                    <textarea id = "message" name = "message" class = 'messageForm' rows = 3 maxlength="1000" required></textarea>
                    <button type="button" class = "userInfo topmargin" onclick="write_message();">Send</button>
                    <input id="image" name = "image" type="file" accept="image/jpeg, image/png, image/jpg">
                    <div class = "userInfo topmargin leftmargin">  
                    </div>
                </form>
            </div>
            <script>
                load_messages(<?php echo $_SESSION['topic_id'] ?>, true, 1);
                LoadMessagesInterval = setInterval(load_messages, 1000, <?php echo $_SESSION['topic_id'] ?>, <?php echo check_auth()?>);
            </script>
        </div>
    </body>
</html>
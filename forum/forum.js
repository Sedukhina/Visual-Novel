function load_topics()
{
    document.getElementById('message-input').style.display = "none";
    $('#TopicName').text("Topics");
    $.ajax({
        type: "get",
        url:  "/../forum/load-topics.php",
        context: $(".forum-messages"),
        dataType: "html",
        success: function(html)
        {
            $(this).empty();
            $(this).append(html);
            $(this).scrollTop(90000);
        }
    });
    $.ajax({
        type: "get",
        url:  "/../forum/is-admin.php",
        dataType: "text",
        success: function(text)
        {
            if(text == 1){
                document.getElementById('NewTopicDiv').style.display = "block";
            }
        }
    });
}

function load_messages(topic_id, usr, load_all)
{
    if(Object.is(topic_id, -1))
    {
        load_topics();
    }
    else
    {
        document.getElementById('NewTopicDiv').style.display = "none";
        $.ajax({
            type: "get",
            url:  "/../forum/load-topic-name.php",
            context: $(".TopicName"),
            dataType: "text",
            success: function(text)
            {
                $('#TopicName').text(text);
            }
        })   
        if(Object.is(load_all, 1)){
            $.ajax({
                type: "get",
                url:  "/../forum/load-messages.php",
                context: $(".forum-messages"),
                dataType: "html",
                success: function(html)
                {
                    $(this).empty();
                    $(this).append(html);
                    $(this).scrollTop(90000);
                }
            });
        }
        else{
            $.ajax({
                type: "get",
                url:  "/../forum/load-new-messages.php",
                context: $(".forum-messages"),
                dataType: "html",
                success: function(html)
                {
                    $(this).append(html);
                }
            });
        }
        if(usr){
            document.getElementById('message-input').style.display = "block";
        }
    }
}

function write_message()
{
    $.ajax({
        type: 'POST',
        url:  "/../forum/write-message.php",
        data: new FormData(writeMessage),
        contentType: false,
        cache: false,
        processData:false,
        success: function(html)
        {
           console.log(html);
        }
    })
}

function change_topic(topic_id)
{
    $.ajax({
        type: 'post', 
        url: '/../forum/change-topic.php', 
        data: {topic_id: topic_id},
        success: function()
        { 
            if (typeof LoadMessagesInterval != "undefined") {
                clearInterval(LoadMessagesInterval);
            }
            $('#page').load('/../forum/forum.php');
        }
    });
}

function CreateTopic()
{
    var TopicName = document.getElementById('NewTopic').value;
    $.ajax({
        type: 'post', 
        url: '/../forum/create-topic.php', 
        data: {TopicName: TopicName},
        success: function(r)
        { 
            if (typeof LoadMessagesInterval != "undefined") {
                clearInterval(LoadMessagesInterval);
            }
            $('#page').load('/../forum/forum.php');
        }
    });
}
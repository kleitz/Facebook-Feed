<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Facebook Feed</title>
    <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
</head>
<body>
    <h1>jQuery Facebook Feed</h1>

    <div id="facebook-feed"> </div>

    <script type="text/javascript">
        $(document).ready(function(){
            var html = "";
            var count = 1;
            $.getJSON("http://localhost/Labs/Facebook/facebook.json", function(feeds){
                for(var i = 0; i < feeds.data.length; i++) {
                    var message = feeds.data[i].message;
                    var id = feeds.data[i].id;
                    var date = new Date(feeds.data[i].created_time).toDateString();
                    var link = feeds.data[i].link;
                    var pic = feeds.data[i].full_picture;

                    html += "<div class='post'>";
                    html += "<p><strong>" + message + "</strong></p>";
                    html += "<p>" + date + "</p>";
                    html += "<p>" + "<img src='" + pic + "'/> </p>";
                    html += "<a class='btn' target='_blank' href='" + link + "'>" + "Read more" + "</a>";
                    html += "<p class='count'>" + count + "</p>";
                    html += "</div>";
                    count++;
                }
                $("#facebook-feed").append(html);
            });
        });
    </script>

</body>
</html>

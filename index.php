<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=GB2312">
        <title></title>

        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    </head>

    <body>
        <div class="banner">

            <div class="container">
                <div class="banner-right-text">
                    <h3>Call Us:<br /><span>(800)</span><i>1444 000 4040</i></h3>
                </div>
                <div class="top-menu">
                    <span class="menu"> </span>
                    <ul class="nav navbar-nav">
                        <li><a class="active" href="index.html">Home <span class="sr-only">(current)</span></a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="trainers.html">Trainers</a></li>
                        <li><a href="404.html">Support</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                        <div class="clearfix"> </div>
                    </ul>
                </div>
                <!-- script-for-menu -->
                <script>
                    $("span.menu").click(function(){
                        $(".top-menu ul").slideToggle("slow" , function(){
                        });
                    });
                </script>
                <!-- script-for-menu -->	 
            </div>
        </div>
        <?php
        echo "<a href='list_book.php'>书籍列表</a>";
        echo "<br/>";
        echo "<a href='list_review.php'>复习列表</a>";



        exit();
        ?>

    </body>
</html>

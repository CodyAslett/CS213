<html>
    <head>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <div id=""
        <div id="header">
            <?php
                $header = file_get_contents('./parts/header.html', true);
                echo $header;
            ?>
        </div>
        <div class="body" id="intro">
            <?php
                $intro = file_get_contents('./introduction/introduction.html', true);
                echo $intro;
            ?>
        </div>
    </body>
</html>
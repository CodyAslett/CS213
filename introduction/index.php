<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cody Aslett - Resume</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/devicons/css/devicons.min.css" rel="stylesheet">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/resume.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

        <?php
                $menu = file_get_contents('./menu.html', true);
                echo $menu;
            ?>

    <div class="container-fluid p-0">

        <?php
                $header = file_get_contents('./header.html', true);
                echo $header;
            ?>

        <?php
            /*$experience = file_get_contents('./experience.html', true);
                echo $experience;*/
            ?>
      
        <?php
            $education = file_get_contents('./education.html', true);
                echo $education;
            ?>
      
        <?php
            $skills = file_get_contents('./skills.html', true);
                echo $skills;
            ?>



      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="interests">
        <div class="my-auto">
          <h2 class="mb-5">Interests</h2>
          <p>I enjoy a combination of indoor and outdoor activities. In the winter, I am an avid skier. During the warmer months I enjoy camping.</p>
          <p class="mb-0">When indoors, I follow a number of sci-fi and fantasy genre movies and television shows, I am a casual gamer, and I spend a large amount of my free time exploring the latest technology advancements.</p>
 </div>
      </section>

    <?php
        /*
        $awards = file_get_contents('./awards.html', true);
        echo $awards;
        */
    ?>

    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/resume.min.js"></script>

  </body>

</html>

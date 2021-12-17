<?php
include("../path.php");
include(ROOT_PATH . "/app/controllers/topics.php");
$breadcrumbTitle = "About Me";
$breadcrumbMain = "About";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL . '/favicon.ico'; ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Custom Styling -->
    <link rel="stylesheet" href="../themes/css/main.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Pluviophile - Contact</title>
</head>

<body>

    <!-- Header -->
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    <!-- // Header -->

    <!-- Main Search Form -->
    <?php include(ROOT_PATH . "/app/includes/searchForm.php"); ?>

    <!-- // Main Search Form -->

    <!-- Main Content -->
    <!-- Breadcrumb -->
    <?php include(ROOT_PATH . "/app/includes/breadcrumb.php"); ?>

    <div class="container contact-page">
        <div class="row about-me">
            <div class="col c-12 m-4 m-o-1 l-4 l-o-1">
                <img src="<?php echo BASE_URL . '/public/storage/general/wp1957039-kevin-de-bruyne-wallpapers.jpg'; ?>" alt="">
            </div>
            <div class="about-detail col c-12 m-4 m-o-1 l-5 l-o-1">
                <h2>Hello I'm <br> <span>Kevin De Bruyne</span></h2>
                <p>Born 28 June 1991, i am a Belgian professional footballer who plays as a midfielder for Premier League club Manchester City and the Belgium national team. I am widely regarded as one of the best midfielders of my generation and i have often been described as a "complete footballer"</p>
            </div>
            <div class="col c-12 m-12 l-12">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/0XaiAIUisq4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <!-- // Main Content -->

    <!-- Footer -->
    <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
    <!-- // Footer -->

    <!-- Back To Top Button -->
    <button id="back-to-top-btn">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Custom Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../themes/js/scripts.js"></script>
    <script src="../js/processContact.js"></script>

</body>

</html>
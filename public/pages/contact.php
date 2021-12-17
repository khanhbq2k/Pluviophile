<?php
include("../path.php");
include(ROOT_PATH . "/app/controllers/topics.php");
$breadcrumbTitle = "Contact";
$breadcrumbMain = "Home";
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
    <div id="alert-container"></div>
    <div class="scroll-progress"></div>

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
        <div class="row">
            <div class="col c-12 m-12 l-12">
                <div class="contact-info">
                    <p>Address: B1 Building, Tran Dai Nghia Street, Ha Noi 100000</p>
                    <p>Hotline: 18002412</p>
                    <p>Email: contact@email.com</p>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.660780666494!2d105.84095036443556!3d21.006230643924052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac76ccab6dd7%3A0x55e92a5b07a97d03!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBraG9hIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1637894857782!5m2!1svi!2s" width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        <p class="col c-12 m-12 l-12">For the fastest reply, please use the contact form below.</p>
        <form method="post" id="contact-form" class="contact-form row" action="<?php echo BASE_URL . '/app/helpers/processContact.php'; ?>" accept-charset="UTF-8">
            <div class="col c-12 m-6 l-6">
                <div class="contact-form-group">
                    <label class="contact-label required" for="contact-name">
                        Name
                    </label>
                    <input type="text" class="contact-form-input" name="name" id="contact-name" placeholder="Name" required>
                </div>
            </div>
            <div class="col c-12 m-6 l-6">
                <div class="contact-form-group">
                    <label class="contact-label required" for="contact-email">
                        Email
                    </label>
                    <input type="mail" class="contact-form-input" name="email" id="contact-email" placeholder="Email" required>
                </div>
            </div>
            <div class="col c-12 m-6 l-6">
                <div class="contact-form-group">
                    <label class="contact-label" for="contact-address">
                        Address
                    </label>
                    <input type="text" class="contact-form-input" name="address" id="contact-address" placeholder="Address">
                </div>
            </div>
            <div class="col c-12 m-6 l-6">
                <div class="contact-form-group">
                    <label class="contact-label" for="contact-phone">
                        Phone
                    </label>
                    <input type="number" class="contact-form-input" name="phone" id="contact-phone" placeholder="Phone">
                </div>
            </div>
            <div class="col c-12 m-12 l-12">
                <div class="contact-form-group">
                    <label class="contact-label" for="contact-subject">
                        Subject
                    </label>
                    <input type="text" class="contact-form-input" name="subject" id="contact-subject" placeholder="Subject">
                </div>
            </div>
            <div class="col c-12 m-12 l-12">
                <div class="contact-form-group">
                    <label class="contact-label required" for="contact-content">
                        Message
                    </label>
                    <textarea type="text" class="contact-form-input" name="content" id="contact-content" placeholder="Message" required></textarea>
                </div>
            </div>
            <p class="col c-12 m-12 l-12">The field with (*) is required.</p>
            <button type="submit" class="btn btn-primary contact-button">Send</button>
        </form>
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
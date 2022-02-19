<?php
include("../path.php");
include(ROOT_PATH . "/app/controllers/users.php");
guestsOnly();
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
    <title>Pluviophile - Login</title>
</head>

<body>
    <!-- Form error helpers -->
    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

    <!-- Main Content -->
    <div class="container login">
        <div class="login-form">
            <form action="login.php" method="POST">
                <a href="<?php echo BASE_URL . '/public/index.php'; ?>" class="logo">
                    <img class="logo-img" src="<?php echo BASE_URL . '/public/storage/general/logo_img.png'; ?>" alt="Pluviophile">
                </a>
                <h2 class="title"> Log in</h2>
                <p class="subtitle">Don't have an account? <a href="<?php echo BASE_URL . '/public/pages/register.php'; ?>"> Sign up</a></p>
                <p class="or"><span>or</span></p>
                <div class="email-login">
                    <label for="username"> <b>Username</b></label>
                    <input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
                    <label for="password"><b>Password</b></label>
                    <input type="password" placeholder="Password" name="password" value="<?php echo $password; ?>" required>
                </div>
                <button type="submit" name="login-btn" class="btn-primary cta-btn">Log in</button>
                <a class="forget-pass" href="#">Forgot password?</a>
            </form>
        </div>
    </div>

    <!-- // Main Content -->

    <!-- Custom Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../themes/js/scripts.js"></script>

</body>

</html>
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
    <title>Pluviophile - Register</title>
</head>

<body>
    <!-- Form error helpers -->
    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
    
    <!-- Main Content -->
    <div class="container register">
        <div class="register-form">
            <form action="register.php" method="POST">
                <a href="<?php echo BASE_URL . '/public/index.php'; ?>" class="logo">
                    <img class="logo-img" src="<?php echo BASE_URL . '/public/storage/general/logo_img.png'; ?>" alt="Pluviophile">
                </a>
                <h2 class="title"> Sign up</h2>
                <p class="subtitle">Already have an account? <a href="<?php echo BASE_URL . '/public/pages/login.php'; ?>"> Login</a></p>
                <p class="or"><span>or</span></p>
                <div class="email-register">
                    <label for="username"> <b>Username</b></label>
                    <input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
                    <label for="fullname"> <b>Full Name</b></label>
                    <input type="text" placeholder="Full name" name="fullname" value="<?php echo $fullname; ?>" required>
                    <label for="email"> <b>Email</b></label>
                    <input type="text" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                    <label for="password"><b>Password</b></label>
                    <input type="password" placeholder="Password" name="password" value="<?php echo $password; ?>" required>
                    <label for="passwordConf"><b>Confirm password</b></label>
                    <input type="password" placeholder="Confirm password" name="passwordConf" value="<?php echo $passwordConf; ?>" required>
                </div>
                <button type="submit" name="register-btn" class="btn-primary cta-btn">Sign up</button>
            </form>
        </div>
    </div>

    <!-- // Main Content -->

    <!-- Custom Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../themes/js/scripts.js"></script>

</body>

</html>
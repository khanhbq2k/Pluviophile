<?php
include("../../public/path.php");
include("../../app/controllers/topics.php");
adminOnly();
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
    <link rel="stylesheet" href="../../public/themes/css/main.css">
    <title>Pluviophile - Add Topic</title>
</head>

<body>
    <div id="alert-container"></div>
    <div class="scroll-progress"></div>

    <!-- Admin Header -->
    <?php include(ROOT_PATH . '/app/includes/adminHeader.php'); ?>
    <!-- //Admin Header -->

    <!-- Admin Wrapper -->
    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

    <div class="admin-wrapper">
        <div class="container">
            <div class="row">
                <!-- Admin Sidebar -->
                <?php include(ROOT_PATH . '/app/includes/adminSidebar.php'); ?>
                <div class="admin-content col c-8 m-10 l-10">
                    <h1>Add Topic</h1>
                    <form action="create.php" method="post">
                        <div>
                            <label>Name</label>
                            <input type="text" name="name" value="<?php echo $name; ?>" class="text-input">
                        </div>
                        <div>
                            <label>Description</label>
                            <textarea name="description" value="<?php echo $description; ?>"></textarea>
                        </div>
                        <button type="submit" name="add-topic" class="btn btn-primary">Add Topic</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- // Admin Wrapper -->


    <!-- Custom Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
    <script src="../../public/themes/js/scripts.js"></script>
    <script src="../../public/themes/js/ckEditor.js"></script>

</body>

</html>
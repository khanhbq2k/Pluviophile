<?php
include("../../public/path.php");
include(ROOT_PATH . "/app/controllers/topics.php");
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
    <title>Pluviophile - Manage Topics</title>
</head>

<body>
    <div id="alert-container"></div>
    <div class="scroll-progress"></div>

    <!-- Admin Header -->
    <?php include(ROOT_PATH . '/app/includes/adminHeader.php'); ?>
    <!-- //Admin Header -->

    <!-- Admin Wrapper -->
    <div class="admin-wrapper">
        <div class="container">
            <div class="row">
                <!-- Admin Sidebar -->
                <?php include(ROOT_PATH . '/app/includes/adminSidebar.php'); ?>
                <div class="admin-content col c-8 m-10 l-10">
                    <h1>Manage Topics</h1>

                    <div class="button-group">
                        <a class="btn btn-primary" href="create.php">Add Topic</a>
                    </div>

                    <?php include(ROOT_PATH . '/app/includes/messages.php'); ?>

                    <table id="table">
                        <thead>
                            <th onclick="sortIntColumn(0)">Index</th>
                            <th onclick="sortStringColumn(1)">Name</th>
                            <th colspan="2">Actions</th>
                        </thead>
                        <tbody>

                            <?php foreach ($topics as $key => $topic) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $topic['name']; ?></td>
                                    <td><a href="edit.php?id=<?php echo $topic['id']; ?>" class="edit">Edit</a></td>
                                    <td><a href="index.php?del_id=<?php echo $topic['id']; ?>" class="delete">Delete</a></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
    <!-- // Admin Wrapper -->


    <!-- Custom Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
    <script src="../../public/themes/js/scripts.js"></script>
    <script src="<?php echo BASE_URL . '/public/js/sortTable.js'; ?>"></script>

</body>

</html>
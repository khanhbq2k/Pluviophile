<?php
include("../../public/path.php");
include(ROOT_PATH . "/app/controllers/users.php");
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
    <title>Pluviophile - Manage Users</title>
</head>

<body>
    
    <?php include(ROOT_PATH . '/app/includes/messages.php'); ?>

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
                    <h1>Manage Users</h1>

                    <div class="button-group">
                        <a class="btn btn-primary" href="create.php">Add User</a>
                    </div>

                    <?php include(ROOT_PATH . '/app/includes/messages.php'); ?>

                    <table id="table">
                        <thead>
                            <th onclick="sortIntColumn(0)">ID</th>
                            <th onclick="sortStringColumn(1)">Username</th>
                            <th onclick="sortStringColumn(2)">Full Name</th>
                            <th onclick="sortStringColumn(3)">Role</th>
                            <th onclick="sortStringColumn(4)">Email</th>
                            <th colspan="2">Actions</th>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key => $user) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['fullname']; ?></td>
                                    <?php if ($user['admin'] == 1) : ?>
                                        <td>admin</td>
                                    <?php else : ?>
                                        <td>user</td>
                                    <?php endif; ?>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><a href="edit.php?id=<?php echo $user['id']; ?>" class="edit">Edit</a></td>
                                    <td><a href="index.php?delete_id=<?php echo $user['id']; ?>" class="delete">Delete</a></td>
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
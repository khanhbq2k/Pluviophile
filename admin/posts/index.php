<?php
include("../../public/path.php");
include(ROOT_PATH . "/app/controllers/posts.php");
adminOnly();

$posts = getAllPosts();
foreach ($posts as $key => $post) {
    $posts[$key]['created_at'] = strtotime($posts[$key]['created_at']);
    $posts[$key]['created_at'] = date('j M, Y', $posts[$key]['created_at']);
}
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
    <title>Pluviophile - Manage posts</title>
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
                    <h1>Manage Posts</h1>

                    <div class="button-group">
                        <a class="btn btn-primary" href="create.php">Add Post</a>
                    </div>

                    <?php include(ROOT_PATH . '/app/includes/messages.php'); ?>

                    <table id="table">
                        <thead>
                            <th onclick="sortIntColumn(0)">Index</th>
                            <th onclick="sortStringColumn(1)">Title</th>
                            <th onclick="sortStringColumn(2)">Topic</th>
                            <th onclick="sortIntColumn(3)">Views</th>
                            <th onclick="sortIntColumn(3)">Date Created</th>
                            <th colspan="3">Actions</th>
                        </thead>
                        <tbody>
                            <?php foreach ($posts as $key => $post) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $post['title']; ?></td>
                                    <td><?php echo $post['name']; ?></td>
                                    <td><?php echo $post['views']; ?></td>
                                    <td><?php echo $post['created_at']; ?></td>
                                    <td><a href="edit.php?id=<?php echo $post['id']; ?>" class="edit">Edit</a></td>
                                    <td><a href="index.php?delete_id=<?php echo $post['id']; ?>" class="delete">Delete</a></td>
                                    <?php if ($post['published']) : ?>
                                        <td><a href="edit.php?published=0&p_id=<?php echo $post['id']; ?>" class="unpublish">Unpublish</a></td>
                                    <?php else : ?>
                                        <td><a href="edit.php?published=1&p_id=<?php echo $post['id']; ?>" class="publish">Publish</a></td>
                                    <?php endif; ?>
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
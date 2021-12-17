<?php
include("path.php");
include(ROOT_PATH . "/app/controllers/topics.php");

$posts = array();
$target = 0;
$noSearchResult = 0;

if (isset($_GET['name'])) {
    $target = 0;
    $posts = getPostsByTopicName($_GET['name']);
    $breadcrumbTitle = $_GET['name'];
    $breadcrumbMain = "Home";
} else if (isset($_POST['search-term'])) {
    $target = 1;
    $posts = searchPosts($_POST['search-term']);
    if (empty($posts)) {
        $noSearchResult = 1;
        $title = 'No available search results for "' . $_POST['search-term'] . '"';
    }
    $breadcrumbTitle = 'Search result for: "' . $_POST['search-term'] . '"';
    $breadcrumbMain = "Search";
} else {
    $target = 2;
    $allPublishedPosts = getPublishedPosts();
    $paginatedPosts = getPaginatedPosts();
    $posts = array_slice($allPublishedPosts, 0, 6);
}

if (isset($_GET['page']) && isset($_GET['ajax'])) {
    $paginatedPosts = getPaginatedPosts($_GET['page']);
    echo json_encode($paginatedPosts);
    exit();
}


$highlightTopics = array('Film', 'Philosophy', 'Love');
$featuredTopics = array_slice($topics, 0, 6);
$i = 0;

formatPostDate($posts);

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
    <link rel="stylesheet" href="./themes/css/main.css">
    <title>Pluviophile - My Personal Blog</title>
</head>

<body>

    <!-- TODO: -->
    <!-- Off canvas sidebar -->
    <aside id="sidebar-wrapper"></aside>
    <!-- // Off canvas sidebar -->

    <!-- Header -->
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    <!-- // Header -->

    <!-- Messages -->
    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
    <div class="message"></div>
    <!-- // Messages -->

    <!-- Form Errors -->
    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
    <!-- // Form Errors -->

    <!-- Main Search Form -->
    <?php include(ROOT_PATH . "/app/includes/searchForm.php"); ?>

    <!-- // Main Search Form -->

    <!-- Main Content -->
    <main>

        <?php if ($target == 0 || $target == 1) : ?>
            <!-- Breadcrumb -->
            <?php include(ROOT_PATH . '/app/includes/breadcrumb.php'); ?>
            <!-- // Breadcrumb -->
        <?php else : ?>
            <!-- Featured-1 -->
            <?php include(ROOT_PATH . "/app/includes/featured-1.php"); ?>
            <!-- // Featured-1 -->
        <?php endif; ?>

        <!-- Main Posts -->
        <div class="featured-posts">
            <div class="container">
                <?php if ($noSearchResult == 1) : ?>
                    <div class="featured-title">
                        <?php echo $title; ?>
                    </div>
                <?php elseif ($target == 2) : ?>
                    <div class="featured-header">
                        Featured Posts
                    </div>
                <?php endif; ?>

                <div class="row">
                    <?php foreach ($posts as $key => $post) : ?>
                        <div class="col c-12 m-4 l-4">
                            <a href="<?php echo BASE_URL . '/public/pages/single.php?id=' . $post['id']; ?>">
                                <div class="post">
                                    <div class="post-thumb">
                                        <!-- <img class="post-thumb-img" src="./storage/galleries/1.jpg" alt=""> -->
                                        <img src="<?php echo BASE_URL . '/public/storage/thumbnails/' . $post['image']; ?>" alt="" class="post-thumb-img">
                                    </div>
                                    <div class="post-content">
                                        <div class="post-topic">
                                            <?php echo $post['name']; ?>
                                        </div>
                                        <div class="post-title">
                                            <?php echo $post['title']; ?>
                                        </div>
                                        <div class="post-detail">
                                            <div class="post-on">
                                                <?php echo $post['created_at']; ?>
                                            </div>
                                            <i class="fas fa-circle"></i>
                                            <div class="post-viewed">
                                                <?php echo $post['views']; ?> VIEWS
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Recent Posts -->
        <div class="featured-posts">
            <div class="container">
                <?php if ($target == 2) : ?>
                    <div class="featured-header">
                        Recent Posts
                    </div>

                    <div class="row post-lists">
                        <?php foreach ($paginatedPosts['posts'] as $key => $post) : ?>
                            <div class="col c-12 m-4 l-4">
                                <a href="<?php echo BASE_URL . '/public/pages/single.php?id=' . $post['id']; ?>">
                                    <div class="post">
                                        <div class="post-thumb">
                                            <img src="<?php echo $post['image']; ?>" alt="" class="post-thumb-img">
                                        </div>
                                        <div class="post-content">
                                            <div class="post-topic">
                                                <?php echo $post['name']; ?>
                                            </div>
                                            <div class="post-title">
                                                <?php echo $post['title']; ?>
                                            </div>
                                            <div class="post-detail">
                                                <div class="post-on">
                                                    <?php echo $post['created_at']; ?>
                                                </div>
                                                <i class="fas fa-circle"></i>
                                                <div class="post-viewed">
                                                    <?php echo $post['views']; ?> VIEWS
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="pagination-links">
                        <button type="button" class="btn btn-secondary btn-load-more">Load more</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- // Recent Posts -->


        <!-- Main Posts -->

        <!-- Highlight Posts By Topics -->
        <?php include(ROOT_PATH . '/app/includes/featuredPostsByTopics.php'); ?>
        <!-- // Highlight Posts By Topics -->

        <!-- Featured Topics -->
        <?php include(ROOT_PATH . '/app/includes/featuredTopics.php'); ?>
        <!-- // Featured Topics -->


    </main>
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
    <script src="./themes/js/scripts.js"></script>
    <script src="./js/pagination.js"></script>
    <script src="./js/processSubscribe.js"></script>

</body>

</html>
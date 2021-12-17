<?php
include("../path.php");
include(ROOT_PATH . '/app/controllers/posts.php');

if (isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]);
    $post['created_at'] = date('j M, Y',strtotime($post['created_at']));
}

$posts = selectAll('posts', ['published' => 1]);
$topics = selectAll('topics');
$comments = selectAllComments($post['id']);
$highlightTopics = array('Philosophy', 'Science', 'Music');
$featuredTopics = array_slice($topics, 0, 3);

$estimatedReadingTime = calculateEstimatedReadingTime($post['body'], 30);

foreach ($comments as $key => $comment) {
    $comments[$key]['created_at'] = date('j M, Y', strtotime($comments[$key]['created_at']));
}

if (!isset($_SESSION['viewInCertainPost'])) {
    $_SESSION['viewInCertainPost'] = array();
}

if (!in_array($post['id'], $_SESSION['viewInCertainPost'])) {
    updatePostViews($post['id']);
    array_push($_SESSION['viewInCertainPost'], $post['id']);
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
    <link rel="stylesheet" href="../themes/css/main.css">
    <title><?php echo $post['title']; ?> - Pluviophile</title>
</head>

<body>
    <div id="alert-container"></div>
    <div class="scroll-progress"></div>

    <!-- Messages -->
    <div class="message"></div>
    <!-- // Messages -->

    <!-- Form Errors -->
    <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
    <!-- // Form Errors -->

    <!-- Header -->
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    <!-- // Header -->

    <!-- Main Search Form -->
    <?php include(ROOT_PATH . "/app/includes/searchForm.php"); ?>

    <!-- // Main Search Form -->

    <!-- Main Content -->

    <div class="container single-content">
        <!-- Entry Header -->
        <div class="entry-header">
            <h1 class="entry-title">
                <?php echo $post['title']; ?>
            </h1>
            <div class="row">
                <div class="col c-12 m-6 l-6">
                    <div class="entry-meta">
                        <div>
                            By
                            <span class="author">KEVIN DE BRUYNE</span>
                        </div>
                        <div class="entry-detail">
                            <span class="created-date"><?php echo $post['created_at']; ?></span>
                            <i class="fas fa-circle"></i>
                            <span class="post-length"><?php echo $estimatedReadingTime; ?> mins read</span>
                        </div>
                    </div>
                </div>
                <div class="col c-0 m-6 l-6">
                    <div class="header-social-network">
                        <div class="share-text">Share this:</div>
                        <div class="header-social-network-link">
                            <a href="https://www.facebook.com" class="facebook-link" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="https://www.twitter.com" class="facebook-link" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com" class="facebook-link" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- // Entry Header -->

        <!-- Figure -->
        <figure class="image">
            <img src="<?php echo BASE_URL . '/public/storage/images/' . $post['image']; ?>" alt="" class="post-thumb-img">
        </figure>
        <!-- // Figure -->

        <!-- Entry Wrapper -->
        <article class="container entry-wrapper">

            <?php echo html_entity_decode($post['body']); ?>

            <div class="article-vote">
                <i class="up-vote fas fa-chevron-up"></i>
                <span id="vote" class="up-voted"><?php echo $post['upvotes']; ?></span>
                <i class="down-vote fas fa-chevron-down"></i>
                <span class="article-viewed"><?php echo $post['views']; ?> VIEWS</span>
            </div>

            <a href="<?php echo BASE_URL . '/public/pages/aboutMe.php'; ?>">
                <div class="author-bio">
                    <img src="<?php echo BASE_URL . '/public/storage/general/avatar.jpg'; ?>" alt="My Portrait">
                    <div>
                        <div class="author-name">
                            Kevin De Bruyne
                        </div>
                        <div class="author-detail">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi autem blanditiis deleniti inventore porro quidem rem suscipit voluptatibus! Aut illum libero, praesentium quis quod rerum sint? Ducimus iure nulla totam!</p>
                        </div>
                    </div>
                </div>
            </a>

            <div class="container comment-section">
                <!-- Comment Form -->
                <form method="POST" id="comment-form" class="comment-form">
                    <?php if (isset($_SESSION['id'])) : ?>
                        <input id="user-id" type="hidden" value="<?php echo $_SESSION['id']; ?>">
                    <?php endif; ?>
                    <input id="post-id" type="hidden" value="<?php echo $post['id']; ?>">
                    <input id="comment-content" type="text" name="comment-content" class="comment-form-input" placeholder="Type your comment here ...">
                    <button id="post-comment" type="submit" name="send-comment" class="btn btn-primary">Send</button>
                </form>
                <!-- // Comment Form -->

                <!-- Comment Section -->
                <div class="all-comment"></div>
                <!-- // Comment Section -->

            </div>

        </article>
        <!-- // Entry Wrapper -->
    </div>

    <!-- Highlight Posts By Topics -->
    <?php include(ROOT_PATH . '/app/includes/featuredPostsByTopics.php'); ?>
    <!-- // Highlight Posts By Topics -->

    <!-- Featured Topics -->
    <?php include(ROOT_PATH . '/app/includes/featuredTopics.php'); ?>
    <!-- // Featured Topics -->


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
    <script src="<?php echo BASE_URL . '/public/js/processComment.js'; ?>"></script>
    <script src="<?php echo BASE_URL . '/public/js/processVote.js'; ?>"></script>

</body>

</html>
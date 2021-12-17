<div class="posts-by-topics">
    <div class="container">
        <div class="row">
            <?php foreach ($highlightTopics as $key1 => $topic) : ?>
                <div class="col c-12 m-4 l-4">
                    <a href="<?php echo BASE_URL . '/public/index.php?name=' . $topic; ?>">
                        <div class="text-title">
                            <?php echo $topic; ?>
                        </div>
                    </a>
                    <?php $allPostsByTopics = getPostsByTopicName($topic);
                    $postsByTopics = array_slice($allPostsByTopics, 0, 3);
                    foreach ($postsByTopics as $key => $post) {
                        $postsByTopics[$key]['created_at'] = strtotime($postsByTopics[$key]['created_at']);
                        $postsByTopics[$key]['created_at'] = date('j M, Y', $postsByTopics[$key]['created_at']);
                    }
                    ?>
                    <?php foreach ($postsByTopics as $post) : ?>
                        <a href="<?php echo BASE_URL . '/public/pages/single.php?id=' . $post['id']; ?>">
                            <div class="posts-block-list">
                                <ul class="posts-list">
                                    <li>
                                        <div class="post-thumb">
                                            <img src="<?php echo BASE_URL . '/public/storage/thumbnails/' . $post['image']; ?>" alt="" class="post-thumb-img">
                                            <!-- <img class="post-thumb-img" src="<?php echo BASE_URL . '/public/storage/categories/1.jpg'; ?>" alt=""> -->
                                        </div>
                                        <div class="post-content">
                                            <div class="post-title">
                                                <?php echo $post['title']; ?>
                                            </div>
                                            <div class="post-detail">
                                                <div class="post-on">
                                                    <?php echo $post['created_at']; ?>
                                                </div>
                                                <i class="fas fa-circle"></i>
                                                <div class="post-views">
                                                    <?php echo $post['views']; ?> VIEWS
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="main-topics">
    <div class="container">
        <div class="row topics-wrapper">
            <div class="col c-12 m-12 l-12">
                <div class="text-title">Categories</div>
            </div>
            <?php foreach ($featuredTopics as $key => $topic) : ?>
                <div class="col c-12 m-4 l-4 topic-item-wrapper">
                    <a href="<?php echo BASE_URL . '/public/index.php?name=' . $topic['name']; ?>">
                        <div class="topic-item">
                            <div class="topic-header">
                                <?php echo $topic['name']; ?>
                            </div>
                            <p class="topic-description">
                                <?php echo $topic['description']; ?>
                            </p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
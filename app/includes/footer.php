<footer>
    <div class="container">
        <div class="row">
            <div class="col c-12 m-6 l-4">
                <div class="footer-info">
                    <a href="<?php echo BASE_URL . '/public/pages/aboutMe.php'; ?>">
                        <div class="text-title footer-header">
                            About Me
                        </div>
                    </a>
                    <p class="footer-info-description">Start writing, no matter what. The water does not flow until the faucet is turned on.</p>
                    <p class="footer-info-description strong">Address</p>
                    <p class="footer-info-description">1 Dai Co Viet Street, HN 100000</p>
                    <p class="footer-info-description strong">Follow me</p>
                    <div class="footer-info-description-link">
                        <a href="https://www.facebook.com/bqk.269/" class="facebook-link" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="facebook-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="facebook-link">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col c-12 m-6 l-4">
                <div class="footer-links">
                    <div class="text-title footer-header">
                        Quick links
                    </div>
                    <ul class="footer-link">
                        <li>
                            <a href="<?php echo BASE_URL . '/public/index.php'; ?>">Homepage</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL . '/public/pages/contact.php'; ?>">Contact</a>
                        </li>
                        <?php
                        $topics_first_three = array_slice($topics, 0, 3);
                        ?>
                        <?php foreach ($topics_first_three as $topic) : ?>
                            <li class="header-menu-item">
                                <a href="#"><?php echo $topic['name']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col c-12 m-12 l-4">
                <div class="footer-subscribe">
                    <div class="text-title footer-header">
                        Newsletter
                    </div>
                    <div class="footer-subscribe-description">
                        Subscribe to our newsletter and get our newest updates right on your inbox.
                    </div>
                    <form>
                        <div class="subscribe-group">
                            <input id="input-subscribe" id="email" type="email" name="email" class="form-subscribe-input" placeholder="Enter your email">
                            <button name="email-subscribe" class="btn btn-large btn-primary subscribe-btn" type="button">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="footer-copy-right">
                &copy;2021 Pluviophile - My Personal Blog
            </div>
        </div>
    </div>
</footer>
<div class="main-header">
    <!-- Top Header -->
    <div class="header-top">
        <a href="<?php echo BASE_URL . '/public/index.php'; ?>" class="logo">
            <img class="logo-img" src="<?php echo BASE_URL . '/public/storage/general/logo.png'; ?>" alt="Pluviophile">
        </a>
        <div class="header-top-right">
            <button class="btn btn-with-icon header-search">
                <i class="btn-icon fas fa-search"></i>
                <div class="header-search-text">Search</div>
            </button>

            <?php if (isset($_SESSION['id'])) : ?>
                <div class="header-user-info">
                    <a href="">
                        <i class="fa fa-user"></i>
                        <span class="username"><?php echo $_SESSION['fullname']; ?></span>
                        <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
                    </a>
                    <ul>
                        <?php if ($_SESSION['admin']) : ?>
                            <a href="<?php echo BASE_URL . '/admin/dashboard.php' ?>">
                                <li>Dashboard</li>
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo BASE_URL . '/public/pages/logout.php'; ?>">
                            <li>Log out</li>
                        </a>
                    </ul>
                </div>
            <?php else : ?>
                <a href="<?php echo BASE_URL . '/public/pages/login.php'; ?>" class="">
                    <button class="btn btn-primary btn-login">
                        Log In
                    </button>
                </a>
                <a href="<?php echo BASE_URL . '/public/pages/register.php'; ?>" class="">
                    <button class="btn btn-signup">
                        Join Us
                    </button>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <!-- //Top Header -->

    <!-- Header Sticky -->
    <div class="header-sticky-wrapper">
        <div class="header-sticky">
            <div class="header-menu-bar">
                <i class="fas fa-bars"></i>
                Menu
            </div>
            <ul class="header-menu">
                <li class="header-menu-item">
                    <a class="header-anchor" href="<?php echo BASE_URL . "/public/index.php"; ?>">
                    <i class="header-menu-icon fas fa-home"></i>
                        Home
                    </a>
                </li>
                <?php
                $topics_first_six = array_slice($topics, 0, 6);
                $topics_remain = array_slice($topics, 6);
                ?>
                <?php foreach ($topics_first_six as $topic) : ?>
                    <li class="header-menu-item">
                        <a class="header-anchor" href="<?php echo BASE_URL . '/public/index.php?name=' . $topic['name']; ?>"><?php echo $topic['name']; ?></a>
                    </li>
                <?php endforeach; ?>
                <li class="header-menu-item">
                    <a class="header-anchor" href="<?php echo BASE_URL . '/public/pages/contact.php'; ?>">Contact</a>
                </li>
                <li class="header-menu-item header-menu-item-more">
                    <a class="header-anchor" href="">
                        More
                        <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
                    </a>
                    <ul>
                        <?php foreach ($topics_remain as $topic) : ?>
                            <li class="topic-more">
                                <a href="<?php echo BASE_URL . '/public/index.php?name=' . $topic['name']; ?>"><?php echo $topic['name']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
            <div class="header-menu-extras">
                <div class="header-menu-extras-link">
                    <a href="#" class="facebook-link">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="facebook-link">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="facebook-link">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
                <div class="header-off-canvas">
                    <i class="header-off-canvas-icon ti-align-left"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- // Header Sticky -->

</div>
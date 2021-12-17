<header>
    <div class="container">
        <div class="header-admin">
            <a href="<?php echo BASE_URL . '/public/index.php'; ?>" class="logo">
                <img class="logo-img" src="<?php echo BASE_URL . '/public/storage/general/logo.png'; ?>" alt="Pluviophile">
            </a>
            <div class="header-user">
                <a href="">
                    <i class="fa fa-user"></i>
                    <span class="username"><?php echo $_SESSION['fullname']; ?></span>
                    <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
                </a>
                <ul>
                    <a href="<?php echo BASE_URL . '/public/pages/logout.php'; ?>">
                        <li>Log out</li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</header>
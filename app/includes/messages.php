<?php if (isset($_SESSION['message'])) : ?>
    <div id="msg" class="<?php echo $_SESSION['type']; ?>">
        <i class="far fa-check-circle"></i>
        <ul>
            <li><?php echo $_SESSION['message']; ?></li>
        </ul>
        <?php 
            unset($_SESSION['message']);
            unset($_SESSION['type']);
        ?>
        <i class="ti-close"></i>
    </div>
<?php endif; ?>
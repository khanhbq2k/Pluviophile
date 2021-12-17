<?php if (count($errors) > 0) : ?>
    <div id="msg" class="error">
        <i class="fas fa-exclamation-triangle"></i>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        <i class="ti-close"></i>
    </div>
<?php endif; ?>
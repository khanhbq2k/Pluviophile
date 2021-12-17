<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validatePost.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$table = 'posts';

$topics = selectAll('topics');
$posts = selectAll($table);

$errors = array();
$id = "";
$title = "";
$body = "";
$topic_id = "";
$views = 0;
$published = "";

if (isset($_GET['id'])) {
    $post = selectOne($table, ['id' => $_GET['id']]);

    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];
    $topic_id = $post['topic_id'];
    $published = $post['published'];
    $views = $post['views'];
}

if (isset($_GET['delete_id'])) {
    adminOnly();
    $post = selectOne($table, ['id' => $_GET['delete_id']]);
    $imageName = $post['image'];
    $count = delete($table, $_GET['delete_id']);

    if (file_exists(ROOT_PATH . '/public/storage/thumbnails/' . $oldPost['image'])){
        unlink(ROOT_PATH . '/public/storage/thumbnails/' . $oldPost['image']);
    }
    if (file_exists(ROOT_PATH . '/public/storage/images/' . $oldPost['image'])){
        unlink(ROOT_PATH . '/public/storage/images/' . $oldPost['image']);
    }
    $_SESSION['message'] = "Post deleted successfully";
    $_SESSION['type'] = "success";
    header("location: " . BASE_URL . "/admin/posts/index.php");
    exit();
}

if (isset($_GET['published']) && isset($_GET['p_id'])) {
    adminOnly();
    $published = $_GET['published'];
    $p_id = $_GET['p_id'];
    $count = update($table, $p_id, ['published' => $published]);
    $_SESSION['message'] = "Post's published state changed!";
    $_SESSION['type'] = "success";
    header("location: " . BASE_URL . "/admin/posts/index.php");
    exit();
}

if (isset($_POST['add-post'])) {
    adminOnly();
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $maxImageSize = 5000000;
        $acceptableType = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');

        if ($_FILES['image']['size'] >= $maxImageSize || $_FILES['image']['size'] == 0) {
            array_push($errors, 'Image is too large, image must be less than 5 megabytes');
        }

        if (!in_array($_FILES['image']['type'], $acceptableType) && (!empty($_FILES['image']['type']))) {
            array_push($errors, 'Invalid type, only JPG, GIF, PNG are accepted');
        }

        if (count($errors) === 0) {
            $image_name = time() . '_' . $_FILES['image']['name'];
            $destination = ROOT_PATH . "/public/storage/images/" . $image_name;
            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            if ($result) {
                try{
                    if ($_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/jpg') {
                        if(!imagejpeg(imagecreatefromjpeg($destination), ROOT_PATH . '/public/storage/thumbnails/' . $image_name, 40)){
                            imagejpeg(imagecreatefrompng($destination), ROOT_PATH . '/public/storage/thumbnails/' . $image_name, 40);
                        }
                    } elseif ($_FILES['image']['type'] == 'image/png') {
                        imagejpeg(imagecreatefrompng($destination), ROOT_PATH . '/public/storage/thumbnails/' . $image_name, 40);
                    } else {
                        imagejpeg(imagecreatefromgif($destination), ROOT_PATH . '/public/storage/thumbnails/' . $image_name, 40);
                    }
                }catch(Exception $e){
                    echo $e;
                }
                $_POST['image'] = $image_name;
            } else {
                array_push($errors, 'Unexpected error, failed to upload the image');
            }
        }
    } else {
        array_push($errors, 'An image is required');
    }

    if (count($errors) === 0) {
        $_POST['id'] = uniqidReal();
        unset($_POST['add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);

        $post_id = create($table, $_POST);
        $_SESSION['message'] = "Post created successfully";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/posts/index.php");
        exit();
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }
}


if (isset($_POST['update-post'])) {
    adminOnly();
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $maxImageSize = 5000000;
        $acceptableType = array('image/jpeg', 'image/jpg', 'image/gif', 'image/png');

        if ($_FILES['image']['size'] >= $maxImageSize || $_FILES['image']['size'] == 0) {
            array_push($errors, 'Image is too large, image must be less than 5 megabytes');
        }

        if (!in_array($_FILES['image']['type'], $acceptableType) && (!empty($_FILES['image']['type']))) {
            array_push($errors, 'Invalid type, only JPG, GIF, PNG are accepted');
        }

        if (count($errors) === 0) {

            $oldPost = selectOne($table, ['id' => $_POST['id']]);

            try{
                unlink(ROOT_PATH . '/public/storage/thumbnails/' . $oldPost['image']);
                unlink(ROOT_PATH . '/public/storage/images/' . $oldPost['image']);
            }catch(Exception $e){
                echo $e;
            }

            $image_name = time() . '_' . $_FILES['image']['name'];
            $destination = ROOT_PATH . "/public/storage/images/" . $image_name;
            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            if ($result) {
                if ($_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/jpg') {
                    imagejpeg(imagecreatefromjpeg($destination), ROOT_PATH . '/public/storage/thumbnails/' . $image_name, 40);
                } elseif ($_FILES['image']['type'] == 'image/png') {
                    imagejpeg(imagecreatefrompng($destination), ROOT_PATH . '/public/storage/thumbnails/' . $image_name, 40);
                } else {
                    imagejpeg(imagecreatefromgif($destination), ROOT_PATH . '/public/storage/thumbnails/' . $image_name, 40);
                }
                $_POST['image'] = $image_name;
            } else {
                array_push($errors, 'Unexpected error, failed to upload the image');
            }
        }
    }

    if (count($errors) == 0) {
        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);

        $post_id = update($table, $id, $_POST);
        $_SESSION['message'] = "Post updated successfully";
        $_SESSION['type'] = "success";
        header("location: " . BASE_URL . "/admin/posts/index.php");
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }
}

/* Calculate the estimated reading time for a given piece of $content.
*
* @param string $content Content to calculate read time for.
* @param int $wpm Estimated words per minute of reader.
*
* @returns	int $time Estimated reading time.
*/
function calculateEstimatedReadingTime($content = '', $wpm = 200)
{
    $clean_content = strip_tags($content);
    $word_count = str_word_count($clean_content);
    $time = (int)(ceil($word_count / $wpm));
    return $time;
}

<?php
include("../../public/path.php");
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateComment.php");

if (!empty($_POST)) {
    validateComment($_POST);
    if(count($errors) === 0){
        create('comments', ['id' => uniqidReal(), 'user_id' => $_POST['user_id'], 'post_id' => $_POST['post_id'], 'content' => $_POST['content']]);
    }else{
        echo json_encode($errors);
    }
}

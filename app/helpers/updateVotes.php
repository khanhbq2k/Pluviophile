<?php 

include("../../public/path.php");
include(ROOT_PATH . "/app/database/db.php");

$votes = selectOne('posts', ['id' => $_GET['post_id']]);

if(!empty($votes)){
    echo json_encode($votes);
}
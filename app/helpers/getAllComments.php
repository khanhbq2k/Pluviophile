<?php 

include("../../public/path.php");
include(ROOT_PATH . "/app/database/db.php");

$comments = selectAllComments($_GET['post_id']);

if(!empty($comments)){
    echo json_encode($comments);
}
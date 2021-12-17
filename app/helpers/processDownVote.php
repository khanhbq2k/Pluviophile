<?php
include("../../public/path.php");
include(ROOT_PATH . "/app/database/db.php");

if (!empty($_POST)) {
    $vote = selectOne('votes', ['user_id' => $_POST['user_id'], 'post_id' => $_POST['post_id']]);

    if ($vote) {
        if ($vote['downvoted'] == 1) {
            update('votes', $vote['id'], ['downvoted' => 0]);
            upVotesByPostId($_POST['post_id']);
        } else {
            if ($vote['upvoted'] == 1) {
                update('votes', $vote['id'], ['downvoted' => 1]);
                update('votes', $vote['id'], ['upvoted' => 0]);
                downVotesByPostId($_POST['post_id']);
                downVotesByPostId($_POST['post_id']);
            } else {
                update('votes', $vote['id'], ['downvoted' => 1]);
                downVotesByPostId($_POST['post_id']);
            }
        }
    } else {
        create('votes', ['user_id' => $_POST['user_id'], 'post_id' => $_POST['post_id'], 'downvoted' => 1]);
        downVotesByPostId($_POST['post_id']);
    }
}

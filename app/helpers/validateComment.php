<?php 

$bannedWords = "vl nigga";
$errors = array();

function validateComment($comment)
{
    global $bannedWords, $errors;
    $content = $comment['content'];

    if(preg_match('~\b(' . str_replace(' ', '|', $bannedWords) . ')\b~', $content)){
        array_push($errors, 'There is banned word in your comment');
    }

}
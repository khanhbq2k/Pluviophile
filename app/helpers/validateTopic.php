<?php

/**
 * Validate data fields when create or update a topic
 *
 * @param string  $topic  Given object holding topic data fields to be validated
 * @return array          An array holding all the errors, empty array is no errors found
 */
function validateTopic($topic)
{
    $errors = array();

    if (empty($topic['name'])) {
        array_push($errors, 'Topic name is required');
    }

    $existingTopic = selectOne('topics', ['name' => $topic['name']]);
    if ($existingTopic) {
        if (isset($topic['update-topic']) && $existingTopic['id'] != $topic['id']) {
            array_push($errors, 'Topic name is already exists');
        }

        if (isset($topic['add-topic'])) {
            array_push($errors, 'Topic name is already exists');
        }
    }

    return $errors;
}

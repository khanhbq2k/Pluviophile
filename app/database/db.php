<?php

session_start();
require('connect.php');


/**
 * Dump and Die - Helper function
 *
 * @param object $value dumped value
 */
function dd($value)
{
    echo '<pre>', print_r($value), '<pre>';
    die();
}

/**
 * Execute a query with given conditions
 *
 * @param string $sql The sql statement
 * @param array $data The condition data array
 * @return query      Statement
 */
function executeQuery($sql, $data)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);

    $stmt->execute();
    return $stmt;
}

/**
 * Generate an unique 20-length id based on random_bytes function (cryptographically secure pseudo-random bytes)
 *
 * @param int $length   The desired length of the id
 * @return string       An unique 20-length id
 */
function uniqidReal($length = 20)
{
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($length / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
    } else {
        throw new Exception("No cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $length);
}

/**
 * Select all the records in a table from database with optional condition
 *
 * @param string $table     Table name 
 * @param array $conditions The conditions for the query
 * @return array            An array of associative arrays holding result rows
 */
function selectAll($table, $conditions = [])
{
    global $conn;
    $sql = "SELECT * FROM $table";
    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else {
        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }

        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}


/**
 * Select one record in a table from database with given condition
 *
 * @param string $table     Table name 
 * @param array $conditions The conditions for the query
 * @return array            An array holding result row
 */
function selectOne($table, $conditions)
{
    $sql = "SELECT * FROM $table";
    $i = 0;

    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " WHERE $key=?";
        } else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }

    $sql = $sql . " LIMIT 1";

    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}

/**
 * Insert a record into a table from database with given data
 *
 * @param string $table     Table name 
 * @param array $data       The given data
 * @return int              An id attached to the query statement
 */
function create($table, $data)
{
    $sql = "INSERT INTO $table SET ";
    $i = 0;

    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $stmt = executeQuery($sql, $data);
    return $data['id'];
}

/**
 * Update a record of a table from database with given data
 *
 * @param string $table     Table name 
 * @param string $id        The unique id of the target record 
 * @param array $data       The given data
 * @return int              Database's affected rows
 */
function update($table, $id, $data)
{
    $sql = "UPDATE $table SET ";
    $i = 0;

    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;
}

/**
 * Delete a record of a table from database with given id
 *
 * @param string $table     Table name 
 * @param string $id        The unique id of the target record 
 * @return int              Database's affected rows
 */
function delete($table, $id)
{
    $sql = "DELETE FROM $table WHERE id=?";
    $stmt = executeQuery($sql, ['id' => $id]);
    return $stmt->affected_rows;
}

/**
 * Get all posts that is published
 *
 * @return array    An array of associative arrays holding all posts
 */
function getPublishedPosts()
{
    $sql = "SELECT p.*, t.name FROM posts AS p JOIN topics as t ON p.topic_id=t.id WHERE p.published=? ORDER BY views desc";

    $stmt = executeQuery($sql, ['published' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

/**
 * Get all posts with topic name
 *
 * @return array    An array of associative arrays holding all posts
 */
function getAllPosts()
{
    global $conn;
    $sql = "SELECT p.*, t.name FROM posts AS p JOIN topics as t ON p.topic_id=t.id WHERE 1 ORDER BY views desc";

    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    if($result){
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    return $records;
}

/**
 * Get posts by pagination index
 *
 * @param int $currentPage      Current pagination page 
 * @param int $recordsPerPage   Numbers of posts per page
 * @return array                An array of associative arrays holding all posts by pagination index
 */
function getPaginatedPosts($currentPage = 1, $recordsPerPage = 6)
{
    $sql = "SELECT p.*, t.name FROM posts AS p JOIN topics as t 
            ON p.topic_id=t.id 
            WHERE p.published=1 
            ORDER BY p.created_at DESC 
            LIMIT ?,?";
    $data = [
        'offset' => ($currentPage - 1) * $recordsPerPage,
        'numberOfRecords' => $recordsPerPage
    ];

    $stmt = executeQuery($sql, $data);
    $posts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    sleep(0.5);
    return [
        'posts' => formatPostFields($posts),
        'nextPage' => count($posts) < $recordsPerPage ? false : $currentPage + 1,
    ];
}

/**
 * Format data fields of paginated posts, for displaying in html purpose
 *
 * @param array $posts   An array of paginated posts
 * @return array         An formatted array of paginated posts
 */
function formatPostFields($posts)
{
    if(empty($posts)){
        return [];
    }

    $formattedPosts = [];
    foreach($posts as $post){
        $currentPost = $post;
        $currentPost['created_at'] = date('j M, Y',strtotime($post['created_at']));
        $currentPost['image'] = BASE_URL . '/public/storage/thumbnails/' . $post['image'];
        array_push($formattedPosts, $currentPost);
    }
    
    return $formattedPosts;
}

/**
 * Get all posts by topic name
 *
 * @param string $id   The unique id of the topic
 * @return array       An array of associative arrays holding all posts by topic
 */
function getPostsByTopicName($topic_name)
{
    $sql = "SELECT p.*, t.name FROM posts AS p JOIN topics as t ON p.topic_id=t.id WHERE p.published=? AND t.name=?";

    $stmt = executeQuery($sql, ['published' => 1, 'name' => $topic_name]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

/**
 * Search all posts that contain the given term in post's title or body
 *
 * @param string $term   The input search term
 * @return array         An array of associative arrays holding all posts by given search term
 */
function searchPosts($term)
{
    $match = '%' . $term . '%';
    $sql = "SELECT p.*, t.name
            FROM posts as p
            JOIN topics as t
            ON p.topic_id=t.id
            WHERE p.published=?
            AND p.title LIKE ?
            OR p.body LIKE ?";

    $stmt = executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

/**
 * Select all comments from a post 
 *
 * @param string    $post_id Post Id
 * @return array    An array of associative arrays holding all comments by given post
 */
function selectAllComments($post_id)
{
    $sql = "SELECT c.*, u.fullname FROM comments as c JOIN users as u ON c.user_id=u.id WHERE c.post_id=? ORDER BY c.created_at desc";

    $stmt = executeQuery($sql, ['post_id' => $post_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

/**
 * Increase upvotes value in posts table by 1 
 *
 * @param string    $post_id Post Id
 */
function upVotesByPostId($post_id)
{
    global $conn;
    $sql = "UPDATE posts SET upvotes = upvotes + 1 WHERE id='$post_id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

/**
 * Decrease upvotes value in posts table by 1 
 *
 * @param string    $post_id Post Id
 */
function downVotesByPostId($post_id)
{
    global $conn;
    $sql = "UPDATE posts SET upvotes = upvotes - 1 WHERE id='$post_id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

/**
 * Update total views of a post  
 *
 * @param string    $post_id Post Id
 */
function updatePostViews($post_id){
    global $conn;
    $sql = "UPDATE posts SET views = views + 1 WHERE id='$post_id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

/**
 * Get total views of all pages in the website
 *
 * @return int      Total views
 */
function getAllPageViews(){
    global $conn;
    $sql = "SELECT SUM(views) as sum_views FROM posts";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $views = $stmt->get_result()->fetch_assoc();
    return $views;
}
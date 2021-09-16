<?php
class messages extends DatabaseManager{

}

// Receives a user id and returns the username
function getUsernameById($id)

{

    global $db;
    $result = mysqli_query($db, "SELECT username FROM users WHERE id=" . $id . " LIMIT 1");
    // return the username
    return mysqli_fetch_assoc($result)['username'];
}
// Receives a comment id and returns the username
function getRepliesByCommentId($id)
{
    global $db;
    $result = mysqli_query($db, "SELECT * FROM replies WHERE comment_id=$id");
    $replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $replies;
}
// Receives a post id and returns the total number of comments on that post
function getCommentsCountByPostId($post_id)
{
    global $db;
    $result = mysqli_query($db, "SELECT COUNT(*) AS total FROM comments");
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

?>


<?php
// If the user clicked submit on comment form...
if (isset($_POST['comment_posted'])) {
    global $db;
    // grab the comment that was submitted through Ajax call
    $comment_text = $_POST['comment_text'];
    // insert comment into database
    $sql = "INSERT INTO comments (post_id, user_id, body, created_at, updated_at) VALUES (1, " . $user_id . ", '$comment_text', now(), null)";
    $result = mysqli_query($db, $sql);
    // Query same comment from database to send back to be displayed
    $inserted_id = $db->insert_id;
    $res = mysqli_query($db, "SELECT * FROM comments WHERE id=$inserted_id");
    $inserted_comment = mysqli_fetch_assoc($res);
    // if insert was successful, get that same comment from the database and return it
   
}
// If the user clicked submit on reply form...
if (isset($_POST['reply_posted'])) {
    global $db;
    // grab the reply that was submitted through Ajax call
    $reply_text = $_POST['reply_text'];
    $comment_id = $_POST['comment_id'];
    // insert reply into database
    $sql = "INSERT INTO replies (user_id, comment_id, body, created_at, updated_at) VALUES (" . $user_id . ", $comment_id, '$reply_text', now(), null)";
    $result = mysqli_query($db, $sql);
    $inserted_id = $db->insert_id;
    $res = mysqli_query($db, "SELECT * FROM replies WHERE id=$inserted_id");
    $inserted_reply = mysqli_fetch_assoc($res);
    // if insert was successful, get that same reply from the database and return it
    if ($result) {
        $reply = "<div class='comment reply clearfix'>
                <img src='profile.png' alt='' class='profile_pic'>
                <div class='comment-details'>
                    <span class='comment-name'>" . getUsernameById($inserted_reply['user_id']) . "</span>
                    <span class='comment-date'>" . date('F j, Y ', strtotime($inserted_reply['created_at'])) . "</span>
                    <p>" . $inserted_reply['body'] . "</p>
                    <a class='reply-btn' href='#'>reply</a>
                </div>
            </div>";
        echo $reply;
        exit();
    } else {
        echo "error";
        exit();
    }
}

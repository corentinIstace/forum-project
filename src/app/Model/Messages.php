<?php

declare(strict_types=1);

require_once '../app/libraries/DatabaseManager.php';

class Messages extends DatabaseManager
{
  public function getMessages($topicId)
  {
    $db = $this->connectDb();
    $req = $db->prepare("SELECT * FROM messages WHERE topic_id = :topic_id ORDER BY creation_date ASC");
    $req->execute(['topic_id' => $topicId]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }

  private function fetchMessages($MessagesId)
  {
    $db = $this->connectDb();
    $req = $db->prepare("SELECT * FROM messages WHERE MessagesId = :MessagesId");
    $req->execute(['messagesId' => $MessagesId]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getMessage($MessagesId)
  {
    $data = $this->fetchMessages($MessagesId);
    return $data;
  }

  private function fetchSingleMessage($id)
  {
    $db = $this->connectDb();
    $req = $db->prepare("SELECT * FROM messages WHERE id=:id");
    $req->execute(["id" => $id]);
    return $req->fetch(PDO::FETCH_ASSOC);
  }

  private function insertMessage($message)
  {
    $db = $this->connectDb();
    $req = $db->prepare("INSERT INTO messages (author_id, topic_id, creation_date, edition_date, content) 
                                      VALUES (:author_id, :topic_id, NOW(), NULL, :content)");
    $req->execute($message);
  }

  public function setMessage($message)
  {
    $message = [
      'author_id' => $message['author_id'],
      'topic_id' => $message['topic_id'],
      'content' => $message['content']
    ];
    $this->insertMessage($message);
  }  
}




 /* TODO use style in View/topics
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Comment and reply system in PHP</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../View/messages/main.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 post">
                <h2>Post title</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum nam illum ipsum corporis voluptatibus, perspiciatis possimus vitae consequuntur. Voluptate quisquam reprehenderit sapiente cupiditate esse, consequuntur vel dicta culpa dolorem rerum.</p>
            </div>

            <!-- comments section -->
            <div class="col-md-6 col-md-offset-3 comments-section">
                <!-- comment form -->

                <form class="clearfix" method="post" id="comment_form">
                    <h4>Post a comment:</h4>
                    <textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3"></textarea>
                    <button class="btn btn-primary btn-sm pull-right" id="submit_comment" value="<? $message_content ?>">Submit comment</button>
                </form>

                <!-- Display total number of comments on this post  -->
                <h2><span id="comments_count">0</span> Comment(s)</h2>
                <hr>
                <!-- comments wrapper -->
                <div id="comments-wrapper">
                    <div class="comment clearfix">
                        <?php foreach ($messages as $message) : ?>

                            <img src="profile.png" alt="" class="profile_pic">
                            <div class="comment-details">
                                <span class="comment-name"><? $messages->id ?></span>

                                <span class="comment-date"><? $messages->creation_date ?></span>
                                <p><? $message->created ?></p>
                                <a class="reply-btn" href="#">reply</a>
                            </div>
                            <div>
                                <!-- reply -->
                                <div class="comment reply clearfix">
                                    <img src="profile.png" alt="" class="profile_pic">
                                    <div class="comment-details">
                                        <span class="comment-name">Awa</span>
                                        <span class="comment-date">Apr 24, 2018</span>
                                        <p>Hey, why are you the first to comment on this post?</p>
                                        <a class="reply-btn" href="#">reply</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- // comments wrapper -->
            </div>
            <!-- // comments section -->
        </div>
    </div>
    <!-- Bootstrap Javascript -->
</body>


</html>

*/
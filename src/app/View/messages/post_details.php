<!-- TODO use html structure and style into View/topics -->
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../../public/css/screen.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/9b934638d1.js" crossorigin="anonymous"></script>

  <title>Seigneur Des Anneaux</title>
</head>

<body>
<?php require '../app/View/includes/header.php'; ?>
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
                    <button class="btn btn-primary btn-sm pull-right" id="submit_comment">Submit comment</button>
                </form>

                <!-- Display total number of comments on this post  -->
                <h2><span id="comments_count">0</span> Comment(s)</h2>
                <hr>
                <!-- comments wrapper -->
                <div id="comments-wrapper">
                    <div class="comment clearfix">
                        <img src="profile.png" alt="" class="profile_pic">
                        <div class="comment-details">
                            <span class="comment-name">Melvine</span>
                            <span class="comment-date">Apr 24, 2018</span>
                            <p>This is the first reply to this post on this website.</p>
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
                <!-- // comments wrapper -->
            </div>
            <!-- // comments section -->
        </div>
    </div>
    <!-- Javascripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php require '../app/View/includes/footer.php'; ?>  
</body>

</html>
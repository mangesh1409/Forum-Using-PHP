<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Welcome To iDiscuss-Coding Forums</title>
</head>

<body>
    <!-- Navbar -->
    <?php require '/xampp/htdocs/Programs/Forum/partial/_header.php' ?>
    <?php require '/xampp/htdocs/Programs/Forum/partial/_dbconnect.php' ?>
    <?php
    $id = $_GET['treadid'];    //we submit catid using get request
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }
    ?>

    <?php
        
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            // Insert Into Comment DB
            $showAlert = false;
            $comment = $_POST['comment'];
            $email=$_SESSION['useremail'];

            $sql2="select sno from `users` where user_email='$email'";
            $result2 = mysqli_query($conn, $sql2);
            $row2= mysqli_fetch_assoc($result2);
            $sno=$row2['sno'];

            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`) VALUES ('$comment','$id', '$sno')";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Your comment has been added !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        }
    ?>

    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title ?></h1>
            <p class="lead"><?php echo $desc ?></p>
            <hr class="my-4">
            <p>This is peer to peer forum. No spam / Advertising / Self-promote is not allowed. Do not post copyright-infringing material. Do not post "offensive" post,links or images. Do not post cross questions. Remain respectful of other members at all times..</p>
           
        </div>
    </div>

    <?php 
            if(isset($_SESSION['loggedin']) && (($_SESSION['loggedin'] == true))){
                echo '<div class="container">
                            <h2 class="py-2">Post Your Comment</h2>
                                <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                                    <div class="form-group">
                                    <label for="comment">Type Your Comment</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Post Comment</button>
                                </form>
                    </div>';
            }
            else{
                    echo '<div class="container">
                            <h2 class="py-2">Post Your Comment</h2>
                            <p class="lead text-danger">You not logged in. Kindly logged in to start discussion</p>
                            </div>';
            }

    ?>

    <!-- Programs/Forum/img/user.png -->
    <div class="container">
        <h2 class="py-2">Discussions</h2>
        <?php
                $id = $_GET['treadid'];    //we submit catid using get request
                $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
                $result = mysqli_query($conn, $sql);
                $noresult = true;
                while ($row = mysqli_fetch_assoc($result)) {
                    $noresult = false;
                    $content = $row['comment_content'];
                    $id = $row['comment_id'];
                    $comment_time=$row['comment_time'];
                    $thread_user_id=$row['comment_by'];
                    $sql2="select user_email from `users` where sno='$thread_user_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2= mysqli_fetch_assoc($result2);

                    echo  '<div class="media my-3 py-2">
                                        <img src="/Programs/Forum/img/user.png" width="34px" class="mr-3" alt="...">
                                        <div class="media-body">
                                        <p class="font-weight-bold my-0">Comment by : '.$row2['user_email'].' at '. $comment_time.'</p>
                                            ' . $content . '
                                        </div>
                                    </div>';
                }
                if ($noresult) {
                    echo  '<div class="jumbotron jumbotron-fluid">
                                                        <div class="container">
                                                            <p class="display-4">No Comments Found</p>
                                                            <p class="lead">Be the first person to comment.</p>
                                                        </div>
                                                    </div>';
                }
        ?>
    </div>

    <?php require '/xampp/htdocs/Programs/Forum/partial/_footer.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>
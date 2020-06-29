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
            $id = $_GET['catid'];    //we submit catid using get request
            $sql = "SELECT * FROM `categories` WHERE category_id=$id";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $catname = $row['category_name'];
                $catdesc = $row['category_description'];
            }
    ?>
    
    <?php
        $method = $_SERVER['REQUEST_METHOD'];
        if($method=='POST'){
            $showAlert=false;
            $th_title=$_POST['title'];
            $th_desc=$_POST['desc'];

            $email=$_SESSION['useremail'];
            $sql2="select sno from `users` where user_email='$email'";
            $result2 = mysqli_query($conn, $sql2);
            $row2= mysqli_fetch_assoc($result2);
            $sno=$row2['sno'];            

            $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $showAlert=true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success !</strong> Your thread has been added ! Please wait for community to respond.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }

        }
    ?>  

     <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">Welcome To <?php echo $catname ?> Forums</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>This is peer to peer forum. No spam / Advertising / Self-promote is not allowed. Do not post copyright-infringing material. Do not post "offensive" post,links or images. Do not post cross questions. Remain respectful of other members at all times..</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <!-- echo $_SESSION['useremail']; -->

    <?php 
            if(isset($_SESSION['loggedin']) && (($_SESSION['loggedin'] == true))){
                echo '<div class="container">
                    <h2 class="py-2">Start Discussion</h2>
                    <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Problem Title</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Elaborate Your Concern</label>
                            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>';
            }
            else{
                    echo '<div class="container">
                            <h2 class="py-2">Start Discussion</h2>
                            <p class="lead text-danger">You not logged in. Kindly logged in to start discussion</p>
                          </div>';
            }
    ?>
   
    <!-- Programs/Forum/img/user.png -->
    <div class="container">
        <h2 class="py-2">Browes Questions</h2>
        <?php
                $id = $_GET['catid'];    //we submit catid using get request
                $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
                $result = mysqli_query($conn, $sql);
                $noresult = true;
                while ($row = mysqli_fetch_assoc($result)) {
                    $noresult = false;
                    $title = $row['thread_title'];
                    $desc = $row['thread_desc'];
                    $id = $row['thread_id'];
                    $thread_time=$row['timestamp'];
                    $thread_user_id=$row['thread_user_id'];

                    $sql2="select user_email from `users` where sno='$thread_user_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2= mysqli_fetch_assoc($result2);
                    // $email=$row2['user_email'];


                    echo  '<div class="media my-3 py-2">
                                    <img src="/Programs/Forum/img/user.png" width="34px" class="mr-3" alt="...">
                                    <div class="media-body">
                                    <h5 class="mt-0"><a class="text-dark" href="/Programs/Forum/thread.php?treadid=' . $id . '">' . $title . '</a></h5>
                                        ' . $desc . '</div><p class="font-weight-bold my-0">Asked by : '.$row2['user_email'].' at '. $thread_time.'</p>
                                </div>';
                }
                if ($noresult) {
                    echo  '<div class="jumbotron jumbotron-fluid">
                                        <div class="container">
                                            <p class="display-4">No Threads Found</p>
                                            <p class="lead">Be the first person to ask question.</p>
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
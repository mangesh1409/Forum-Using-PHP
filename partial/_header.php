<?php

    require '/xampp/htdocs/Programs/Forum/partial/_dbconnect.php' ;
    session_start();

    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="index.php">iDiscuss</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link btn-outline-secondary" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Top Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

                $sql = "SELECT * FROM `categories`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                      echo '<a class="dropdown-item" href="/Programs/Forum/threadlist.php?catid=' . $row['category_id'] . '">'.$row['category_name'].'</a>';                  
                }
               echo ' </div>
              </li>
            </ul>        
            <div class="mx-2 row">';

          if (isset($_SESSION['loggedin']) && (($_SESSION['loggedin'] == true))) {
              echo '<form class="form-inline my-2 my-lg-0">
                    <p class="text-light my-0 mx-3"> Welcome ' . $_SESSION['useremail'] . '</p></form>
                    <a href="partial/_logout.php" class="btn btn-outline-success ml-2">Logout</a>';
          }
          else {
            echo '<button class="btn btn-outline-success ml-2"data-toggle="modal"data-target="#loginModal">Login</    button>
                  <button class="btn btn-outline-success ml-2"data-toggle="modal" data-target="#signupModal">Sign Up</button>';
          }
    echo '</div></div></nav>';
    // if (isset($_SESSION['loggedin']) && (($_SESSION['loggedin'] == true))) {
    //   echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    //   <strong>Success!</strong> You are logged in successfully.
    //   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //     <span aria-hidden="true">&times;</span>
    //   </button>
    // </div>';
    
    // }
  

    include '/xampp/htdocs/Programs/Forum/partial/_loginModal.php';
    include '/xampp/htdocs/Programs/Forum/partial/_signupModal.php';

  

    if (isset($_GET['signupsuccess']) && ($_GET['signupsuccess'] == "true")) {
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                      <strong>Success!</strong> Your account is created. Now you can log in.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
    }
    elseif(isset($_GET['signupsuccess'])&&($_GET['signupsuccess']=="false")&&($_GET['error']=="Email already in use")){
          echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
          <strong>Fail!</strong> Email already in use.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
      }
    elseif(isset($_GET['signupsuccess'])&&($_GET['signupsuccess']=="false")&&($_GET['error']=="Password do not match")){
      echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Fail!</strong> Password Do Not Match.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>';
      }

?>

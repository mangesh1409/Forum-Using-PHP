<?php

    $showError="false";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include '_dbconnect.php';
        $email=$_POST['loginEmail'];
        $pass=$_POST['loginPassword'];
       
        $sql="select * from `users` where user_email='$email'";
        $result=mysqli_query($conn,$sql);
        $numRows=mysqli_num_rows($result);
        //echo $numRows;

        if($numRows==1){
            while($row=mysqli_fetch_assoc($result)){
                if(password_verify($pass,$row['user_pass'])){
                    //echo "login done"; 
                    session_start();
                    $_SESSION['loggedin']=true;
                    $_SESSION['useremail']=$email;
                    $_SESSION['id']=$row['sno'];
                    // echo $_SESSION['id'];

                    header("Location:/Programs/Forum/index.php");
                    
                }
                // else{
                //     $showError ="Invalid Credentials";
                //     header("Location:/Programs/Forum/index.php");
                //     //echo "unable";
                // }
                header("Location:/Programs/Forum/index.php");
            }                  
        }
    }
?>
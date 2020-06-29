<?php

    $showError="false";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include '_dbconnect.php';
        $email=$_POST['signupemail'];
        $pass=$_POST['signuppassword'];
        $cpass=$_POST['signupcpassword'];
        //check username already exits or not
        $exitSql="select * from `users` where user_email='$email'";
        $result=mysqli_query($conn,$exitSql);
        $numRows=mysqli_num_rows($result);
        //echo $numRows;

        if($numRows>0){
            $showError="Email already in use";
        }
        else{
            if($pass==$cpass){
                $hash=password_hash($pass,PASSWORD_DEFAULT);
                $sql="INSERT INTO `users` (`user_email`, `user_pass`) VALUES ('$email', '$hash')";
                $result=mysqli_query($conn,$sql);
                if($result){
                    $showAlert=true;
                    header("Location:/Programs/Forum/index.php?signupsuccess=true");
                    exit();
                }
            }
            else{
                $showError='Password do not match';
            }
        }
        header("Location:/Programs/Forum/index.php?signupsuccess=false&error=$showError");
    }
?>
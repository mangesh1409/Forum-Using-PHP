<?php

        session_start();
        echo "Logging You Out..Please Wait...";
        session_unset();
        session_destroy();
        header("Location:/Programs/Forum/index.php");
        exit;

?>
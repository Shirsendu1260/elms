<?php
    session_unset();
    session_destroy();
    header("Location: ../user/user_login.php");
?>
<?php
    session_start();
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "elms");
    $password = "";
    $sql = "SELECT * FROM users WHERE email = '$_SESSION[email]';";
    $run_query = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_assoc($run_query)){
        $password = $row['password'];
    }
    if($password == $_POST['old_password']){
        if($_POST['new_password'] == $_POST['conf_password']){
            $sql = "UPDATE users SET password = '$_POST[new_password]' WHERE email = '$_SESSION[email]' AND uid = '$_SESSION[uid]';";
            $run_query = mysqli_query($connection, $sql);
            echo '<script type="text/javascript">
                alert("Password changed successfully.");
                window.location.href = "../user/user_dashboard.php";
            </script>';
        }
        else{
            header("Location: ../user/user_change_pw.php");
        }
    }
    else{
        header("Location: ../user/user_change_pw.php");
    } 
?>
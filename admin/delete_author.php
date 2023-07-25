<?php
    session_start();
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "elms");
    $decoded_aid = base64_decode($_GET['aid']);
    $sql = "DELETE FROM authors WHERE aid = $decoded_aid";
    $result = $connection -> query($sql);
    if($result){
        echo '<script type="text/javascript">
                    alert("Author deleted sucessfully.");
                    window.location.href = "../admin/manage_authors.php";
                </script>';
    }
    else{
        echo '<script type="text/javascript">
                    alert("Unable to delete author. Try again later");
                    window.location.href = "../admin/manage_authors.php";
                </script>';
    }
?>
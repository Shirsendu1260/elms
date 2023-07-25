<?php
    session_start();
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "elms");
    $decoded_bid = base64_decode($_GET['bid']);
    $sql = "DELETE FROM books WHERE bid = $decoded_bid";
    $result = $connection -> query($sql);
    if($result){
        echo '<script type="text/javascript">
                    alert("Book deleted sucessfully.");
                    window.location.href = "../admin/manage_books.php";
                </script>';
    }
    else{
        echo '<script type="text/javascript">
                    alert("Unable to delete book. Try again later");
                    window.location.href = "../admin/manage_books.php";
                </script>';
    }
?>
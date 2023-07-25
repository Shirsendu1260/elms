<?php
    session_start();
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "elms");
    $decoded_bid = base64_decode($_GET['bid']);
    $decoded_uid = base64_decode($_GET['uid']);
    $decoded_rating = base64_decode($_GET['rating']);
    $sql = "SELECT rid FROM ratings WHERE book_id = $decoded_bid AND user_id = $decoded_uid;;";
    $result = $connection -> query($sql);
    if($result -> num_rows > 0){
        $sql_update = "UPDATE ratings SET rating = $decoded_rating WHERE book_id = $decoded_bid AND user_id = $decoded_uid;";
        $temp_result = $connection -> query($sql_update);
        if($temp_result){
            echo '<script type="text/javascript">
                    alert("Thanks for giving this book a rating.");
                    window.location.href = "../user/borrowed_books.php";
                </script>';
        }
        else{
            echo '<script type="text/javascript">
                    alert("Unable to fetch your selected rating. Try again later");
                    window.location.href = "../user/borrowed_books.php";
                </script>';
        }
    }
    else{
        $sql_insert = "INSERT INTO ratings VALUES (NULL, $decoded_rating, $decoded_uid, $decoded_bid);";
        $temp_result = $connection -> query($sql_insert);
        if($temp_result){
            echo '<script type="text/javascript">
                    alert("Thanks for giving this book a rating.");
                    window.location.href = "../user/borrowed_books.php";
                </script>';
        }
        else{
            echo '<script type="text/javascript">
                    alert("Unable to fetch your selected rating. Try again later");
                    window.location.href = "../user/borrowed_books.php";
                </script>';
        }
    }
?>
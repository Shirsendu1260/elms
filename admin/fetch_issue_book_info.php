<?php
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "elms");

    $ibid = $_POST['ibid'];
    $book = "";
    $user = "";
    
    $sql = "SELECT books.name AS book, users.name AS user FROM issued_books JOIN books JOIN users ON issued_books.user_id = users.uid AND issued_books.book_id = books.bid WHERE issued_books.ibid = $ibid;";
    $run_query = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_assoc($run_query)){
        $book = $row['book'];
        $user = $row['user'];
    }

    $data = array(
        "issued_book_name"=> $book,
        "issued_user_name"=> $user
    );

    header("Content-Type: application/json");
    echo json_encode($data);
?>
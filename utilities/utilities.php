<?php
    function count_total_users(){
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
        $count = 0;
        $sql = "SELECT COUNT(*) AS count FROM users;";
        $run_query = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($run_query)){
            $count = $row['count'];
        }
        return($count);
    }

    function count_issued_books(){
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
        $count = 0;
        $sql = "SELECT COUNT(*) AS count FROM issued_books;";
        $run_query = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($run_query)){
            $count = $row['count'];
        }
        return($count);
    }

    function count_total_books(){
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
        $count = 0;
        $sql = "SELECT COUNT(*) AS count FROM books;";
        $run_query = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($run_query)){
            $count = $row['count'];
        }
        return($count);
    }

    function count_total_categories(){
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
        $count = 0;
        $sql = "SELECT COUNT(*) AS count FROM categories;";
        $run_query = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($run_query)){
            $count = $row['count'];
        }
        return($count);
    }

    function count_total_authors(){
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
        $count = 0;
        $sql = "SELECT COUNT(*) AS count FROM authors;";
        $run_query = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($run_query)){
            $count = $row['count'];
        }
        return($count);
    }

    function count_total_available_books(){
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
        $count = 0;
        $sql = "SELECT COUNT(*) AS count FROM books WHERE status = 1;";
        $run_query = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($run_query)){
            $count = $row['count'];
        }
        return($count);
    }

    function count_borrowed_books($user_id){
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
        $count = 0;
        $sql = "SELECT COUNT(*) AS count FROM issued_books WHERE user_id = $user_id;";
        $run_query = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($run_query)){
            $count = $row['count'];
        }
        return($count);
    }

    function count_rated_books(){
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
        $count = 0;
        $sql = "SELECT COUNT(DISTINCT book_id) AS count FROM ratings;";
        $run_query = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($run_query)){
            $count = $row['count'];
        }
        return($count);
    }
?>
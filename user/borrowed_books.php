<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | View Borrowed Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\styles.css">
</head>

<body>
    <?php
        require('../utilities/utilities.php');
        session_start();
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
        $bid = 0;
        $name = "";
        $price = 0;
        $author = "";
        $category = "";
        $issue_date = "";
        $due_date = "";
        $return_date = "";
        $days_late = 0;
        $fine = 0;

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else{
            $page = 1;
        }

        $limit = 4;
        $start = ($page - 1) * $limit;
        $sql = "SELECT books.bid, books.name, books.price, authors.name AS author, categories.name AS category, issued_books.issue_date, issued_books.due_date, issued_books.return_date, issued_books.days_late, issued_books.fine FROM issued_books JOIN books JOIN authors JOIN categories ON books.category_id = categories.cid AND issued_books.book_id = books.bid AND issued_books.author_id = authors.aid WHERE issued_books.user_id = $_SESSION[uid] LIMIT $start, $limit;";

        $result = $connection -> query("SELECT COUNT(*) AS count FROM issued_books JOIN books JOIN authors JOIN categories ON books.category_id = categories.cid AND issued_books.book_id = books.bid AND issued_books.author_id = authors.aid WHERE issued_books.user_id = $_SESSION[uid];");
        $count = $result -> fetch_all(MYSQLI_ASSOC);
        $total = $count[0]['count'];
        $total_pages = ceil($total / $limit);
        $previous = ($page == 1) ? 1 : ($page - 1);
        $next = ($page == $total_pages) ? $total_pages : ($page + 1);
    ?>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand fw-bold" href="../user/user_dashboard.php"><span class="text-primary">e</span>LMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown"
            aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav ms-auto d-inline-flex">
                <li class="nav-item">
                    <a class="nav-link" href="../user/library_info.php">Library Info.</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">My Profile</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../user/user_dashboard.php">Dashboard</a></li>
                        <li><a class="dropdown-item" href="../user/user_view_profile.php">View Profile</a></li>
                        <li><a class="dropdown-item" href="../user/user_edit_profile.php">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="../user/user_change_pw.php">Change Password</a></li>
                        <li><a class="dropdown-item" href="../user/user_logout.php">Logout</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Welcome <span class="fw-bold">
                            <?php echo $_SESSION['name']; ?>
                        </span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="form-container">
        <div class="card mt-1">
            <div class="card-header fs-5">
                Total Borrowed Books: <span>
                    <?php echo count_borrowed_books($_SESSION['uid']);?>
                </span>
            </div>
            <div class="card-body">
                <form class="d-flex my-2" role="search" action="..\user\search_borrowed_book.php" method="post">
                    <input class="form-control me-2" type="text" name="search" placeholder="Search any borrowed book">
                    <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
                </form>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Book ID</th>
                                <th>Name</th>
                                <th>Price (Rs.)</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Date Borrowed</th>
                                <th>Due Date</th>
                                <th>Return Date</th>
                                <th>Days Late</th>
                                <th>Fine (INR 25/Day)</th>
                                <th>Action</th>
                            </tr>
                            <?php
                                $run_query = mysqli_query($connection, $sql);
                                while($row = mysqli_fetch_assoc($run_query)){
                                    $bid = $row['bid'];
                                    $name = $row['name'];
                                    $price = $row['price'];
                                    $author = $row['author'];
                                    $category = $row['category'];
                                    $issue_date = $row['issue_date'];
                                    $due_date = $row['due_date'];
                                    $return_date = $row['return_date'];
                                    $days_late = $row['days_late'];
                                    $fine = $row['fine'];
                                ?>
                            <tr>
                                <td>
                                    <?php echo $bid;?>
                                </td>
                                <td>
                                    <?php echo $name;?>
                                </td>
                                <td>
                                    <?php echo $price;?>
                                </td>
                                <td>
                                    <?php echo $author;?>
                                </td>
                                <td>
                                    <?php echo $category;?>
                                </td>
                                <td>
                                    <?php echo $issue_date;?>
                                </td>
                                <td>
                                    <?php echo $due_date;?>
                                </td>
                                <td>
                                    <?php 
                                        if (is_null($return_date))
                                            echo "<div class='text-danger'>Not Returned Yet</div>";
                                        else
                                            echo "<div>".$return_date."</div>";
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        if (is_null($days_late))
                                            echo "<div>N/A</div>";
                                        else
                                            echo "<div>".$days_late."</div>";
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        if (is_null($fine))
                                            echo "<div>N/A</div>";
                                        else
                                            echo "<div class='text-danger'>".$fine."</div>";
                                    ?>
                                </td>
                                <td>
                                    <?php $url = "../user/ratings.php"."?bid=".base64_encode($bid)."&uid=".base64_encode($_SESSION['uid']); ?>
                                    <a href="<?php echo $url; ?>" class="text-light text-decoration-none"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"><button
                                            class="btn btn-success btn-sm my-1" name="rating">Rate This
                                            Book</button></a>
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Rate This Book
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Give this book a rating out of 5.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="<?php echo $url." &rating=".base64_encode(5); ?>"><button
                                                            type="button" class="btn btn-outline-success">5</button></a>
                                                    <a href="<?php echo $url." &rating=".base64_encode(4); ?>"><button
                                                            type="button" class="btn btn-outline-success">4</button></a>
                                                    <a href="<?php echo $url." &rating=".base64_encode(3); ?>"><button
                                                            type="button" class="btn btn-outline-success">3</button></a>
                                                    <a href="<?php echo $url." &rating=".base64_encode(2); ?>"><button
                                                            type="button" class="btn btn-outline-success">2</button></a>
                                                    <a href="<?php echo $url." &rating=".base64_encode(1); ?>"><button
                                                            type="button" class="btn btn-outline-success">1</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </thead>
                    </table>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-sm justify-content-end mt-2">
                        <li class="page-item">
                            <a class="page-link" href="..\user\borrowed_books.php?page=<?= $previous; ?>">Previous</a>
                        </li>
                        <?php for($i=1; $i<$total_pages; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="..\user\borrowed_books.php?page=<?= $i; ?>">
                                <?php echo $i; ?>
                            </a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="..\user\borrowed_books.php?page=<?= $next; ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <footer class="footer text-center">
        <span class="text-muted">&copy; 2021 eLMS. All rights reserved.</span>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | View Issued Books</title>
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
        $ibid = 0;
        $name = "";
        $isbn = "";
        $author = "";
        $bid = 0;
        $issue_date = "";
        $due_date = "";
        $return_date = "";
        $days_late = 0;
        $fine = 0;
        $status = 0;
        $issued_user = "";

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else{
            $page = 1;
        }

        $limit = 4;
        $start = ($page - 1) * $limit;
        $sql = "SELECT issued_books.ibid, books.name, books.isbn, authors.name AS author, books.bid, issued_books.issue_date, issued_books.due_date, issued_books.return_date, issued_books.days_late, issued_books.fine, issued_books.status, users.name AS issued_user FROM issued_books JOIN books JOIN authors JOIN users ON issued_books.user_id = users.uid AND issued_books.book_id = books.bid AND issued_books.author_id = authors.aid LIMIT $start, $limit;";

        $result = $connection -> query("SELECT COUNT(*) AS count FROM issued_books;");
        $count = $result -> fetch_all(MYSQLI_ASSOC);
        $total = $count[0]['count'];
        $total_pages = ceil($total / $limit);
        $previous = ($page == 1) ? 1 : ($page - 1);
        $next = ($page == $total_pages) ? $total_pages : ($page + 1);
    ?>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand fw-bold" href="../admin/admin_dashboard.php"><span class="text-primary">e</span>LMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown"
            aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav ms-auto d-inline-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Book</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../admin/issue_book.php">Issue Book</a></li>
                        <li><a class="dropdown-item" href="../admin/book_return.php">Book Return</a></li>
                        <li><a class="dropdown-item" href="../admin/add_book.php">Add New Book</a></li>
                        <li><a class="dropdown-item" href="../admin/manage_books.php">Manage Books</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Category</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../admin/add_category.php">Add New Category</a></li>
                        <li><a class="dropdown-item" href="../admin/manage_categories.php">Manage Categories</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Author</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../admin/add_author.php">Add New Author</a></li>
                        <li><a class="dropdown-item" href="../admin/manage_authors.php">Manage Authors</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/library_info.php">Library Info.</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">My Profile</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../admin/admin_dashboard.php">Dashboard</a></li>
                        <li><a class="dropdown-item" href="../admin/admin_view_profile.php">View Profile</a></li>
                        <li><a class="dropdown-item" href="../admin/admin_edit_profile.php">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="../admin/admin_change_pw.php">Change Password</a></li>
                        <li><a class="dropdown-item" href="../admin/admin_logout.php">Logout</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Welcome <span class="fw-bold text-primary">
                            <?php echo $_SESSION['name']; ?>
                        </span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="form-container">
        <div class="card mt-1">
            <div class="card-header fs-5">
                Total Cases of Book Issue: <span>
                    <?php echo count_issued_books();?>
                </span>
            </div>
            <div class="card-body">
                <form class="d-flex my-2" role="search" action="..\admin\search_issued_book.php" method="post">
                    <input class="form-control me-2" type="text" name="search"
                        placeholder="Search any issued book or by any user's name">
                    <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
                </form>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>ISBN</th>
                                <th>Author</th>
                                <th>Book ID</th>
                                <th>Date Issued</th>
                                <th>Due Date</th>
                                <th>Return Date</th>
                                <th>Days Late</th>
                                <th>Fine (INR 25/Day)</th>
                                <th>Status</th>
                                <th>Issued User</th>
                            </tr>
                            <?php
                                $run_query = mysqli_query($connection, $sql);
                                while($row = mysqli_fetch_assoc($run_query)){
                                    $ibid = $row['ibid'];
                                    $name = $row['name'];
                                    $isbn = $row['isbn'];
                                    $author = $row['author'];
                                    $bid = $row['bid'];
                                    $issue_date = $row['issue_date'];
                                    $due_date = $row['due_date'];
                                    $return_date = $row['return_date'];
                                    $days_late = $row['days_late'];
                                    $fine = $row['fine'];
                                    $status = $row['status'];
                                    $issued_user = $row['issued_user'];
                                ?>
                            <tr>
                                <td>
                                    <?php echo $ibid;?>
                                </td>
                                <td>
                                    <?php echo $name;?>
                                </td>
                                <td>
                                    <?php echo $isbn;?>
                                </td>
                                <td>
                                    <?php echo $author;?>
                                </td>
                                <td>
                                    <?php echo $bid;?>
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
                                            echo "<div>N/A</div>";
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
                                    <?php 
                                        if ($status == 0)
                                            echo "<div class='text-danger'>Inactive</div>";
                                        else
                                            echo "<div class='text-success'>Active</div>";
                                    ?>
                                </td>
                                <td>
                                    <?php echo $issued_user;?>
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
                            <a class="page-link" href="..\admin\books_issued.php?page=<?= $previous; ?>">Previous</a>
                        </li>
                        <?php for($i=1; $i<$total_pages; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="..\admin\books_issued.php?page=<?= $i; ?>">
                                <?php echo $i; ?>
                            </a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="..\admin\books_issued.php?page=<?= $next; ?>">Next</a>
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
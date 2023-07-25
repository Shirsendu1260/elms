<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Manage Books</title>
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
        $isbn = "";
        $status = "";
        $locker_no = 0;
        $price = 0;
        $author = "";
        $category = "";

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else{
            $page = 1;
        }

        $limit = 4;
        $start = ($page - 1) * $limit;
        $sql = "SELECT books.bid, books.name, books.isbn, books.status, books.locker_no, books.price, authors.name AS author, categories.name AS category FROM books JOIN authors JOIN categories ON books.author_id = authors.aid AND books.category_id = categories.cid LIMIT $start, $limit;";

        $result = $connection -> query("SELECT COUNT(*) AS count FROM books;");
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
                Manage Books<br>
                <span class="fs-6">
                    Total Registered Books: <span>
                        <?php echo count_total_books();?>
                    </span>
                </span>
            </div>
            <div class="card-body">
                <form class="d-flex my-2" role="search" action="..\admin\manage_searched_book.php" method="post">
                    <input class="form-control me-2" type="text" name="search" placeholder="Search any book">
                    <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
                </form>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>ISBN</th>
                                <th>Status</th>
                                <th>Locker</th>
                                <th>Price (Rs.)</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                            <?php
                                $run_query = mysqli_query($connection, $sql);
                                while($row = mysqli_fetch_assoc($run_query)){
                                    $bid = $row['bid'];
                                    $name = $row['name'];
                                    $isbn = $row['isbn'];
                                    $status = $row['status'];
                                    $locker_no = $row['locker_no'];
                                    $price = $row['price'];
                                    $author = $row['author'];
                                    $category = $row['category'];
                                ?>
                            <tr>
                                <td>
                                    <?php echo $bid;?>
                                </td>
                                <td>
                                    <?php echo $name;?>
                                </td>
                                <td>
                                    <?php echo $isbn;?>
                                </td>
                                <td>
                                    <?php 
                                        if ($status == 0)
                                            echo "<div class='text-danger'>Not Available</div>";
                                        else
                                            echo "<div class='text-success'>Available</div>";
                                    ?>
                                </td>
                                <td>
                                    <?php echo $locker_no;?>
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
                                    <?php $url1 = "../admin/edit_book.php"."?bid=".base64_encode($bid); ?>
                                    <?php $url2 = "../admin/delete_book.php"."?bid=".base64_encode($bid); ?>
                                    <a href="<?php echo $url1; ?>" class="text-light text-decoration-none"><button
                                            class="btn btn-success btn-sm my-1" name="edit">Edit</button></a>
                                    <a href="<?php echo $url2; ?>" class="text-light text-decoration-none"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"><button
                                            class="btn btn-danger btn-sm my-1" name="delete">Delete</button></a>
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm
                                                        Deletion</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this book?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">No</button>
                                                    <a href="<?php echo $url2; ?>"><button type="button"
                                                            class="btn btn-primary">Yes</button></a>
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
                            <a class="page-link" href="..\admin\manage_books.php?page=<?= $previous; ?>">Previous</a>
                        </li>
                        <?php for($i=1; $i<$total_pages; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="..\admin\manage_books.php?page=<?= $i; ?>">
                                <?php echo $i; ?>
                            </a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="..\admin\manage_books.php?page=<?= $next; ?>">Next</a>
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
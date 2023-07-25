<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\styles.css">
</head>

<body>
    <?php
        require('../utilities/utilities.php');
        session_start();
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
        <div class="card col-md-6">
            <div class="card-body">
                <h4 class="card-title my-1 text-center fw-bold">Admin Dashboard</h4><br>
                <div class="card mx-2 my-2 border-1 shadow-sm">
                    <div class="card-body navbar">
                        <a class="navbar-brand">Enrolled Users</a>
                        <div class="nav-item">
                            <a href="../admin/view_registered_users.php" class="btn btn-primary">View
                                <span class="badge bg-light text-dark">
                                    <?php echo count_total_users();?>
                                </span></a>
                        </div>
                    </div>
                </div>
                <div class="card mx-2 my-2 border-1 shadow-sm">
                    <div class="card-body navbar">
                        <a class="navbar-brand">Issued Books</a>
                        <div class="nav-item">
                            <a href="../admin/books_issued.php" class="btn btn-success">View <span
                                    class="badge bg-light text-dark">
                                    <?php echo count_issued_books();?>
                                </span></a>
                        </div>
                    </div>
                </div>
                <div class="card mx-2 my-2 border-1 shadow-sm">
                    <div class="card-body navbar">
                        <a class="navbar-brand">Listed Books</a>
                        <div class="nav-item">
                            <a href="../admin/total_books.php" class="btn btn-warning">View <span
                                    class="badge bg-light text-dark">
                                    <?php echo count_total_books();?>
                                </span></a>
                        </div>
                    </div>
                </div>
                <div class="card mx-2 my-2 border-1 shadow-sm">
                    <div class="card-body navbar">
                        <a class="navbar-brand">Rated Books</a>
                        <div class="nav-item">
                            <a href="../admin/book_ratings.php" class="btn btn-secondary">View <span
                                    class="badge bg-light text-dark">
                                    <?php echo count_rated_books();?>
                                </span></a>
                        </div>
                    </div>
                </div>
                <div class="card mx-2 my-2 border-1 shadow-sm">
                    <div class="card-body navbar">
                        <a class="navbar-brand">Listed Categories</a>
                        <div class="nav-item">
                            <a href="../admin/book_categories.php" class="btn btn-danger">View <span
                                    class="badge bg-light text-dark">
                                    <?php echo count_total_categories();?>
                                </span></a>
                        </div>
                    </div>
                </div>
                <div class="card mx-2 my-2 border-1 shadow-sm">
                    <div class="card-body navbar">
                        <a class="navbar-brand">Listed Authors</a>
                        <div class="nav-item">
                            <a href="../admin/book_authors.php" class="btn btn-primary">View <span
                                    class="badge bg-light text-dark">
                                    <?php echo count_total_authors();?>
                                </span></a>
                        </div>
                    </div>
                </div>
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
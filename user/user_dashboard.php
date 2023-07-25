<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | User Dashboard</title>
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
        <div class="card col-md-6">
            <div class="card-body">
                <h4 class="card-title my-1 text-center fw-bold">User Dashboard</h4><br>
                <div class="card mx-2 my-2 border-1 shadow-sm">
                    <div class="card-body navbar">
                        <a class="navbar-brand">Borrowed Books</a>
                        <div class="nav-item">
                            <a href="../user/borrowed_books.php" class="btn btn-success">View <span
                                    class="badge bg-light text-dark">
                                    <?php echo count_borrowed_books($_SESSION['uid']);?>
                                </span></a>
                        </div>
                    </div>
                </div>
                <div class="card mx-2 my-2 border-1 shadow-sm">
                    <div class="card-body navbar">
                        <a class="navbar-brand">Rated Books</a>
                        <div class="nav-item">
                            <a href="../user/book_ratings.php" class="btn btn-warning">View <span
                                    class="badge bg-light text-dark">
                                    <?php echo count_rated_books();?>
                                </span></a>
                        </div>
                    </div>
                </div>
                <div class="card mx-2 my-2 border-1 shadow-sm">
                    <div class="card-body navbar">
                        <a class="navbar-brand">Available Books</a>
                        <div class="nav-item">
                            <a href="../user/total_available_books.php" class="btn btn-danger">View <span
                                    class="badge bg-light text-dark">
                                    <?php echo count_total_available_books();?>
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
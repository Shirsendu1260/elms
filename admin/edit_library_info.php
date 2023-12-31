<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Edit Library Info.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\styles.css">
</head>

<body>
    <?php
        session_start();
        $library_data = json_decode(file_get_contents("../utilities/library.json"), true);
        $name = $library_data["name"];
        $address = $library_data["address"];
        $phone = $library_data["phone"];
        $email = $library_data["email"];
        $time_start = $library_data["time_start"];
        $time_end = $library_data["time_end"];
        $week_start = $library_data["week_start"];
        $week_end = $library_data["week_end"];
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
                <h4 class="card-title my-2 text-center fw-bold">Edit Library Details</h4>
                <form action="..\admin\library_info_update.php" method="post" class="my-3">
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="time_start">Library Opening Time</label>
                        <input type="text" name="time_start" class="form-control" value="<?php echo $time_start; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="time_end">Library Closing Time</label>
                        <input type="text" name="time_end" class="form-control" value="<?php echo $time_end; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="week_start">From</label>
                        <input type="text" name="week_start" class="form-control" value="<?php echo $week_start; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="week_end">To</label>
                        <input type="text" name="week_end" class="form-control" value="<?php echo $week_end; ?>">
                    </div>
                    <button type="submit" name="save" class="btn btn-outline-primary my-2">Save</button>
                </form>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Add New Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\styles.css">
</head>

<body>
    <?php
        session_start();
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
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
                <h4 class="card-title my-2 text-center fw-bold">Add New Book</h4>
                <form action="" method="post" class="my-3">
                    <div class="form-group mb-2">
                        <input type="text" name="name" placeholder="Book Name" class="form-control required">
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" name="isbn" placeholder="ISBN" class="form-control required">
                    </div>
                    <div class="form-group mb-2">
                        <select class="form-select" name="author">
                            <option selected disabled>Author</option>
                            <?php
                                $sql = "SELECT aid, name FROM authors;";
                                $run_query = mysqli_query($connection, $sql);
                                while($row = mysqli_fetch_assoc($run_query)){
                            ?>
                            <option value="<?php echo $row['aid']; ?>">
                                <?php echo $row['name']." (".$row['aid'].")"; ?>
                            </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <select class="form-select" name="category">
                            <option selected disabled>Category</option>
                            <?php
                                $sql = "SELECT cid, name FROM categories;";
                                $run_query = mysqli_query($connection, $sql);
                                while($row = mysqli_fetch_assoc($run_query)){
                            ?>
                            <option value="<?php echo $row['cid']; ?>">
                                <?php echo $row['name']." (".$row['cid'].")"; ?>
                            </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <input type="number" name="locker_no" placeholder="Locker No." class="form-control required">
                    </div>
                    <div class="form-group mb-2">
                        <input type="number" name="price" placeholder="Price (Rs.)" class="form-control required">
                    </div>
                    <button type="submit" name="add_book" class="btn btn-outline-primary my-2">Add Book</button>
                </form>
                <?php
                    if(isset($_POST['add_book'])){
                        $status = 1;
                        $result = $connection -> query("INSERT INTO books VALUES(NULL, '$_POST[name]', '$_POST[isbn]', $status, $_POST[locker_no], $_POST[price], $_POST[author], $_POST[category]);");
                        if($result){
                            echo '<div id="add-book-done" style="display: none;"><br><p class="alert alert-success" role="alert">Book added successfully.</p></div>';
                            echo '<script>
                                setTimeout(function () {
                                    var msg = document.getElementById("add-book-done");
                                    msg.style.display = "block";
                                    setTimeout(function () {
                                        msg.style.display = "none";
                                    }, 5000);
                                }, 0);
                            </script>';
                        }
                        else{
                            echo '<div id="add-book-not-done" style="display: none;"><br><p class="alert alert-danger" role="alert">Failed to add book.</p></div>';
                            echo '<script>
                                setTimeout(function () {
                                    var msg = document.getElementById("add-book-not-done");
                                    msg.style.display = "block";
                                    setTimeout(function () {
                                        msg.style.display = "none";
                                    }, 5000);
                                }, 0);
                            </script>';
                        }
                    }
                ?>
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
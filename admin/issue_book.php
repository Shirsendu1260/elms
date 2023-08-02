<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Issue Book</title>
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
                <h4 class="card-title my-2 text-center fw-bold">Issue Book</h4>
                <form action="" method="post" class="my-3">
                    <div class="form-group mb-2">
                        <label>Book Name</label>
                        <select class="form-select required" name="book">
                            <option selected disabled>Select a book</option>
                            <?php
                                $sql = "SELECT bid, name FROM books WHERE status = 1 ORDER BY name;";
                                $run_query = mysqli_query($connection, $sql);
                                while($row = mysqli_fetch_assoc($run_query)){
                            ?>
                            <option value="<?php echo $row['bid']; ?>">
                                <?php echo $row['name']." (".$row['bid'].")"; ?>
                            </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>User</label>
                        <select class="form-select required" name="user">
                            <option selected disabled>Select an user</option>
                            <?php
                                $sql = "SELECT uid, name FROM users ORDER BY name;";
                                $run_query = mysqli_query($connection, $sql);
                                while($row = mysqli_fetch_assoc($run_query)){
                            ?>
                            <option value="<?php echo $row['uid']; ?>">
                                <?php echo $row['name']." (".$row['uid'].")"; ?>
                            </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Issue Date</label>
                        <input type="date" name="issue_date" class="form-control required"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label>Due Date</label>
                        <div class="d-flex align-items-center">
                            <input type="date" class="form-control required" name="due_date">
                        </div>
                    </div>
                    <button type="submit" name="issue_book" class="btn btn-outline-primary my-2">Issue Book</button>
                </form>
                <?php
                    if(isset($_POST['issue_book'])){
                        $temp_sql = "SELECT author_id FROM books WHERE bid = $_POST[book];";
                        $temp_result = mysqli_query($connection, $temp_sql);
                        if($temp_result){
                            $temp_row = mysqli_fetch_assoc($temp_result);
                            $author = $temp_row['author_id'];
                        }

                        $status = 0;
                        $result = $connection -> query("INSERT INTO issued_books VALUES(NULL, 1, '$_POST[issue_date]', '$_POST[due_date]', NULL, NULL, NULL, $_POST[user], $_POST[book], $author);");
                        mysqli_query($connection, "UPDATE books SET status = $status WHERE bid = $_POST[book];");
                        if($result){
                            echo '<div id="issue-book-done" style="display: none;"><br><p class="alert alert-success" role="alert">Book issued successfully.</p></div>';
                            echo '<script>
                                setTimeout(function () {
                                    var msg = document.getElementById("issue-book-done");
                                    msg.style.display = "block";
                                    setTimeout(function () {
                                        msg.style.display = "none";
                                    }, 5000);
                                }, 0);
                            </script>';
                        }
                        else{
                            echo '<div id="issue-book-not-done" style="display: none;"><br><p class="alert alert-danger" role="alert">Failed to issue book.</p></div>';
                            echo '<script>
                                setTimeout(function () {
                                    var msg = document.getElementById("issue-book-not-done");
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
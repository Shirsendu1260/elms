<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\styles.css">
</head>

<body>
    <?php
        session_start();
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
        
        $decoded_bid = base64_decode($_GET['bid']);
        $sql = "SELECT * FROM books WHERE bid = $decoded_bid";
        $run_query = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($run_query)){
            $bid = $row['bid'];
            $name = $row['name'];
            $isbn = $row['isbn'];
            $status = $row['status'];
            $locker_no = $row['locker_no'];
            $price = $row['price'];
            $author = $row['author_id'];
            $category = $row['category_id'];
        }
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
                <h4 class="card-title my-2 text-center fw-bold">Edit Book</h4>
                <form action="" method="post" class="my-3">
                    <div class="form-group mb-2">
                        <label>ID</label>
                        <input type="number" name="bid" class="form-control" value="<?php echo $bid; ?>" disabled>
                    </div>
                    <div class="form-group mb-2">
                        <label>Book Name</label>
                        <input type="text" name="name" class="form-control required" value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label>ISBN</label>
                        <input type="text" name="isbn" class="form-control required" value="<?php echo $isbn; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label>Locker No.</label>
                        <input type="number" name="locker_no" class="form-control required"
                            value="<?php echo $locker_no; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control required" value="<?php echo $price; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label>Author</label>
                        <select class="form-select" name="author">
                            <?php
                                $run_query = mysqli_query($connection, "SELECT name FROM authors WHERE aid = $author;");
                                while($row = mysqli_fetch_assoc($run_query)){
                                    $author_name = $row['name'];
                                }
                            ?>
                            <option class="bg-secondary text-light" selected value="<?php echo $author; ?>">
                                <?php echo $author_name." (".$author.")"; ?>
                            </option>
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
                        <label>Category</label>
                        <select class="form-select" name="category">
                            <?php
                                $run_query = mysqli_query($connection, "SELECT name FROM categories WHERE cid = $category;");
                                while($row = mysqli_fetch_assoc($run_query)){
                                    $category_name = $row['name'];
                                }
                            ?>
                            <option class="bg-secondary text-light" selected value="<?php echo $category; ?>">
                                <?php echo $category_name." (".$category.")"; ?>
                            </option>
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
                    <button type="submit" name="edit_book" class="btn btn-outline-primary my-2">Update</button>
                    <div class="mt-1">
                        <p>Back to <a href="../admin/manage_books.php" style="text-decoration: none;">Manage Books</a>.
                        </p>
                    </div>
                </form>
                <?php
                    if(isset($_POST['edit_book'])){
                        $status = 1;
                        $result = $connection -> query("UPDATE books SET name = '$_POST[name]', isbn = '$_POST[isbn]', status = $status, locker_no = $_POST[locker_no], price = $_POST[price], author_id = $_POST[author], category_id = $_POST[category] WHERE bid = $bid;");
                        if($result){
                            echo '<div id="edit-book-done" style="display: none;"><br><p class="alert alert-success" role="alert">Book edited successfully.</p></div>';
                            echo '<script>
                                setTimeout(function () {
                                    var msg = document.getElementById("edit-book-done");
                                    msg.style.display = "block";
                                    setTimeout(function () {
                                        msg.style.display = "none";
                                    }, 5000);
                                }, 0);
                            </script>';
                        }
                        else{
                            echo '<div id="edit-book-not-done" style="display: none;"><br><p class="alert alert-danger" role="alert">Failed to edit book.</p></div>';
                            echo '<script>
                                setTimeout(function () {
                                    var msg = document.getElementById("edit-book-not-done");
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
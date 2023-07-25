<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Rated Books</title>
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
        $rating = 0;
        $isbn = "";

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else{
            $page = 1;
        }

        $limit = 4;
        $start = ($page - 1) * $limit;
        $sql = "SELECT books.bid, books.name, ROUND(IFNULL(AVG(ratings.rating), 0), 1) AS rating, books.isbn FROM books JOIN ratings ON books.bid = ratings.book_id GROUP BY books.bid, books.name ORDER BY rating DESC LIMIT $start, $limit;";

        $result = $connection -> query("SELECT COUNT(DISTINCT book_id) AS count FROM ratings;");
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
                Total Rated Books: <span>
                    <?php echo count_rated_books();?>
                </span>
            </div>
            <div class="card-body">
                <form class="d-flex my-2" role="search" action="..\user\search_rated_book.php" method="post">
                    <input class="form-control me-2" type="text" name="search" placeholder="Search any book">
                    <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
                </form>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Ratings</th>
                                <th>ISBN</th>
                            </tr>
                            <?php
                                $run_query = mysqli_query($connection, $sql);
                                while($row = mysqli_fetch_assoc($run_query)){
                                    $bid = $row['bid'];
                                    $name = $row['name'];
                                    $rating = $row['rating'];
                                    $isbn = $row['isbn'];
                                ?>
                            <tr>
                                <td>
                                    <?php echo $bid;?>
                                </td>
                                <td>
                                    <?php echo $name;?>
                                </td>
                                <td>
                                    <?php echo '<div class="fw-bold badge bg-success text-light">'.$rating.'</div>';?>
                                </td>
                                <td>
                                    <?php echo $isbn;?>
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
                            <a class="page-link" href="..\user\book_ratings.php?page=<?= $previous; ?>">Previous</a>
                        </li>
                        <?php for($i=1; $i<$total_pages; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="..\user\book_ratings.php?page=<?= $i; ?>">
                                <?php echo $i; ?>
                            </a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="..\user\book_ratings.php?page=<?= $next; ?>">Next</a>
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
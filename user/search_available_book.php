<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Search Available Book Data</title>
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
    ?>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand fw-bold" href="../user/user_dashboard.php"><span class="text-primary">e</span>LMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown"
            aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav ms-auto d-inline-flex">
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
                Your Searched Data
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <?php
                            if(isset($_POST['submit'])){
                                $search = $_POST['search'];
                                $search_sql = "SELECT books.bid, books.name, books.price, authors.name AS author, categories.name AS category FROM books JOIN authors JOIN categories ON books.author_id = authors.aid AND books.category_id = categories.cid WHERE books.status = 1 AND books.name LIKE '%$search%' OR authors.name LIKE '%$search%';";
                                $search_sql_run = mysqli_query($connection, $search_sql);
                                if($search_sql_run){
                                    if(mysqli_num_rows($search_sql_run) > 0){
                                        echo '<thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Price (Rs.)</th>
                                                        <th>Author</th>
                                                        <th>Category</th>
                                                    </tr>
                                                </thead>';
                                        $row = mysqli_fetch_assoc($search_sql_run);
                                        $bid = $row['bid'];
                                        $name = $row['name'];
                                        $price = $row['price'];
                                        $author = $row['author'];
                                        $category = $row['category'];
                                        echo '<tbody>
                                                    <tr>
                                                        <td>'.$bid.'</td>
                                                        <td>'.$name.'</td>
                                                        <td>'.$price.'</td>
                                                        <td>'.$author.'</td>
                                                        <td>'.$category.'</td>
                                            </tr>
                                        </tbody>';
                                    }
                                    else{
                                        echo '<p class="text-danger">Record not found.</p>';
                                    }
                                }
                            }
                        ?>
                    </table>
                </div>
                <a href="../user/total_available_books.php"><button class="btn btn-primary">Back</button></a>
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
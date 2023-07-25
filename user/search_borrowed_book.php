<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Search Borrowed Book Data</title>
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
                                $search_sql = "SELECT books.bid, books.name, books.price, authors.name AS author, categories.name AS category, issued_books.issue_date, issued_books.due_date, issued_books.return_date, issued_books.days_late, issued_books.fine FROM issued_books JOIN books JOIN authors JOIN categories ON books.category_id = categories.cid AND issued_books.book_id = books.bid AND issued_books.author_id = authors.aid WHERE issued_books.user_id = $_SESSION[uid] AND books.name LIKE '%$search%';";
                                $search_sql_run = mysqli_query($connection, $search_sql);
                                if($search_sql_run){
                                    if(mysqli_num_rows($search_sql_run) > 0){
                                        echo '<thead>
                                                    <tr>
                                                        <th>Book ID</th>
                                                        <th>Name</th>
                                                        <th>Price (Rs.)</th>
                                                        <th>Author</th>
                                                        <th>Category</th>
                                                        <th>Date Borrowed</th>
                                                        <th>Due Date</th>
                                                        <th>Return Date</th>
                                                        <th>Days Late</th>
                                                        <th>Fine (INR 25/Day)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>';
                                        $row = mysqli_fetch_assoc($search_sql_run);
                                        $bid = $row['bid'];
                                        $name = $row['name'];
                                        $price = $row['price'];
                                        $author = $row['author'];
                                        $category = $row['category'];
                                        $issue_date = $row['issue_date'];
                                        $due_date = $row['due_date'];
                                        $return_date = $row['return_date'];
                                        $days_late = $row['days_late'];
                                        $fine = $row['fine'];
                                        $return_date_class = is_null($return_date) ? 'text-danger' : 'text-dark';
                                        $return_date_text = is_null($return_date) ? 'Not Returned Yet' : $return_date;
                                        $days_late_text = is_null($days_late) ? 'N/A' :$days_late;
                                        $fine_class = is_null($fine) ? 'text-dark' : 'text-danger';
                                        $fine_text = is_null($fine) ? 'N/A' : $fine;
                                        echo '<tbody>
                                                    <tr>
                                                        <td>'.$bid.'</td>
                                                        <td>'.$name.'</td>
                                                        <td>'.$price.'</td>
                                                        <td>'.$author.'</td>
                                                        <td>'.$category.'</td>
                                                        <td>'.$issue_date.'</td>
                                                        <td>'.$due_date.'</td>
                                                        <td class="'.$return_date_class.'">'.$return_date_text.'</td>
                                                        <td>'.$days_late_text.'</td>
                                                        <td class="'.$fine_class.'">'.$fine_text.'</td>';
                                        $url = "../user/ratings.php"."?bid=".base64_encode($bid)."&uid=".base64_encode($_SESSION['uid']);
                                        echo '<td>
                                                    <a href='.$url.' class="text-light text-decoration-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><button
                                                            class="btn btn-success btn-sm my-1" name="rating">Rate This Book</button></a>
                                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Rate This Book</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Give this book a rating out of 5.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <a href="'.$url.'&rating='.base64_encode(5).'"><button
                                                                            type="button" class="btn btn-outline-success">5</button></a>
                                                                    <a href="'.$url.'&rating='.base64_encode(4).'"><button
                                                                            type="button" class="btn btn-outline-success">4</button></a>
                                                                    <a href="'.$url.'&rating='.base64_encode(3).'"><button
                                                                            type="button" class="btn btn-outline-success">3</button></a>
                                                                    <a href="'.$url.'&rating='.base64_encode(2).'"><button
                                                                            type="button" class="btn btn-outline-success">2</button></a>
                                                                    <a href="'.$url.'&rating='.base64_encode(1).'"><button
                                                                            type="button" class="btn btn-outline-success">1</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
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
                <a href="../user/borrowed_books.php"><button class="btn btn-primary">Back</button></a>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Search Issued Book Data</title>
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
        <a class="navbar-brand fw-bold" href="../admin/admin_dashboard.php"><span class="text-primary">e</span>LMS</a>
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
                Your Searched Data
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <?php
                            if(isset($_POST['submit'])){
                                $search = $_POST['search'];
                                $search_sql = "SELECT issued_books.ibid, books.name, books.isbn, authors.name AS author, books.bid, issued_books.issue_date, issued_books.due_date, issued_books.return_date, issued_books.days_late, issued_books.fine, issued_books.status, users.name AS issued_user FROM issued_books JOIN books JOIN authors JOIN users ON issued_books.user_id = users.uid AND issued_books.book_id = books.bid AND issued_books.author_id = authors.aid WHERE books.name LIKE '%$search%' OR users.name LIKE '%$search%';";
                                $search_sql_run = mysqli_query($connection, $search_sql);
                                if($search_sql_run){
                                    if(mysqli_num_rows($search_sql_run) > 0){
                                        echo '<thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>ISBN</th>
                                                        <th>Author</th>
                                                        <th>Book ID</th>
                                                        <th>Date Issued</th>
                                                        <th>Due Date</th>
                                                        <th>Return Date</th>
                                                        <th>Days Late</th>
                                                        <th>Fine (INR 25/Day)</th>
                                                        <th>Status</th>
                                                        <th>Issued User</th>
                                                    </tr>
                                                </thead>';
                                        $row = mysqli_fetch_assoc($search_sql_run);
                                        $return_date_text = is_null($row['return_date']) ? 'N/A' : $row['return_date'];
                                        $days_late_text = is_null($row['days_late']) ? 'N/A' : $row['days_late'];
                                        $fine_class = is_null($row['fine']) ? 'text-dark' : 'text-danger';
                                        $fine_text = is_null($row['fine']) ? 'N/A' : $row['fine'];
                                        $status_class = $row['status'] == 0 ? 'text-danger' : 'text-success';
                                        $status_text = $row['status'] == 0 ? 'Inactive' : 'Active';
                                        echo "<tbody>
                                                    <tr>
                                                        <td>$row[ibid]</td>
                                                        <td>$row[name]</td>
                                                        <td>$row[isbn]</td>
                                                        <td>$row[author]</td>
                                                        <td>$row[bid]</td>
                                                        <td>$row[issue_date]</td>
                                                        <td>$row[due_date]</td>";
                                        echo '<td>'.$return_date_text.'</td>';
                                        echo '<td>'.$days_late_text.'</td>';
                                        echo '<td class="'.$fine_class.'">'.$fine_text.'</td>';
                                        echo '<td class="'.$status_class.'">'.$status_text.'</td>';
                                        echo '<td>'.$row['issued_user'].'</td>
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
                <a href="../admin/books_issued.php"><button class="btn btn-primary">Back</button></a>
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
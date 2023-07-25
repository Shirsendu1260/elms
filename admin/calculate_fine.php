<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Calculate Fine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\styles.css">
</head>

<body>
    <?php
        session_start();
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");

        $user = "";
        $book = "";
        $bid = 0;
        $due_date = "";
        $days_late = 0;
        $fine = 0;
        $decoded_ibid = base64_decode($_GET['ibid']);
        $decoded_return_date = base64_decode($_GET['return_date']);

        $sql = "SELECT issued_books.ibid, users.name AS user, books.name AS book, books.bid, issued_books.due_date FROM issued_books JOIN books JOIN users ON issued_books.user_id = users.uid AND issued_books.book_id = books.bid WHERE issued_books.ibid = $decoded_ibid;";
        $run_query = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($run_query)){
            $ibid = $row['ibid'];
            $user = $row['user'];
            $book = $row['book'];
            $bid = $row['bid'];
            $due_date = $row['due_date'];
        }

        $time_a = strtotime($due_date);
        $time_b = strtotime($decoded_return_date);

        if($time_b > $time_a){
            $days_late = ceil(($time_b - $time_a) / (60 * 60 * 24));
            $fine = 25 * $days_late;
        }

        $sql = "UPDATE issued_books SET status = 0, return_date = '$decoded_return_date', days_late = $days_late, fine = $fine WHERE ibid = $decoded_ibid;";
        mysqli_query($connection, $sql);

        $sql = "UPDATE books SET status = 1 WHERE bid = $bid;";
        mysqli_query($connection, $sql);
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
        <div class="card col-md-6">
            <div class="card-body">
                <h4 class="card-title my-2 text-center fw-bold">Final Report</h4>
                <form class="my-3">
                    <div class="form-group mb-2">
                        <label for="ibid">ID</label>
                        <input type="number" name="ibid" class="form-control" value="<?php echo $decoded_ibid; ?>"
                            readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="user">User Name</label>
                        <input type="text" name="user" class="form-control" value="<?php echo $user; ?>" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="book">Book Name</label>
                        <input type="text" name="book" class="form-control" value="<?php echo $book; ?>" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="bid">Book ID</label>
                        <input type="number" name="bid" class="form-control" value="<?php echo $bid; ?>" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="due_date">Due Date</label>
                        <input type="date" name="due_date" class="form-control" value="<?php echo $due_date; ?>"
                            readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="return_date">Return Date</label>
                        <input type="date" name="return_date" class="form-control"
                            value="<?php echo $decoded_return_date; ?>" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="days_late">Days Late</label>
                        <input type="number" name="days_late" class="form-control" value="<?php echo $days_late; ?>"
                            readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="fine">Fine (INR 25/Day)</label>
                        <input type="number" name="fine" class="form-control text-danger" value="<?php echo $fine; ?>"
                            readonly>
                    </div>
                </form>
                <div class="mt-1">
                    <p>Back to <a href="../admin/book_return.php" style="text-decoration: none;">Book Return</a> page.
                    </p>
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
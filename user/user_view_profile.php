<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | View Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\styles.css">
</head>

<body>
    <?php
        session_start();
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
        $uid = 0;
        $name = "";
        $email = "";
        $mobile = 0;
        $address = "";
        $sql = "SELECT * FROM users WHERE email = '$_SESSION[email]'";
        $run_query = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($run_query)){
            $uid = $row['uid'];
            $name = $row['name'];
            $email = $row['email'];
            $mobile = $row['mobile'];
            $address = $row['address'];
        }
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
                <h4 class="card-title my-2 text-center fw-bold">Your Profile Details</h4>
                <form class="my-3">
                    <div class="form-group mb-2">
                        <label for="uid">ID</label>
                        <input type="number" name="uid" class="form-control" value="<?php echo $uid; ?>" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="mobile">Mobile No.</label>
                        <input type="number" name="mobile" class="form-control" value="<?php echo $mobile; ?>" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="address">Address</label>
                        <textarea name="address" rows="4" class="form-control" style="resize: none;"
                        readonly><?php echo $address; ?></textarea>
                    </div>
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
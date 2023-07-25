<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Manage Searched Book Category</title>
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
                                $search_sql = "SELECT * FROM categories WHERE name LIKE '%$search%';";
                                $search_sql_run = mysqli_query($connection, $search_sql);
                                if($search_sql_run){
                                    if(mysqli_num_rows($search_sql_run) > 0){
                                        echo '<thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>';
                                        $row = mysqli_fetch_assoc($search_sql_run);
                                        $cid = $row['cid'];
                                        $name = $row['name'];
                                        echo '<tbody>
                                                    <tr>
                                                        <td>'.$cid.'</td>
                                                        <td>'.$name.'</td>';
                                        $url1 = "../admin/edit_category.php"."?cid=".base64_encode($cid);
                                        $url2 = "../admin/delete_category.php"."?cid=".base64_encode($cid);
                                        echo '<td>
                                                    <a href='.$url1.' class="text-light text-decoration-none"><button
                                                            class="btn btn-success btn-sm my-1" name="edit">Edit</button></a>
                                                    <a href='.$url2.' class="text-light text-decoration-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><button
                                                            class="btn btn-danger btn-sm my-1" name="delete">Delete</button></a>
                                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm
                                                                        Deletion</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this category?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">No</button>
                                                                    <a href="'.$url2.'"><button type="button"
                                                                            class="btn btn-primary">Yes</button></a>
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
                <a href="../admin/manage_categories.php"><button class="btn btn-primary">Back</button></a>
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
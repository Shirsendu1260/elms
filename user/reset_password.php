<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Update Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\styles.css">
    <style>
        .reset-pw-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="navbar-brand fw-bold"><span class="text-primary">e</span>LMS</div>
    </nav>
    <?php
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, "elms");
        
        if(isset($_GET['email']) && isset($_GET['reset_token'])){
            $decoded_email = base64_decode($_GET['email']);
            $decoded_reset_token = base64_decode($_GET['reset_token']);

            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d');

            $sql = "SELECT * FROM users WHERE email = '$decoded_email' AND reset_token = '$decoded_reset_token' AND reset_token_expiry_date = '$date';";
            $result = mysqli_query($connection, $sql);

            if($result){
                if(mysqli_num_rows($result) == 1){
                    echo '<div class="reset-pw-container">
                                    <div class="card col-md-6">
                                        <div class="card-body">
                                            <h4 class="card-title my-2 text-center fw-bold">Update Password</h4>
                                            <form method="post" class="my-3">
                                                <div class="form-group mb-2">
                                                    <input type="password" name="new_password" placeholder="Enter New Password" class="form-control">
                                                    <div id="passwordHelpBlock" class="form-text">Your new password must be 8-20 characters long.</div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <input type="password" name="conf_password" placeholder="Confirm New Password" class="form-control">
                                                </div>
                                                <input type="hidden" name="email" value="'.$decoded_email.'">
                                                <button type="submit" name="update_password" class="btn btn-outline-success my-2">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>';
                }
                else{
                    echo '<div class="reset-pw-container">
                                <div class="card col-md-6">
                                    <div class="card-body">
                                        <div class="my-3"><p class="alert alert-danger" role="alert">Invalid or expired link!</p></div>
                                    </div>
                                </div>
                            </div>';
                }
            }
            else{
                echo '<div class="reset-pw-container">
                                <div class="card col-md-6">
                                    <div class="card-body">
                                        <div class="my-3"><p class="alert alert-danger" role="alert">Error occurred. Please try again.</p></div>
                                    </div>
                                </div>
                            </div>';
            }
        }
    ?>
    <?php
        if(isset($_POST['new_password']) && isset($_POST['conf_password'])){
            if($_POST['new_password'] == $_POST['conf_password']){
                $sql = "UPDATE users SET password = '$_POST[new_password]', reset_token = NULL, reset_token_expiry_date = NULL WHERE email = '$_POST[email]';";

                if(mysqli_query($connection, $sql)){
                    echo '<script type="text/javascript">
                                alert("New password updated successfully. You can login now by using the new password.");
                                window.location.href = "../user/user_login.php";
                            </script>';
                }
                else{
                    echo '<script type="text/javascript">
                        alert("Unable to update password!");
                        window.location.href = "../user/user_login.php";
                    </script>';
                }
            }
            else{
                echo '<script type="text/javascript">
                    alert("Unable to update password!");
                </script>';
            }
        }
    ?>
    <footer class="footer text-center">
        <span class="text-muted">&copy; 2021 eLMS. All rights reserved.</span>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>
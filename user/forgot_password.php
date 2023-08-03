<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="..\css\styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand fw-bold" href="../index.html"><span class="text-primary">e</span>LMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav ms-auto d-inline-flex">
                <li class="nav-item">
                    <a class="nav-link link-primary" href="../user/user_login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user/user_signup.php">Sign-up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/admin_login.php">Admin Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="form-container">
        <div class="card mt-1 col-md-6">
            <div class="card-header fs-5">
                Reset Your Password
            </div>
            <div class="card-body">
                <form method="post" class="form-group mb-2">
                    <input type="email" name="email" placeholder="Enter your registered email address"
                        class="form-control required border-2" required>
                    <button type="submit" name="send-link" class="btn btn-outline-success my-2">Send Reset Password
                        Link</button>
                </form>
                <?php
                    require_once('../utilities/config.php');

                    $connection = mysqli_connect("localhost", "root", "");
                    $db = mysqli_select_db($connection, "elms");

                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\SMTP;
                    use PHPMailer\PHPMailer\Exception;

                    function send_mail($email, $reset_token, $admin_gmail_id, $passcode){
                        $encoded_email = base64_encode($email);
                        $encoded_reset_token = base64_encode($reset_token);
                        
                        require('../utilities/phpmailer-components/Exception.php');
                        require('../utilities/phpmailer-components/PHPMailer.php');
                        require('../utilities/phpmailer-components/SMTP.php');

                        $mail = new PHPMailer(true);

                        try {
                            $mail->isSMTP();
                            $mail->Host       = 'smtp.gmail.com';
                            $mail->SMTPAuth   = true;
                            $mail->Username   = $admin_gmail_id;
                            $mail->Password   = $passcode;
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                            $mail->Port       = 465;

                            $mail->setFrom($admin_gmail_id, 'eLMS Admin');
                            $mail->addAddress($email);

                            $mail->isHTML(true);
                            $mail->Subject = 'Reset Your Password';
                            $mail->Body    = "We have received a password reset request from you. Click the link below to reset your password. 
                            <br><b>Note: </b>This link will expire within 1 day of sending.
                            <br><br><a href='http://localhost/elms/user/reset_password.php?email=$encoded_email&reset_token=$encoded_reset_token'>Reset Your Password</a>";
                        
                            $mail->send();
                            return true;
                        } 
                        catch (Exception $e) {
                            return false;
                        }
                    }

                    if(isset($_POST['send-link'])){
                        $sql = "SELECT * FROM users WHERE email = '$_POST[email]';";
                        $result = mysqli_query($connection, $sql);

                        if($result){
                            if(mysqli_num_rows($result) == 1){
                                $reset_token = bin2hex(random_bytes(16));
                                date_default_timezone_set('Asia/Kolkata');
                                $date = date('Y-m-d');
                                $sql = "UPDATE `users` SET `reset_token` = '$reset_token', `reset_token_expiry_date` = '$date' WHERE email = '$_POST[email]';";
                                if(mysqli_query($connection, $sql) && send_mail($_POST['email'], $reset_token, $admin_gmail_id, $passcode)){
                                    echo '<div id="email-sent" style="display: none;"><br><p class="alert alert-success" role="alert">We have sent you an email with a reset password link to this email address. Please check your inbox before it expires.</p></div>';
                                    echo '<script>
                                        setTimeout(function () {
                                            var msg = document.getElementById("email-sent");
                                            msg.style.display = "block";
                                            setTimeout(function () {
                                                msg.style.display = "none";
                                            }, 30000);
                                        }, 0);
                                    </script>';
                                }
                                else{
                                    echo '<div id="error-occurred" style="display: none;"><br><p class="alert alert-danger" role="alert">Error occurred. Please try again. (1)</p></div>';
                                    echo '<script>
                                        setTimeout(function () {
                                            var msg = document.getElementById("error-occurred");
                                            msg.style.display = "block";
                                            setTimeout(function () {
                                                msg.style.display = "none";
                                            }, 6000);
                                        }, 0);
                                    </script>';
                                }
                            }
                            else{
                                echo '<div id="incorrect-email" style="display: none;"><br><p class="alert alert-danger" role="alert">Not a registered email address. Please try again.</p></div>';
                                echo '<script>
                                    setTimeout(function () {
                                        var msg = document.getElementById("incorrect-email");
                                        msg.style.display = "block";
                                        setTimeout(function () {
                                            msg.style.display = "none";
                                        }, 6000);
                                    }, 0);
                                </script>';
                            }
                        }
                        else{
                            echo '<div id="error-occurred" style="display: none;"><br><p class="alert alert-danger" role="alert">Error occurred. Please try again. (2)</p></div>';
                            echo '<script>
                                setTimeout(function () {
                                    var msg = document.getElementById("error-occurred");
                                    msg.style.display = "block";
                                    setTimeout(function () {
                                        msg.style.display = "none";
                                    }, 6000);
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
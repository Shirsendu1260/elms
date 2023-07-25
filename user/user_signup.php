<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eLMS | Sign-up</title>
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
        <div class="card col-md-6">
            <div class="card-body">
                <h4 class="card-title my-2 text-center fw-bold">Sign-up</h4>
                <form action="../user/signup.php" method="post" class="my-3">
                    <div class="form-group mb-2">
                        <input type="text" name="name" placeholder="Name" class="form-control required border-2">
                    </div>
                    <div class="form-group mb-2">
                        <input type="email" name="email" placeholder="Email" class="form-control required border-2">
                    </div>
                    <div class="form-group mb-2">
                        <div class="d-flex align-items-center">
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control required border-2">
                            <img class="ms-2" id="hide-pw" style="width: 20px;" src="..\assets\hidden.svg"
                                alt="hide-password">
                        </div>
                        <div id="passwordHelpBlock" class="form-text">Your password must be 8-20 characters long.</div>
                    </div>
                    <div class="form-group mb-2">
                        <select name="gender" class="form-select" required border-2>
                            <option selected disabled>Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <input type="number" name="mobile" placeholder="Mobile No." class="form-control required border-2">
                    </div>
                    <div class="form-group mb-2">
                        <textarea name="address" rows="4" placeholder="Address" class="form-control required border-2"
                            style="resize: none;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-primary my-2">Sign-up</button>
                </form>
                <div>
                    <p>Already have an account? <a href="../user/user_login.php" style="text-decoration: none;">Log
                            in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer text-center">
        <span class="text-muted">&copy; 2021 eLMS. All rights reserved.</span>
    </footer>
    <script>
        let pw = document.getElementById("password");
        let eye = document.getElementById("hide-pw");
        eye.onclick = function () {
            if (pw.type == "password") {
                pw.type = "text";
                eye.src = "../assets/eye.svg";
            }
            else {
                pw.type = "password";
                eye.src = "../assets/hidden.svg";
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>
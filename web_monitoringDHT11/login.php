<?php

session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require 'koneksi.php';

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $hasil = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");

    if (mysqli_num_rows($hasil) === 1) {

        $row = mysqli_fetch_assoc($hasil);
        if (password_verify($password, $row["password"])) {

            $_SESSION["login"] = true;

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Halaman Login</title>
    <link rel="icon" href="https://www.anakkendali.com/wp-content/uploads/2019/11/cropped-icon-anom-2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Muli|Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="loginstyle.css">
</head>

<body>
    <article id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-none d-sm-none d-md-block" style="border-right: 1.5px solid #f2f2f2">
                    <img src="image.jpg" alt="Image">
                </div>
                <div class="col-md-6" style="border-left: 1.5px solid #f2f2f2">
                    <a href="https://www.anakkendali.com" class="design">Design by Anak Kendali</a>
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <h1><span>Login</span> as a Administrator</h1>
                            <?php if (isset($error)) : ?>
                                <p style="color : red; font-style: italic">Username / Password Salah</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-9 mx-auto">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label class="sr-only" for="username">Username</label>
                                    <div class="input-group">
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="far fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="Password">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="far fa-eye-slash"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="https://www.anakkendali.com" id="emailHelp" class="form-text text-muted text-right">Lost Password?</a>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="login">L O G I N</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
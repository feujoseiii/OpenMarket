<?php

    /*
     * ERROR TYPES
     *
     * 1 - invalid credentials
     * 2 - user does not exist
     *
     * */
    require "../helper/helper.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = clean($_POST['username']);
        $password = clean($_POST['password']);
        performLogin($username,$password);
    }

    function performLogin($username,$password){
        if(isCredentialsCorrect($username,$password)){
            session_start();
            $db_username = escape($username);
            $sql = "SELECT role FROM users WHERE username = '{$db_username}'";
            $result = query($sql);
            confirm($result);
            $row = fetch_array($result);
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            redirect("../index.php");
        }else{
            $sql = "SELECT * FROM users WHERE username = '{$db_username}'";
            $result = query($sql);
            confirm($result);
            if(count_rows($result) == 0){
                redirect("index.php?error=1");
            }else{
                redirect("index.php?error=2");
            }
        }
    }

    function isCredentialsCorrect($username,$password){
        $f_username = escape($username);
        $f_password = escape($password);

        $sql = "SELECT username,password FROM users WHERE username='{$f_username}'";
        $result = query($sql);
        confirm($result);
        if(count_rows($result) > 0){
            $row = fetch_array($result);
            $res_password = $row['password'];
            return $res_password == $f_password;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OpenMarket - Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">OpenMarket</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../register/">Register</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="login">
        <div class="container">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">OpenMarket Login</h4>
                        <div class="login-forms">
                            <?php
                                if(isset($_GET['error'])){
                                    switch($_GET['error']){
                                        case 1:
                                            echo "<div class=\"alert alert-danger\">
                                                  <strong>Failed to login!</strong> username or password is incorrect.
                                                 </div>";
                                            break;
                                        case 2:
                                            echo "<div class=\"alert alert-danger\">
                                                  <strong>Failed to login!</strong> user does not exists.
                                                 </div>";
                                            break;
                                    }
                                }

                            ?>
                            <form action="" method="POST">
                                <label for="username" class="form-item">Username</label>
                                <input type="text" name="username" id="username" class="form-control form-item" required>
                                <label for="password" class="form-item">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                <button type="submit" class="btn btn-primary btn-block form-item">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
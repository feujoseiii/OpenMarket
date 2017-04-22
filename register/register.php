<?php
    require "../helper/helper.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $errors = [];
        $username = sanitize($_POST['username']);
        $password = sanitize($_POST['password']);
        $repassword = sanitize($_POST['repassword']);
        $role = sanitize($_POST['role']);

        if(isExistingUser($username)){
            $errors = "Username is already taken.";
        }

        if($password != $repassword){
            $errors = "Password does not match.";
        }

        if(!empty($errors)){
            foreach($errors as $error){
                echo $error;
            }
        }else{
            performLogin($username,$password,$role);
        }


    }

    function performLogin($username,$password,$role){
        $sql = "INSERT INTO users VALUES('{$username}','$password','$role',NOW(),NOW())";
    }

    function isExistingUser($username){
        $sql = "SELECT username FROM users WHERE username='{$username}'";
        $result = query($sql);
        confirm($result);
        return count_rows($result) == 0 ? true : false;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OpenMarket - Register</title>
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
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Register</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search">
          <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div class="register">
        <div class="container">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">OpenMarket Registration</h4>
                        <div class="login-forms">
                            <form action="" >
                                <label for="username" class="form-item">Preferred Username</label>
                                <input type="text" name="username" id="username" class="form-control form-item" required>
                                <label for="password" class="form-item">Preferred Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                <label for="repassword" class="form-item">Retype Password</label>
                                <input type="password" name="repassword" id="repassword" class="form-control" required>
                                <label for="role" class="form-item">I want to</label>
                                <select class="form-control" id="role">
                                    <option value="1">I want to export products</option>
                                    <option value="2">I want to import products</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-block form-item">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
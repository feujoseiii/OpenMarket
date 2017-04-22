<?php

    require "helper/helper.php";
    ob_start();
    session_start();



    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $title = clean($_POST['title']);
        $description = clean($_POST['description']);
        $price = clean($_POST['price']);
        $tags = isset($_POST['tags']) ? clean($_POST['tags']) : "";
        $sql  = "INSERT INTO exporter_products(title,description,price,tags,created_at,updated_at,username) ";
        $sql .= "VALUES('{$title}','{$description}',{$price},'{$tags}',NOW(),NOW(),'{$_SESSION['username']}')";
        $result = query($sql);
        confirm($result);
        redirect("add-export.php?status=success");
    }

    function isAuth(){
        return isset($_SESSION['username']) && isset($_SESSION['role']) ? true : false;
    }


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OpenMarket - Add item to export</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if(isAuth()){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Browse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">My Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php }else{ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login/">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register/">Register</a>
                    </li>
                <?php } ?>
            </ul>
        </div>

    </nav>
    <section>
        <div class="add-export">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-block">
                                <div class="card-title"><h4><i class="ion-plus-round"></i> Add item to export</h4></div>
                                <?php
                                if(isset($_GET['status'])){
                                    if($_GET['status']=='success'){
                                        echo "<div class=\"alert alert-success\">
                                              <strong>Success! your item has been added!</strong>
                                            </div>";
                                    }
                                }
                                ?>
                                <form action="" method="post">
                                    <label for="title">What would you like to export?</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                    <label for="description" >Describe the product you want to export</label>
                                    <textarea name="description" id="description" rows="10" class="form-control" required></textarea>
                                    <label for="price">Price per piece (USD)</label>
                                    <input type="text" name="price" class="form-control" required>
                                    <label for="tags">Tags (Separated by comma)</label>
                                    <input type="text" name="tags" class="form-control"><br>
                                    <button type="submit" class="btn btn-primary btn-block">Add item</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<?php
    require "helper/helper.php";
    ob_start();
    session_start();


    function isAuth(){
        return isset($_SESSION['username']) && isset($_SESSION['role']) ? true : false;
    }

    function exporter_countListedProducts($username){
        $db_username = clean(escape($username));
        $sql = "SELECT id FROM exporter_products WHERE username = '{$db_username}'";
        $result = query($sql);
        return count_rows($result);
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OpenMarket</title>
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

<?php if(!isAuth()){ ?>
    <section id="welcome">
        <div class="hero-image">
            <div class="hero-text">
                <h1>OpenMarket</h1><br>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, <br>when an unknown printer took a galley of type and scrambled it to make a type <br>specimen book.</p><br>
                <a class="btn btn-primary">Learn more</a>   <a class="btn btn-primary">Get started</a>
            </div>
        </div>
        <div class="welcome-feature">
            <div class="welcome-feature-text">

            </div>
        </div>
    </section>
<?php } ?>


<?php if(isset($_SESSION['role'])){ ?>

    <!--  if the user is exporter, display opportunities for exporter -->
    <?php if($_SESSION['role']== 'exporter'){ ?>
        <section id="exporter">

            <!-- if the user doesn't have products to export -->
            <?php if(exporter_countListedProducts($_SESSION['username']) == 0){ ?>

            <div class="display-wants">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" exporter-no-item-greet">
                                <h2><i class="ion-ios-sunny-outline"> </i>Good day, <?php echo $_SESSION['username'] ?>!</h2>
                                <p>Make your products visible to the world!<br>Click the button below to list your product on OpenMarket</p>
                                <a href="add-export.php" class="btn btn-primary"><i class="ion-plus-round"></i> Add items to export</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="display-wants-by-country">
                <div class="container">
                    <div class="row" id="looking-for-title">
                        <h4>People around the globe are looking for</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card looking-for-card">
                                <div class="card-block">
                                    <h5 class="card-title"><i class="ion-ios-person"></i> Jose S. (<i class="ion-android-star-outline"></i> 123 Reviews)</h5>
                                    <p>
                                        <i class="ion-search"></i> Looking for: Fidget cube<br>
                                        <i class="ion-earth"></i> Country: Philippines<br>
                                        <i class="ion-radio-waves"></i> Language Spoken: English, Tagalog
                                    </p>
                                </div>
                                <div style="margin-bottom: 10px; color: #fff;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a class="btn btn-primary btn-block"><i class="ion-eye"></i> Add to watchlist</a>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="btn btn-primary btn-block"><i class="ion-paper-airplane"></i> Send a message</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php }else { ?>

            <div class="exporter-stats">
                <div class="container">
                    <h4>Exporter dashboard</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title text-center">0</h4>
                                    <div class="text-center">
                                        <h5> <i class="ion-arrow-graph-up-right"></i> products listed</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title text-center">0</h4>
                                    <div class="text-center">
                                       <h5> <i class="ion-ios-people"></i> page <views></views></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title text-center">0</h4>
                                    <div class="text-center">
                                        <h5> <i class="ion-ios-cart"></i> open deals</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title text-center">0</h4>
                                    <div class="text-center">
                                        <h5> <i class="ion-cash"></i> closed deals</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="exporter-stat-tables">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>My products</h4>
                                <div class="card">
                                    <div class="card-block">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Recent message</h4>
                                <div class="card">
                                    <div class="card-block">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="export-suggestions">
                        <div class="row" id="looking-for-title">
                            <h4>People around the globe are looking for</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card looking-for-card">
                                    <div class="card-block">
                                        <h5 class="card-title"><i class="ion-ios-person"></i> Jose S. (<i class="ion-android-star-outline"></i> 123 Reviews)</h5>
                                        <p>
                                            <i class="ion-search"></i> Looking for: Fidget cube<br>
                                            <i class="ion-earth"></i> Country: Philippines<br>
                                            <i class="ion-radio-waves"></i> Language Spoken: English, Tagalog
                                        </p>
                                    </div>
                                    <div style="margin-bottom: 10px; color: #fff;">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a class="btn btn-primary btn-block"><i class="ion-eye"></i> Add to watchlist</a>
                                                </div>
                                                <div class="col-md-6">
                                                    <a class="btn btn-primary btn-block"><i class="ion-paper-airplane"></i> Send a message</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php }?>


        </section>
    <?php } ?>

    <!--  if the user is importer, display opportunities for importer -->
    <?php if($_SESSION['role'] == 'importer'){ ?>
        <section id="importer">

        </section>
    <?php } ?>

<?php } ?>





</body>
</html>
<?php
    require "helper/helper.php";
    ob_start();
    session_start();
    session_destroy();
    redirect("index.php");


?>
<?php
require "dbConnectPhp.php";

if(!isset($_SESSION["id"])){
    header('Location: ./login.php');
}



<?php
    $server="localhost";
    $user="animadqu_test";
    $pass="123456";
    $dataname="animadqu_test";
    $port=3306;
    $connect= new mysqli($server, $user, $pass, $dataname, $port);
    $connect_db = mysql_connect($server, $user, $pass);
?>
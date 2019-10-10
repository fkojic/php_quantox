<?php
    /**
     * Created by PhpStorm.
     * User: Filip
     * Date: 2019-10-10
     * Time: 6:12 PM
     */
    $server = "localhost";
    $user = "root";
    $password = "";
    $name = "school";
    /**
     *  Database connection
     *
     */
    $conn = new mysqli($server, $user, $password, $name);
    if ($conn->connect_errno)
    {
        exit("Connection to database failed: " . $conn->connect_errno);
    }
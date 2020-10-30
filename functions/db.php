<?php

$con = mysqli_connect('localhost', 'root', '', 'webshop');

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// Clean string values

function escape($string)
{
    global $con;
    return mysqli_real_escape_string($con, $string);
}

// Query function

function Query($query)
{
    global $con;
    mysqli_set_charset($con,"utf8");
    mysqli_query($con,"set names 'utf8'");
    return  mysqli_query($con, $query);
}

// Confirmation func

function confirm($result)
{
    global $con;
    if(!$result) {
        die('Query failed'.mysqli_error($con));
    }
}

// Fetch data From DB

function fetch_data($result)
{
    return mysqli_fetch_assoc($result);   
}

//Get row values 

function row_count($count)
{
    return mysqli_num_rows($count);
}

?>
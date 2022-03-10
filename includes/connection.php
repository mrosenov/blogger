<?php
$connection = mysqli_connect('localhost','root','','udemy2');

if ($connection) {
    echo "Connected to the database successfully!";
}
else {
    die("Couldn't connect to the database.");
}

?>
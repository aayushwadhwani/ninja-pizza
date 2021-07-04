<?php
    $conn = mysqli_connect('localhost','root1','Root1@root','ninja-pizza');
    if(!$conn){
        echo "Connection error: ". mysqli_connect_error();
    }else{
        echo "connection successful";
    }
?>
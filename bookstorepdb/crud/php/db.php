<?php

function Createdb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookstorepdb";

    $con = mysqli_connect($servername, $username, $password);

    if (!$con){
        die("Connection Failed : " . mysqli_connect_error());
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if(mysqli_query($con, $sql)){
        $con = mysqli_connect($servername, $username, $password, $dbname);

        $sql = "
                        CREATE TABLE IF NOT EXISTS Livro(
                            livro_id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            titulo_livro VARCHAR (25) NOT NULL,
                            editora VARCHAR (20),
                            preco FLOAT 
                        );
        ";

        if(mysqli_query($con, $sql)){
            return $con;
        }else{
            echo "Cannot Create table...!";
        }

    }else{
        echo "Error while creating database ". mysqli_error($con);
    }

}
<?php


    $servername = "localhost";
    $username = "michal";
    $password = "123456789";
    $dbname = "mydb";


    // create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $meno = $_POST['first'];
    $priezvisko = $_POST['second'];
    $rok_narodenia = $_POST['year_born'];
    $suhlas = $_POST['gdpr'];
    $poznamka = $_POST['note'];
    $state_id = $_POST['state'];
    $title = $_POST['title'];


    // Attempt
    $sql = "INSERT INTO user_data (meno, priezvisko, rok_narodenia, suhlas, poznamka, state_id, title_id) 
    VALUES  ('$meno' ,'$priezvisko', '$rok_narodenia', '$suhlas', '$poznamka', '$state_id', '$title');";

    if(mysqli_query($conn, $sql)) {
        echo "Records added succesfully";
    }
    else {
        echo "ERROR: Could not able to execute $sql. ";
        mysqli_error($sql);
    }

    // close connection

    mysqli_close($conn);



?>
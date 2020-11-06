<?php
    $servername = 'localhost';
    $username = 'root';
    $pasword = '';
    //collect data from DB to array 
    try{
        // SELECT ALL PRODUCTS
        $conn = new PDO("mysql:host=$servername;dbname=finalproject", $username, $pasword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->query("SELECT * FROM category ");
        $category = array();
        while($cat = $stmt->fetch(PDO::FETCH_ASSOC)){
            $category[] = $cat;
        }

        echo json_encode($category);
    }catch(PDOException $e){
        echo "Connection failed " .$e->getMessage();
    }

?>  
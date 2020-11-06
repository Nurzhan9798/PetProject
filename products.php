<?php
    $servername = 'localhost';
    $username = 'root';
    $pasword = '';
    //collect data from DB to array 
    try{
        // SELECT ALL PRODUCTS
        $conn = new PDO("mysql:host=$servername;dbname=finalproject", $username, $pasword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->query("SELECT * FROM burgers");
        $products = array();
        while($burger = $stmt->fetch(PDO::FETCH_ASSOC)){
            if($burger['deleted'] === 'yes'){
            continue;
            }
            $products[] = $burger;
        }

        echo json_encode($products);
    }catch(PDOException $e){
        echo "Connection failed " .$e->getMessage();
    }

?>  
<?php 

    $burgerId = $_GET['id'];

    $serverName = 'localhost';
    $userName = 'root';
    $password = '';
    $deleted ='';
    if(isset($_POST['delete'])){
        $deleted = 'yes';
    }else if(isset($_POST['retrive'])){
        $deleted = 'no';
    }
    
    try{
        $conn = new PDO("mysql:host=$serverName;dbname=finalproject", $userName, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE burgers SET deleted=:del WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $burgerId);
        $stmt->bindParam(':del', $deleted);
        $stmt->execute();
        header("Location: ../admin.php");
    }catch(PDOException $e){
        echo "Failed";
    }


    
?>
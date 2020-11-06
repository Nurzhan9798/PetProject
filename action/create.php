<?php

if(isset($_POST["submit"])) {
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];
    $fileExt = explode(".", $fileName);
    $fileActExt = strtolower(end($fileExt));
    $extAllowed = array("jpg", "png", "jpeg");

    if(in_array($fileActExt, $extAllowed)){
        if($fileError === 0){
            $fileNewName = uniqid("", true) .".".$fileActExt;
            $fileDestination = "../img/" .$fileNewName;
            move_uploaded_file($fileTmpName, $fileDestination);

            $servername = 'localhost';
            $username = 'root';
            $pasword = '';

             try{
                $conn = new PDO("mysql:host=$servername;dbname=finalproject", $username, $pasword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $burgerName = $_POST['burgerName'];
                $burgerDesc = $_POST['burgerDescription'];
                $burgerCost = $_POST['burgerCost'];
                $burgerCategory = $_POST['burgerCategory'];
                $burgerImgPath = $fileNewName; 
                
                $stmt = $conn->prepare("INSERT INTO `burgers` (`id`, `name`, `description`, `cost`, `categoryId`, `imgPath`) 
                VALUES (Null, :name, :desc, :cost, :category, :imgName)");
                
                $stmt->bindParam(':name', $burgerName);
                $stmt->bindParam(':desc', $burgerDesc);
                $stmt->bindParam(':cost', $burgerCost);                
                $stmt->bindParam(':category', $burgerCategory);
                $stmt->bindParam(':imgName', $burgerImgPath);
                
                $stmt->execute();

                header("Location: ../order.php");
            }catch(PDOException $e){
                echo "Connection failed " .$e->getMessage();
            }
        }else{
            echo "Upppps! There was an error uploading your image!";
        }
    }else{
        echo "This is not image extension is " .$fileActExt;
        // header("Location: ../create.html");
    }
 
    
}else{
    echo "there is wrong";
}

?>
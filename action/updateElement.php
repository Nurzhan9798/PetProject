<?php 

    $burgerId = $_GET['id'];
    $burgerName = $_POST['burgerName'] ;
    $burgerDescription = $_POST['burgerDescription'];
    $burgerCost = $_POST['burgerCost'];
    $burgerCategory = $_POST['burgerCategory'];
    $servername = 'localhost';
    $username = 'root';
    $pasword = '';

    try{  
        $conn = new PDO("mysql:host=$servername;dbname=finalproject", $username, $pasword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE burgers SET name=:name, description=:desc, cost=:cost, categoryId=:category WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $burgerName);
        $stmt->bindParam(':desc', $burgerDescription);
        $stmt->bindParam(':cost', $burgerCost);
        $stmt->bindParam(':category', $burgerCategory);
        $stmt->bindParam(':id', $burgerId, PDO::PARAM_INT);
    
        $stmt->execute();
        
        if($_FILES['file']['size'] !== 0){
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
                    $sql = "UPDATE burgers SET imgPath=:path WHERE id=:id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':path', $fileNewName);
                    $stmt->bindParam(':id', $burgerId);
                    
                    $stmt->execute();                

                    
                }else{
                    echo "Upppps! There was an error uploading your image!";
                }
            }else{
                echo "This is not image extension is " .$fileActExt;
                
            }
        
        }

        // header("Location: ../element.php?id=$burgerId");
    }catch(PDOException $e){
        echo "Connection failed " .$e->getMessage();
    }
?>
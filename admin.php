<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/admin.css">
    <title>Document</title>
  </head>
  <body>
    <header>
      <?php include_once 'template/header.php' ?>
    </header>
    
    <main>
      <h1>Admin Panel</h1>
      <h1><a href="create.php" class="create">Create Burger</a></h1>
      <section>
        <?php
            $servername = 'localhost';
            $username = 'root';
            $pasword = '';
            try{
                $conn = new PDO("mysql:host=$servername;dbname=finalproject", $username, $pasword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                $stmt = $conn->query("SELECT * FROM burgers");

                while($burger = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $deleted = ($burger['deleted'] === 'yes') ? 'deleted' : '';
                    // echo "<p> Deleteed = ".$deleted ."</p>";
                    echo ' <div class="card" id="'.$deleted.'" >
                                <img src="img/' .$burger['imgPath'] . '"/>
                                <div class="info">
                                    <a href="element.php?id='.$burger['id'].'"> <h3>' .$burger['name'] .'</h3></a>
                                </div>
                                <a href="update.php?id='.$burger['id'].'"><button class="update">Update</button></a>
                                <form action="action/admin.php?id='.$burger['id'].'" method="POST">
                                    <button type="submit" name="delete" class="delete">Delete</button>
                                    <button type="submit" name="retrive" class="retrive">Retrive</button>
                                </form>
                                
                            </div>
                        '; 
                }
            }catch(PDOException $e){
                echo "Connection failed " .$e->getMessage();
            }
        ?>  
        
      </section>
    </main>

    <?php include_once 'template/footer.php' ?>

    <script>
      var y = document.querySelectorAll('div.card');
      for(let i = 0; i < y.length; i++){
        let retrive = y[i].querySelector('button.retrive');
        retrive.disabled = true;
      }

      var x = document.querySelectorAll("div#deleted");
      for(let i = 0; i < x.length; i++){
        let buttonUpdate = x[i].querySelector("button.update");
        buttonUpdate.disabled = true;
        let buttonRetrive = x[i].querySelector("button.retrive");
        buttonRetrive.disabled = false;
        let buttonDelete = x[i].querySelector("button.delete");
        buttonDelete.disabled = true;
      }
    </script>
  </body>
</html>

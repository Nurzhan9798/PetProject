<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/element.css" />
    <title>Document</title>
  </head>
  <body>
    <header>
    <?php include_once 'template/header.php' ?>
    </header>

    <main>
      <article class="element">
          <?php
            // print_r($_GET);
            // echo $_GET['id'];
            $username = 'root';
            $pasword = '';
            try{
                $conn = $conn = new PDO("mysql:host=localhost;dbname=finalproject", $username, $pasword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $id = $_GET['id'];
                // echo $id;
                $stmt = $conn->query("SELECT * FROM burgers WHERE id = $id");
                $stmt->execute();

                $result = $stmt->fetch();
                // print_r($result);
                


                echo '<div class="img"><img src="img/'.$result['imgPath'].'"alt="" /></div>
                        <div class="info">
                        <h1>'.$result['name'] .'</h1>
                        <p>'.$result['description'] .'</p>
                        <span>Cost: '.$result['cost'].'$</span>
                    </div>';

            }catch(PDOException $e){

            }

        
        ?>
        
      </article>
    </main>

    <?php include_once 'template/footer.php' ?>
  </body>
</html>

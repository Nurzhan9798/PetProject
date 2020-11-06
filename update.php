<?php
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

      $stmt = $conn->query("SELECT * FROM category ");
      $category = array();
      while($cat = $stmt->fetch(PDO::FETCH_ASSOC)){
        $category[] = $cat;
      }

  }catch(PDOException $e){
    echo "Connection failed!!";
  }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/create.css" />
    <title>Document</title>
  </head>
  <body>
    <header>
    <?php include_once 'template/header.php' ?>
    </header>
    <main>
      <h1>Update Burger</h1>
      <section>
        <form action="action/updateElement.php?id=<?php echo $_GET['id']?>" method="POST" enctype="multipart/form-data">
          <table>
            <tr>
              <td>Name: </td>
              <td><input type="text" name="burgerName" value="<?php echo $result['name']?>" /></td>
            </tr>
            <tr>
              <td>Description:</td>
              <td>
                <textarea
                  cols="30"
                  rows="10"
                  name="burgerDescription"
                ><?php echo $result['description']?></textarea>
              </td>
            </tr>
            <tr>
              <td>Cost:</td>
              <td><input type="text" name="burgerCost" value="<?php echo $result['cost']?>"/></td>
            </tr>
            <tr>
              <td>Category:</td>
              <td>
                <select name="burgerCategory" id="category">
                  <option value="-1">Category</option>
                </select>
              </td>
            </tr>
            <tr>
              <td><img src="img/<?php echo $result['imgPath']?>" alt=""> </td>
              <td>
                Do you want to change image <br>
                <input type="file" name="file" />
              </td>
              
            </tr>
            <tr>
              <td colspan="2" style="text-align: center">
                <button type="submit" name="submit">Update</button>
              </td>
            </tr>
          </table>
        </form>
      </section>
    </main>

    <?php include_once 'template/footer.php' ?>
  </body>
  <script>
    var category_json = <?php echo json_encode($category) ?>;
    var selectInput = document.getElementById("category");
    console.log(selectInput);
    for(let i = 0; i < category_json.length; i++){
      selectInput.innerHTML += `<option value=${category_json[i]['id']}>${category_json[i]['name']}</option>`;
    }
  </script>
</html>

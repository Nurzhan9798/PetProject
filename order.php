<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/order.css" />
    <title>Document</title>
  </head>
  <body>
    <header>
      <?php 
        include_once 'template/header.php';
      ?>
    </header>
    <main>
      <h1 onclick="ser()" >Our Menu</h1>
      <div class="filter"><input type="text" placeholder="Search"  >
      <select name="" id="category">
        <option value="-1">Category</option>
      </select>
      <label for="">First favorite items<input type="checkbox" name="" id="bookmark"></label></div>
      
      <section id="menu">
      
      </section>
    </main>

    <?php include_once 'template/footer.php' ?>
        
    <script>
      var searchInput = document.getElementsByTagName('input')[0];
      var selectInput = document.getElementById("category");
      var checkBox = document.getElementById("bookmark");
      var selectValue = -1;
      var searchValue = "";

      if(localStorage.getItem('favorite') == null){
        localStorage.setItem('favorite', '[]');
      }

      
      fetch("products.php").then(onSuccesAll, onError);
      fetch("category.php").then(onSuccesCategory, onError);

      function onSuccesAll(response){
        response.text().then(writeAllProducts);
      }

      function writeAllProducts(db){
        let data = JSON.parse(db);
        writeData(data);
      }

      function onError(){
        console.log("FAIL");
      }

      function onSuccesCategory(response){
        response.text().then(writeCategory);
      }

      function writeCategory(db){
        data = JSON.parse(db);
        for(let i = 0; i < data.length; i++){
          selectInput.innerHTML += `<option value=${data[i]['id']}>${data[i]['name']}</option>`;
        }
      }

      // SELECT {CATEGORY}
      selectInput.addEventListener("click", function(){
          selectValue = parseInt(this.value);
          searchInput.value = "";
          checkBox.checked = false;
          if(selectValue != -1){
            fetch("products.php").then(onSuccesSelected, onError);
          }else{
            fetch("products.php").then(onSuccesAll, onError);
          }
        
      });

      function onSuccesSelected(response){
        response.text().then(writeSelectedItems);
      }

      function writeSelectedItems(db){
        let totalData = JSON.parse(db);
        let data = [];
        for(let i = 0; i < totalData.length; i++){
          if(totalData[i].categoryId == selectValue){
            data.push(totalData[i]);
          }
        }

        writeData(data);
      }

      // SEARCH ITEMS
      searchInput.addEventListener("keyup", function(){
          searchValue = searchInput.value;
          selectInput.value = -1;
          checkBox.checked = false;
          if(selectValue != ""){
            fetch("products.php").then(onSuccesSearch, onError);
          }else{
            fetch("products.php").then(onSuccesAll, onError);
          }
        
      });

      function onSuccesSearch(response){
        response.text().then(writeSearchedItems);
      }
              
      function writeSearchedItems(db){
        let totalData = JSON.parse(db);
        let data = [];
        let key = searchValue.toLowerCase();
        for(let i = 0; i < totalData.length; i++){
          let name = totalData[i].name.toLowerCase();
          if(name.includes(key)){
            data.push(totalData[i]);
          }
        }
        writeData(data);
      }

      // CHECKBOX {FAVOURITE ITEM}
      checkBox.addEventListener("click", function(){
        selectInput.value = -1;
        searchInput.value = "";
        if(this.checked){
          // SORTING 
          fetch("products.php").then(onSort, onError);
        }else{
          fetch("products.php").then(onSuccesAll, onError);
        }
      });

      function onSort(response){
        response.text().then(writeSortedItems);
      }

      function writeSortedItems(db){
        let data = JSON.parse(db);
        let arr = JSON.parse(localStorage.getItem('favorite'));
        data.sort((a, b) => {
          let a1 = parseInt(a.id), a2 = parseInt(b.id);
          if(arr.includes(a2)){
            return 1;
          }
          return -1;
        });
        
        writeData(data);
      }

      function writeData(data){
        document.getElementById("menu").innerHTML = "";
        if(data.length == 0){
          document.getElementById("menu").innerHTML = "<p>There is no element</p>";
        }else{
          let favoriteItems = localStorage.getItem('favorite');
          for(let i = 0; i < data.length; i++){
            let x = (favoriteItems.includes(data[i].id)) ? "yellow" : "";
            document.getElementById("menu").innerHTML += `
              <div class="card">
                  <div class="favorite ${x}" onclick="bookmark(this, ${data[i].id})"><i class="fa fa-bookmark"></i></div>
                  <img src="img/${data[i].imgPath}" alt="" />
                  <div class="info">
                      <a href="element.php?id=${data[i].id}"> <h3>${data[i].name}</h3>
                        <p>${data[i].cost}$</p>
                      </a>
                  </div>
              </div>
            `
          }
        }
      }

      // FAVORITE ITEMS ADDING/DELETING
      function bookmark(element, id){
        var items = JSON.parse(localStorage.getItem('favorite'));
        
        
        if(items.includes(id)){ // remove item
          let indexOfItem = items.indexOf(id);
          items.splice(indexOfItem, 1);
          element.classList.remove('yellow');
        }else{// add item
          items.push(id);
          element.classList.add('yellow');
        }
        localStorage.setItem('favorite', JSON.stringify(items));  
      }

      
    </script>
  </body>
</html>



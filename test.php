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
    
    <div class="news">ds;lf</div>
        
    <script>
     news = document.querySelector(".news");
      fetch("products.php").then(onSucces);

      function onSucces(response){
		response.text().then(write);
	  }

	  function write(text){
        news.innerHTML += "<br>OL <br>";
        let a = JSON.parse(text);
        console.log(a);
		news.innerHTML += a;
	  }
    </script>
  </body>
</html>



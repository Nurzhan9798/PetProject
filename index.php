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
    <title>Document</title>
  </head>
  <body>
    <header>
      <?php include_once 'template/header.php' ?>
      <section>
        <article class="left">
          <h1>
            <span> Order</span> <br />
            without leaving home
          </h1>
          <a href="order.php">Order</a>
        </article>
        <article class="right">
          <img src="img/back.png" alt="" />
        </article>
      </section>
    </header>
    <main>
      
      <h1>In Trend</h1>
      <section class="trends">
          <div class="card">
          <img src="img/5f871df3291c92.61045397.png" alt="" />
          <div class="info">
              <h3>Стейкхаус</h3>
          </div>
          </div>
          <div class="card">
          <img src="img/5f8056bf266cd8.84553195.png" alt="" />
          <div class="info">
              <h3>ДВОЙНОЙ КРИСПИ ЧИКЕН</h3>
          </div>
          </div>
          <div class="card">
          <img src="img/5f808d361885d5.28713500.png" alt="" />
          <div class="info">
              <h3>ВОППЕР® ДЖУНИОР</h3>
          </div>
          </div>
      </section>

      <h1 class="title">What our clients says</h1>  
    <!-- Carousel Comments -->
      <section class="slideshow">
          <div class="mySlides fade">
              <div class="name">
              <img src="img/avatar-1.jpg" alt="">
              <h2>John Doe</h2>
              <p>Design</p>
              </div>
              <div class="text">
              <p>I would be lost restaurant. I would be like to thank you for your oustanding product</p>
              </div>
          </div>

          <div class="mySlides fade">
              <div class="name">
                  <img src="img/avatar-2.jpg" alt="">
                  <h2>Jack Doe</h2>
                  <p>Artist</p>
              </div>
              <div class="text">
                  <p>I would be lost restaurant. I would be like to thank you for your oustanding product</p>
              </div>
          </div>

          <div class="mySlides fade">
              <div class="name">
                  <img src="img/avatar-3.jpg" alt="">
                  <h2>John Doe</h2>
                  <p>Engineer</p>
              </div>
              <div class="text">
                  <p>I would be lost restaurant. I would be like to thank you for your oustanding product</p>
              </div>
          </div>
          <a class="prev" onclick="plusSlides(-1)"><</a>    
          <a class="next" onclick="plusSlides(1)">></a>    
      </section>
      <div style="text-align: center;" class="carousel_dots">
          <span class="dot" onclick="currentSlides(1)"></span>
          <span class="dot" onclick="currentSlides(2)"></span>
          <span class="dot" onclick="currentSlides(3)"></span>
      </div>
        
      
  
    </main>
    <?php include_once 'template/footer.php' ?>

    <script>
      var slideIndex = 1;
      showSlides(slideIndex);
      function plusSlides(n){
        slideIndex += n;
        showSlides(slideIndex);
      }

      function currentSlides(n){
        showSlides(slideIndex = n);
      }
      
      function showSlides(n){
        // console.log("THIS");
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");

        // console.log(slides);
        // console.log(n)
        if(n > slides.length){
          n = 1;
        }
        if(n < 1){
          n = slides.length;
        }

        slideIndex = n;

        for(i = 0; i < slides.length; i++){
          slides[i].style.display = "none";
        }
        
        for(i = 0; i < slides.length; i++){
          dots[i].className = dots[i].className.replace("active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
      }
    </script>
  </body>
</html>

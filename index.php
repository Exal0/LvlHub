<!DOCTYPE html>
<html lang="fr">
<?php include 'app/views/partials/head.php'?>

<body class="bg-all">

<?php include 'app/views/partials/header.php'?>


    <main>

<div class="hero">
  <div class="video-wrapper">
  
    <iframe
      class="video-bg"
      src="https://www.youtube.com/embed/Jy4HRCrXbQk?autoplay=1&mute=1&loop=1&playlist=Jy4HRCrXbQk&controls=0&showinfo=0"
      frameborder="0"
      allow="autoplay"
    ></iframe>


    <div class="video-front-wrapper">
      <iframe
        class="video-front"
        src="https://www.youtube.com/embed/Jy4HRCrXbQk?autoplay=1&mute=1&loop=1&playlist=Jy4HRCrXbQk"
        frameborder="0"
        allow="autoplay"
      ></iframe>
    </div>

 
    <div class="hero__presentation-txt">
      <h2>Un site communautaire moderne dédié aux joueurs, proposant des guides clairs pour mieux comprendre les mécaniques, les builds et les stratégies de différents jeux.</h2>
      <div class="hero-div__btn">
        <a href="./app/views/Champions__page.php" class="bg-alice hero__btn">Champions</a>
        <a href="./gamepage.html" class="bg-alice hero__btn">Jeux</a>
        <a href="/pages/page-lol.html" class="bg-alice hero__btn">Builds</a>
      </div>
    </div>
  </div>
</div>

        <section>
            <h2 class="text-black">Game</h2>

            <div id="container" class="king-games__carousel "></div>
        </section>



    </main>


<?php include __DIR__ . '/app/views/partials/footer.php'; ?>


<script src="./assets/js/script.js"></script>
</body>

</html>
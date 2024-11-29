<?php
include("header.php");
$getcategory = mysqli_query($conn, "SELECT * from category") or die(mysqli_error($conn));
?>

  <!-- home section starts  -->

  <!-- <section class="home" id="home">

        <div class="row">

            <div class="content">
                <h3>"Good Books Don't Give Up All The Secrets At Once.."</h3>
            </div>

            <div class="swiper books-slider">
                <div class="swiper-wrapper">
                    <a href="#" class="swiper-slide"><img src="image/bk10.jpg" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="image/bk2.jpg" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="image/bk7.jpg" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="image/bk5.jpg" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="image/bk3.jpg" alt=""></a>
                </div>
                <img src="image/stand.png" class="stand" alt="">
            </div>

        </div>

    </section> -->

  <section class="featured" id="featured">
  <h1 class="heading"><span>Discover Genres</span></h1>
  <form action="" method="POST">
    <div class="genreParent">

      <?php
      $ctr = 0;
      while ($fetcategory = mysqli_fetch_array($getcategory)) {
        if ($ctr % 5 == 0) {
          echo "</div>";
          echo '<div class="genreParent">';
        }
        $ctr++;

        ?>
        <div class="genreContainer">
          
            <div class="image">
              <img src="<?= $fetcategory['image'] ?>">
            </div>
            <div class="label">
              <h3>
                <a href="booklist.php?bkgrp=<?php echo $fetcategory['name']?>">
                  <!-- <input class="checkbox marg pad chkbk" style='height:25px;width:25px' type="checkbox" name='interest[]' value="'%<?= $fetcategory['name'] ?>%'"> -->
                  <?= $fetcategory['name'] ?>
                </a>
            </h3>
          </div>
        </div>

        <?php
      }
      ?>
    </div>
    <div style="text-align:center">
    
      <!-- <input type="submit" value="Next" class="btn text-center" name="intersubmit"> -->
    </div>
  </form>

</section>

  <!-- footer section starts  -->

  <?php 
  include("footer.php");
  ?>

  <!-- footer section ends -->

  <!-- loader  -->

  <div class="loader-container">
    <img src="image/loader-img.gif" alt="" />
  </div>

  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

  <!-- custom js file link  -->
  <script src="js/script.js"></script>
</body>

</html>
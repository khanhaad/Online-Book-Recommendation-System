<?php
include('header.php');
$user = $_SESSION['username'];

?>

<!-- home section starts  -->

<section class='home' id='home'>

    <div class='row'>

        <div class='content'>
            <h3>"Good Books Don't Give Up All The Secrets At Once.."</h3>
        </div>

        <div class='swiper books-slider'>
            <div class='swiper-wrapper'>
                <a href='#' class='swiper-slide'><img src='image/bk10.jpg' alt=''></a>
                <a href='#' class='swiper-slide'><img src='image/bk2.jpg' alt=''></a>
                <a href='#' class='swiper-slide'><img src='image/bk7.jpg' alt=''></a>
                <a href='#' class='swiper-slide'><img src='image/bk5.jpg' alt=''></a>
                <a href='#' class='swiper-slide'><img src='image/bk3.jpg' alt=''></a>
            </div>
            <img src='image/stand.png' class='stand' alt=''>
        </div>

    </div>

</section>

<section class='featured' id='featured'>

    <?php if (!$user) {
        ?>
        <h1 class='heading'> <span>Top Rated Books</span> </h1>
    <?php } else {
        ?>
        <h1 class='heading'> <span>Recommended Books for You</span> </h1>

    <?php }
    ?>
    <div class='swiper featured-slider'>

        <div class='swiper-wrapper'>
            <?php
            // mysqli_query( $conn, "Create temporary table rate5 SELECT a.*,b.bkratings FROM books a,ratings b WHERE a.ISBN = b.ISBN AND b.bkratings = 5 limit 10
            //                 " );
            // mysqli_query( $conn, "Create temporary table rate4 SELECT a.*,b.bkratings FROM books a,ratings b WHERE a.ISBN = b.ISBN AND b.bkratings = 4 limit 10 
            //                 " );
            //  if ( !$user ) {
            
            // $gettpbk = mysqli_query( $conn, "SELECT * FROM book1 where rating >= 4 and rating <= 5  
            //                                      limit 10" );
            //  } else {
            
            $filtcond = '';

            $getulike = mysqli_query($conn, "SELECT *  FROM `user`  where name = '$user' and interest != ''") or die(mysqli_error($conn));
            if (mysqli_num_rows($getulike) > 0) {

                $fetulike = mysqli_fetch_array($getulike);
                $filtcond = "and `genres` like $fetulike[interest] ";
            }
            //   print  "SELECT * FROM book1 where rating >= 2 and rating <= 5  
//                                                $filtcond limit 25";
            $nnnum = 0;
            // echo $filtcond;
            
            // if ( $fetulike[ 'interest' ] != '' ) {
            
            $gettpbk = mysqli_query($conn, "SELECT * FROM book1 where rating >= 2 and rating <= 5  
                                               $filtcond limit 25");
            $nnnum = mysqli_num_rows($gettpbk);

            // }
            
            //  }
            
            // if ( $nnnum > 0 ) {
            while ($fettpbk = mysqli_fetch_array($gettpbk)) {
                ?>

                <div class='swiper-slide box'>
                    <!-- <div class = 'icons'>
            <a class = 'fas fa-eye' data-name = '1'></a>
            </div> -->
                    <div class='image'>
                        <img src="<?= $fettpbk['coverImg'] ?>" alt=''>
                    </div>
                    <div class='content'>
                        <b>
                            <?= $fettpbk['title'] ?>
                        </b>
                        <div class='stars'>
                            <?php
                            $bkrating = $fettpbk['rating'];
                            for ($i = 0; $i < $bkrating; $i++) {
                                ?>
                                <i class='fas fa-star'></i>
                            <?php }
                            ?>
                            <!-- <i class = 'fas fa-star' value = < ?= $fettpbk[ 'bkratings' ] ?>></i> -->
                            <!-- <i class = 'fas fa-star'></i>
                <i class = 'fas fa-star'></i>
                <i class = 'fas fa-star'></i>
                <i class = 'fas fa-star-half-alt'></i> -->
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <div class='swiper-button-next'></div>
        <div class='swiper-button-prev'></div>
    </div>
</section>

<?php
include("footer.php");
?>

<!-- footer section ends -->

<!-- loader  -->

<div class='loader-container'>
    <img src='image/loader-img.gif' alt=''>
</div>

<script src='https://unpkg.com/swiper@7/swiper-bundle.min.js'></script>

<!-- custom js file link  -->
<script src='js/script.js'></script>    

</body>

</html>
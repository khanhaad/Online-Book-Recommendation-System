<?php
ob_start();
session_start();
include("header.php");
$user = $_SESSION["username"];
// $user = "jd";
if (!$user) {
  header("Location:main.php");
}

$getcategory = mysqli_query($conn, "SELECT * from category") or die(mysqli_error($conn));

$getu = mysqli_query($conn, "Select * from `user` WHERE `name`='$user'") or die(mysqli_error($conn));
$fetu = mysqli_fetch_array($getu);
$intr = explode("'OR'", $fetu['interest']);
$intr_checked = array();
foreach ($intr as $key => $value) {
  $value = str_replace("'", "", $value);
  $value = str_replace("%", "", $value);
  array_push($intr_checked, $value);
}


if (isset($_POST["intersubmit"])) {
  $a = 1;

  $interest = mysqli_real_escape_string($conn, implode("OR", $_POST["interest"]));
  // echo $interest;
  mysqli_query($conn, "UPDATE `user` SET `interest`='$interest' WHERE `name`='$user'") or die(mysqli_error($conn));
  header("Location: main.php");
  // die();
}


?>

<section class="featured" id="featured">
  <h1 class="heading"><span>CHOOSE YOUR INTEREST</span></h1>
  <form action="" method="POST">
    <div class="genreParent">

      <?php
      $ctr = 0;
      $cnm = "";
      while ($fetcategory = mysqli_fetch_array($getcategory)) {

        // echo $intr;
        // echo "<br>";
        // echo $cnm;
      
        $checked = "";
        if(in_array($fetcategory['name'], $intr_checked)){
          $checked = "checked";
        }

        if ($ctr % 5 == 0) {
          echo "</div>";
          echo '<div class="genreParent">';
        }
        $ctr++;

        ?>
        <div class="genreContainer">
          <div class="image">
            <img src="<?= $fetcategory['image'] ?>" alt="">
          </div>
          <div class="label">
            <h3>
              <input class="checkbox marg pad chkbk" style='height:25px;width:25px' type="checkbox" name='interest[]'
                value="'%<?= $fetcategory['name'] ?>%'" <?=$checked?>>
              <?= $fetcategory['name'] ?>
            </h3>
          </div>
        </div>

        <?php
      }
      ?>
    </div>
    <div style="text-align:center">

      <input type="submit" value="Next" class="btn text-center" name="intersubmit" style="background: forestgreen;">
    </div>
  </form>

</section>

<!-- footer section starts  -->

<?php
include("footer.php");
?>

<!-- loader  -->

<div class="loader-container">
  <img src="image/loader-img.gif" alt="" />
</div>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>

</html>
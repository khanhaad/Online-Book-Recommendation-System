<?php
include('dbconnect.php');
$bkfilt = $_REQUEST["category"];
$filtcond = "";
$newfilt = substr($bkfilt, 0, -3); 
if($bkfilt != ''){
    $filtcond = " and genres like $newfilt ";
}
$bkcond = "";

if($filtcond == ""){

    if($_REQUEST['bkgrp'] != ""){
        $bkgrp = $_REQUEST['bkgrp'];
        $bkcond = "AND `genres` LIKE '%$bkgrp%'";
    }
}


// echo "SELECT *  FROM `book1`  where isbn != '' $filtcond  limit 100 ";
$getproducts = mysqli_query($conn, "SELECT *  FROM `book1`  where isbn != '' $filtcond $bkcond limit 100 ") or die(mysqli_error($conn));
?>
<style>
    .mainfont {
        text-transform: uppercase;
    }

    .catname {
        justify-content: center;
        align-items: center;
        text-align: center;
        text-transform: uppercase;
    }
</style>
<div class="row">

    <?php
    while ($fetchproducts = mysqli_fetch_array($getproducts)) {
        ?>
        <div class="col-lg-4 col-xs-6">
            <div class="card-wrapper">
                <div class="card">
                    
                <!-- <a type="button" class="btn btn-primary ratin" data-toggle="modal" data-name="1">
  Launch demo modal
    </a> -->
                <!-- <div class='ratin '  align='center' data-toggle="modal" data-target="#exampleModal">
                    <i class='fas fa-star fa-2x' >Ratings</i>
                </div> -->
                    <div class="image-wrapper">
                        <a href="sing-book.php?code=<?php echo $fetchproducts['isbn']?>">

                            <img src="<?php echo $fetchproducts['coverImg']; ?>" alt="" class="image"
                            style='width:250px;height:450px' />
                        </a>
                    </div>
                    <div class="content-wrapper">
                        <div class="title">
                            
                            <h4 align='center'>
                                <?php echo $fetchproducts['title']; ?>
                            </h4>
                        </div>
                        <div class="description" align='center'>
                            <?php echo $fetchproducts['description']; ?>

                        </div>
                        <div class="stars" align='center'>
                            <?php
                            $bkrating = $fetchproducts['rating'];
                            
                            for ($i = 0; $i < $bkrating; $i++) {
                                ?>
                                <i class="fas fa-star"></i>
                            <?php }
                            ?>
                        </div>
                        
                         
                        
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

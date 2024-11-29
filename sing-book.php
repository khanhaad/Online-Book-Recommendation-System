<?php
session_start();
include('dbconnect.php');
$isbn = $_REQUEST["code"];


if (isset($_POST["submit"])) {
    $a = 1;
    $code = $_POST["code"];
    $star = $_POST["star"];


    $login = mysqli_query($conn, "SELECT * FROM `user` WHERE `username` = '$_SESSION[username]'") or die(mysqli_error($conn));
    $flogin = mysqli_fetch_array($login);
    $userid = $flogin['id'];
    // echo $userid;


    // if (mysqli_num_rows($login) == 1) {
    //     print '<script type="text/javascript">';
    //     print 'alert("Username Already Exist")';
    //     print '</script>';
    // }else{
    //     if ($fname != "" && $pass != "") {
    // print "INSERT  INTO `ratings`(`userid`,`isbn`,`bkratings`)
    //     VALUES('$userid', '$code','$star')";
    mysqli_query($conn, "INSERT  INTO `ratings`(`userid`,`isbn`,`bkratings`)
            VALUES('$userid', '$code','$star')") or die(mysqli_error($conn));
    $updrt = mysqli_query($conn, "SELECT * FROM `ratings` WHERE `isbn` = '$code'") or die(mysqli_error($conn));
    $cnt = 0;
    $trt = 0;
    while ($fetrt = mysqli_fetch_array($updrt)) {
        $rt = $fetrt['bkratings'];
        $trt = $trt + $rt;
        $cnt = $cnt + 1;
    }


    if ($cnt > 0) {
        $divcnt = $cnt;
    } else {
        $divcnt = 1;
    }
    $comrt = $trt / $divcnt;



    mysqli_query($conn, "Update `book1` set rating= '$comrt' where isbn='$code'") or die(mysqli_error($conn));
    header("Refresh:0; url=booklist.php");

    //     $_SESSION["username"] = $_POST['uname'];
    //     header("Location:main.php");
    // } else {
    //     $_SESSION["username"] = "";
    // }
    // }   
}

$getproducts = mysqli_query($conn, "SELECT *  FROM `book1`  where isbn = '$isbn'") or die(mysqli_error($conn));
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

    input[type="radio"] {
        display: none;
    }

    label {
        display: inline-block;
    }

    input[type="radio"]:checked+label {
        cursor: default;
        color: red;
    }
    .btn {
    
}
</style>
<link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<form action="" method="POST">




    <?php
    $fetchproducts = mysqli_fetch_array($getproducts);
    ?>
    <div class="row" style="width: 95%;display: flex;border-radius: 4px;border: 5px solid black;margin: auto;">
        <div style="margin: 2%;">
            <img src="<?php echo $fetchproducts['coverImg']; ?>" class="image" />
            
        </div>
        <div style="width: 50%;margin: 3%;">
            <div class="title">
                <h3 style="padding-left:5%;font-family: 'Poppins', sans-serif;text-transform: uppercase">
                    <input type='hidden' name='code' value='<?php echo $isbn ?>'>
                    <?php echo $fetchproducts['title']; ?>
                </h3>
            </div>
            <div>
                <h4 class="" style="padding-left:5%;word-spacing:4px;font-family: 'Poppins', sans-serif;width: 130%;text-align: justify;">
                <hr style="border: 4px solid #27ae60;border-radius: 4px; ;margin-bottom: 10px;margin-left: 0;">
                    <?php echo $fetchproducts['description']; ?>
                </h4>
            </div>
            <div class="content-wrapper">
        
                    <div class="rating" style="padding-left:5%">
                        <input id="star1" name="star" type="radio" value='1'>
                        <label for="star1"><i class="fa fa-star fa-2x"></i></label>
                        <input id="star2" name="star" type="radio" value='2'>
                        <label for="star2"><i class="fa fa-star  fa-2x"></i></label>
                        <input id="star3" name="star" type="radio" value='3'>
                        <label for="star3"><i class="fa fa-star fa-2x"></i></label>
                        <!-- Use <?php echo ("checked") ?> to set the correct star -->
                    <input id="star4" name="star" type="radio" value='4'>
                    <label for="star4"><i class="fa fa-star fa-2x"></i></label>
                    <input id="star5" name="star" type="radio" value='5'>
                    <label for="star5"><i class="fa fa-star fa-2x"></i></label>
                </div>
                <div class="row" style="word-spacing: 21px;padding-left:5%;padding-bottom:2%">
                    <label style="padding-left:2.2%">1</label>
                    <label>2</label>
                    <label>3</label>
                    <label>4</label>
                    <label>5</label>
                </div>
                <div class='' style="padding-left:5%">
                    <input type="submit" name="submit" class="btn" value="Submit">
                </div>
            </div>
        </div>

    </div>
</form>
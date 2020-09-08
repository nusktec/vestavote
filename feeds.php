<!doctype html>
<html lang="en">
<?php session_start();
$_SESSION['title'] = "Contestant Feeds" ?>
<?php include "head.php" ?>
<?php $_companies = models::getCompanies(); ?>
<body>

<!-- Loading starts -->
<div id="loading-wrapper">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Loading ends -->


<!-- Page wrapper start -->
<div class="page-wrapper">

    <!-- Sidebar wrapper start -->
    <?php include "sidebar.php" ?>
    <!-- Sidebar wrapper end -->

    <!-- Page content start  -->
    <div class="page-content">

        <!-- Header start -->
        <?php include "header.php" ?>
        <!-- Header end -->

        <!-- Main container start -->
        <div class="main-container">

            <!-- Row start -->
            <div class="row gutters text-center justify-content-center d-none">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h5>No Contestant Feeds Published Yet !</h5>
                </div>
            </div>

            <!-- Row start -->
            <div class="row gutters">
                <?php foreach ($_companies as $key=>$v){ ?>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="card">
                        <img onerror="this.src='uploads/placeholder.jpg'" style="height: 200px; object-fit: cover" class="card-img-top" src="uploads/banners/<?php echo strtolower($v['ccode']) ?>.jpg?tmp=10" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $v['ctitle'] ?></h5>
                            <p class="card-text">
                                <?php echo $v['cbio'] ?>
                            </p>
                            <p class="card-text">
                                <small class="text-muted"><?php echo $v['cname'] ?></small>
                            </p>
                            <p>
                                <button class="btn btn-rounded btn-primary">View Contestant Gallery</button>
                            </p>
                        </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- Row end -->

        </div>
        <!-- Main container end -->

    </div>
    <!-- Page content end -->

</div>
<!-- Page wrapper end -->

<?php include "foot.php" ?>

</body>

</html>
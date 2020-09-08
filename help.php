<!doctype html>
<html lang="en">
<?php session_start();
$_SESSION['title'] = "Get Help" ?>
<?php include "head.php" ?>

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
            <div class="row gutters text-center justify-content-center">

                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                    <div class="col-12">
                        <div class="info-stats4">
                            <div class="info-icon">
                                <i class="icon-phone"></i>
                            </div>
                            <div class="sale-num">
                                <h5>Contact Phone</h5>
                                <strong>234-8164242320</strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="info-stats4">
                            <div class="info-icon">
                                <i class="icon-email"></i>
                            </div>
                            <div class="sale-num">
                                <h5>Contact Email</h5>
                                <strong>support@reedax.com</strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="info-stats4">
                            <div class="info-icon">
                                <i class="icon-globe"></i>
                            </div>
                            <div class="sale-num">
                                <h5>Contact Website</h5>
                                <strong>www.reedax.com</strong>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Main container end -->

    </div>
    <!-- Page content end -->

</div>
<!-- Page wrapper end -->

<?php include "foot.php" ?>

</body>

</html>
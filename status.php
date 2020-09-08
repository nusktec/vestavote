<!doctype html>
<html lang="en">
<?php session_start();
$_SESSION['title'] = "Public Status" ?>
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

            <!-- Row start -->
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-container">
                        <div class="t-header">Filter Result</div>
                        <div class="table-responsive">
                            <table id="copy-print-csv" class="table custom-table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Company Code</th>
                                    <th>Voter Phone</th>
                                    <th>Contestant Code</th>
                                    <th>Contestant Name</th>
                                    <th>Date/Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach (models::getPublicVotes() as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['ctitle'] ?></td>
                                        <td><?php echo $value['ccode'] ?></td>
                                        <td><?php echo "*******".substr($value['vphone'], 5) ?></td>
                                        <td><?php echo $value['ccode']."/VOTE/".$value['xcode']."/".$value['csess'] ?></td>
                                        <td><?php echo $value['xname']." (".$value['xnick'].")" ?></td>
                                        <td><?php echo $value['vcreated'] ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
            <!-- Row end -->

        </div>
        <!-- Main container end -->

    </div>
    <!-- Page content end -->

</div>
<!-- Page wrapper end -->

<?php include "foot.php" ?>
<!-- Data Tables -->
<script src="vendor/datatables/dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap.min.js"></script>

<!-- Custom Data tables -->
<script src="vendor/datatables/custom/custom-datatables.js"></script>
<script src="vendor/datatables/custom/fixedHeader.js"></script>

<!-- Download / CSV / Copy / Print -->
<script src="vendor/datatables/buttons.min.js"></script>
<script src="vendor/datatables/jszip.min.js"></script>
<script src="vendor/datatables/pdfmake.min.js"></script>
<script src="vendor/datatables/vfs_fonts.js"></script>
<script src="vendor/datatables/html5.min.js"></script>
<script src="vendor/datatables/buttons.print.min.js"></script>
</body>

</html>
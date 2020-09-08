<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 05/09/2020 - head.php
 */
error_reporting(0);
session_start();
include "inc/db.class.php";
include "inc/func.php";
include "inc/models.php";
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Reedax.IO Vesta Vote Script">
    <meta name="author" content="Revelation A.F">
    <link rel="shortcut icon" href="img/fav.png"/>

    <!-- Title -->
    <title><?php echo func::getTitle() ?> | VestaVote</title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="fonts/style.css">
    <!-- Main css -->
    <link rel="stylesheet" href="css/main.css">

    <!-- DateRange css -->
    <link rel="stylesheet" href="vendor/daterange/daterange.css"/>

    <!--Tables css-->
    <link rel="stylesheet" href="vendor/daterange/daterange.css"/>

    <!-- Data Tables -->
    <link rel="stylesheet" href="vendor/datatables/dataTables.bs4.css"/>
    <link rel="stylesheet" href="vendor/datatables/dataTables.bs4-custom.css"/>
    <link href="vendor/datatables/buttons.bs.css" rel="stylesheet"/>
</head>
<script>
    var _tmp_ssk = "<?php echo SERVER_SSK; ?>";
    var BASE_URL = "<?php echo BASE_URL; ?>";
</script>


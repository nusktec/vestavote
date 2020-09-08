<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 05/09/2020 - header.php
 */
?>
<header class="header">
    <div class="toggle-btns">
        <a id="toggle-sidebar" href="#">
            <i class="icon-list"></i>
        </a>
        <a id="pin-sidebar" href="#">
            <i class="icon-list"></i>
        </a>
    </div>
    <div class="header-items">
        <!-- Custom search start -->
        <div class="custom-search">
            <input type="text" class="search-query" placeholder="Search for names...">
            <i class="icon-search1"></i>
        </div>
        <!-- Custom search end -->
    </div>
</header>

<!-- Page header start -->
<div class="page-header">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><?php echo func::getTitle(); ?></li>
    </ol>

    <ul class="app-actions">
        <li>
            <a href="#" id="reportrange">
                <span class="range-text"></span>
                <i class="icon-chevron-down"></i>
            </a>
        </li>
    </ul>
</div>
<!-- Page header end -->


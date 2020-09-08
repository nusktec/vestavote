<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 05/09/2020 - sidebar.php
 */
?>
<nav id="sidebar" class="sidebar-wrapper">

    <!-- Sidebar brand start  -->
    <div class="sidebar-brand">
        <a href="/" class="logo">
            <img src="img/logo.png" alt="VestVote"/>
        </a>
    </div>
    <!-- Sidebar brand end  -->

    <!-- Sidebar content start -->
    <div class="sidebar-content">

        <!-- sidebar menu start -->
        <div class="sidebar-menu">
            <ul>
                <li class="header-menu">General</li>
                <li class="<?php echo('My Application' === func::getTitle() ? 'active' : null) ?>">
                    <a href="<?php echo BASE_URL ?>/">
                        <i class="icon-settings"></i>
                        <span class="menu-text">My Application</span>
                    </a>
                </li>
                <li class="<?php echo('Contestant Feeds' === func::getTitle() ? 'active' : null) ?>">
                    <a href="<?php echo BASE_URL ?>/feeds">
                        <i class="icon-people"></i>
                        <span class="menu-text">Contestant Feeds</span>
                    </a>
                </li>
                <li class="<?php echo('Public Status' === func::getTitle() ? 'active' : null) ?>">
                    <a href="<?php echo BASE_URL ?>/status">
                        <i class="icon-bar-chart"></i>
                        <span class="menu-text">Public Status</span>
                    </a>
                </li>
                <li class="<?php echo('Get Help' === func::getTitle() ? 'active' : null) ?>">
                    <a href="<?php echo BASE_URL ?>/help">
                        <i class="icon-question_answer"></i>
                        <span class="menu-text">Get Help</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- sidebar menu end -->

    </div>
    <!-- Sidebar content end -->

</nav>

<?php
/**
 * Created by RSC BYTE LTD.
 * Author: Revelation A.F
 * Date: 08/09/2020 - logout.php
 */
session_start();
session_destroy();
header("location: /");
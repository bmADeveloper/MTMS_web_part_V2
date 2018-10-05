<?php
/**
 * User: dgdev
 * Date: 09-07-2018
 * Time: 03:39 PM
 */
session_start();
require '../../api/security.php';
$xss = new security();
$xss->protect_page();
$xss->session_expired();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MTMS(ICDS) ver.2.0</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.js"></script>
</head>
<body>
<input type="hidden" name="usrid" id="usrid" value="<?php echo $_SESSION['id'] ?>"/>
<section class="hero" style="background-color: #1766A6">
    <div class="hero-head">
        <nav class="navbar">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item" style="color: #f0edee;text-effect: emboss;" href="cdpo_landing_page.php">
                        <img src="../images/icds_logo.png" class="is-128x128" style="filter: invert(100%)"/>
                        &nbsp;&nbsp;&nbsp; MTMS(ICDS) ver.2.0
                    </a>
                    <span class="navbar-burger burger" data-target="navbarMenuHeroA">
            <span></span>
            <span></span>
            <span></span>
          </span>
                </div>
                <div class="navbar-menu">
                    <div class="navbar-end">
                        <a class="navbar-item is-active" style="color: #f0edee" href="cdpo_landing_page.php">
                            Dashboard
                        </a>
                        <!-- <a class="navbar-item" style="color: #f0edee" href="cdpo_visit_data.php">
                            Visit Data
                        </a> -->
                        <a class="navbar-item" style="color: #f0edee" href="cdpo_reports.php">
                            Reports
                        </a>
                        <a class="navbar-item" style="color: #f0edee" href="gallary.php">
                            Gallary
                        </a>
                        <a class="navbar-item" style="color: #f0edee" href="cdpo_setting.php">
                            Settings
                        </a>
                        <a class="navbar-item" style="color: #f0edee" href="../index.php">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</section>
</body>
</html>
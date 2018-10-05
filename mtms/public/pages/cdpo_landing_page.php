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

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MTMS(ICDS) ver.2.0</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.js"></script>
    <script src="../node_modules/excelexportjs.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body>
<input type="hidden" name="usrid" id="usrid" value="<?php echo $_SESSION['id'] ?>"/>
<section class="hero" style="background-color: #1766A6">
    <div class="hero-head">
        <nav class="navbar ">
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
                        <?php
                            if($_SESSION['id'] == 1){
                                echo '
                                    <a class="navbar-item" style="color: #f0edee" href="cdpo_setting.php">
                                        Settings
                                    </a>
                                ';
                            }

                        ?>
                        <?php
                            if($_SESSION['id'] == 1){
                                echo '
                                    <a class="navbar-item" style="color: #f0edee" href="../admin/">
                                        Master Data
                                    </a>
                                ';
                            }

                        ?>
                        <?php
                        if($_SESSION['id'] == 1){
                            echo '
                                    <a class="navbar-item" style="color: #cccccc" href="../weekly_report/">
                                        Weekly Report
                                    </a>
                                ';
                        }

                        ?>
                        
                        <a class="navbar-item" style="color: #f0edee" href="../index.php">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</section>
<section class="section hero">
    <div class="hero-head">
        <div class="container">
            <div class="columns">
                <div class="column is-half-desktop">
                    <h1 class="title is-4" style="color: #3E2723;" id="welcomemsg">Welcome User!</h1>
                </div>
                <div class="column"></div>
                <div class="column">
                    <div class="field is-grouped">
                        <p class="control">
                            <input class="input" type="date" id="fromdatectrl">
                        </p>
                        <p class="control">
                            <input class="input" type="date" id="todatectrl">
                        </p>
                        <p class="control">
                            <a class="button is-info" id="refresh_dashboard">
                                Refresh Dashboard
                            </a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column"> <!--is-one-quarter-desktop">-->
                    <div class="card">
                        <div class="card-header" style="background-color: #0D47A1">
                            <p class="card-header-title" style="color: #f5f8ef;">Total Supervisors & Total Centres </p>
                        </div>
                        <div class="card-content">
                            <h1 class="title is-4" id="CardNumTotSup">0 Supervisor(s).</h1>
                            <h1 class="subtitle is-6" id="CardNumTotCent">0 Centre(s).</h1>
                        </div>
                    </div>
                </div>
                <div class="column"> <!--is-one-quarter-desktop">-->
                    <div class="card">
                        <div class="card-header" style="background-color: #00BCD4">
                            <p class="card-header-title" style="color: #f5f8ef;">Centres Visited</p>
                        </div>
                        <div class="card-content">
                            <h1 class="title is-4" id="CardNumCentVis">0 Centre(s).</h1>
                            <h1 class="subtitle is-6" id="subtitlecentrevisit">31/03/2018 to 22/08/2019.</h1>
                        </div>
                    </div>
                </div>
                <div class="column"> <!--is-one-quarter-desktop">-->
                    <div class="card">
                        <div class="card-header" style="background-color: #7CB342">
                            <p class="card-header-title" style="color: #f5f8ef;">Centres Found Open</p>
                        </div>
                        <div class="card-content">
                            <h1 class="title is-4" id="CardNumCentOpen">0 Centre(s).</h1>
                            <h1 class="subtitle is-6" id="subtitlecentreopen">31/03/2018 to 22/08/2019.</h1>
                        </div>
                    </div>
                </div>
                <!-- <div class="column is-one-quarter-desktop">
                    <div class="card">
                        <div class="card-header" style="background-color: #F57F17">
                            <p class="card-header-title" style="color: #f5f8ef;">Efficiency % (Average)</p>
                        </div>
                        <div class="card-content">
                            <h1 class="title is-4" id="overalleff">0%</h1>
                            <h1 class="subtitle is-6" id="subtitleefficiency">31/03/2018 to 22/08/2019.</h1>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="columns">
                <!-- three type of crutial parametre in chart-->
                <div class="column">
                    <div class="card">
                        <div class="card-header" style="background-color: #37474F">
                            <p class="card-header-title" style="color: #ECEFF1;">No. of Visit(s)</p>
                        </div>
                        <div class="card-content">
                            <canvas id="visitChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header" style="background-color: #37474F">
                            <p class="card-header-title" style="color: #ECEFF1;">Malnourishment Scenarios</p>
                        </div>
                        <div class="card-content">
                            <canvas id="visitChart1"></canvas>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header" style="background-color: #37474F">
                            <p class="card-header-title" style="color: #ECEFF1;">Supplementary nutrition programme</p>
                        </div>
                        <div class="card-content">
                            <canvas id="visitChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-header" style="background-color: #F57F17;">
                            <p class="card-header-title" style="color: #e8f5e9;">
                                Efficiency Parameter(s) in details
                            </p>

                            <?php
                            if($_SESSION['id'] == 1){
                                echo '
                                    <a href="#" id="summaryButton" class="card-header-icon" aria-label="more options"  style="color: #e8f5e9;">
                                      <span class="icon">
                                        <i class="fas fa-file-excel" aria-hidden="true"></i>
                                      </span>
                                      Get Summary
                                    </a>
                                ';
                            }

                        ?>
                            
                        </div>
                        <div class="card-content">
                            <table class="table" id="synopsistable" width="100%">
                                <thead>
                                <tr>
                                    <th>Parameters</th>
                                    <th>Count</th>
                                    <th>%</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Total Centre</td>
                                    <td><p id="totcentre">0000</p></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Centre visited</td>
                                    <td><p id="viscentre">0000</p></td>
                                    <td><p id="percvisit">0%</p></td>
                                </tr>
                                <tr>
                                    <td>Centre Found Open</td>
                                    <td><p id="opencentre"></p></td>
                                    <td><p id="percopen">0%</p></td>
                                </tr>
                                <tr>
                                    <td>Total SNP Beneficiaries</td>
                                    <td><p id="snpben">0000</p></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>SNP Served</td>
                                    <td><p id="snpserv">0000</p></td>
                                    <td><p id="percsnpsrv">0%</p></td>
                                </tr>
                                <tr>
                                    <td>Children(6 month to 6 years)</td>
                                    <td><p id="chld6m">0000</p></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Morning Snacks served</td>
                                    <td><p id="msserve">0000</p></td>
                                    <td><p id="percmssrv">0%</p></td>
                                </tr>
                                <tr>
                                    <td>Children(3 year to 6 years)</td>
                                    <td><p id="chld3y">0000</p></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Present in PSE</td>
                                    <td><p id="chldpse">0000</p></td>
                                    <td><p id="percpse">0%</p></td>
                                </tr>
                                <tr>
                                    <td>Children below 5 years</td>
                                    <td><p id="chldblw5y">0000</p></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Child weighed</td>
                                    <td><p id="chldweighed">0000</p></td>
                                    <td><p id="percweight">0%</p></td>
                                </tr>
                                <tr>
                                    <td>Malnourished(moderate)</td>
                                    <td><p id="malmod">0000</p></td>
                                    <td><p id="percmalmod">0%</p></td>
                                </tr>
                                <tr>
                                    <td>Malnourished(severe)</td>
                                    <td><p id="malseve">0000</p></td>
                                    <td><p id="percmalseve">0%</p></td>
                                </tr>
                                <tr>
                                    <td>Mother's Meet</td>
                                    <td><p id="mom">0000</p></td>
                                    <td><p id="percmom">0%</p></td>
                                </tr>
                                <tr>
                                    <td>Registers missing</td>
                                    <td><p id="regis">0000</p></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Centres following ECCE</td>
                                    <td><p id="ecce">0000</p></td>
                                    <td><p id="percecce">0%</p></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" style="background-color: #00BCD4">
                            <p class="card-header-title" style="color: #f5f8ef;">My Visits...</p>
                        </div>
                        <div class="card-content">
                            <table class="table is-narrow" id="recentVisitTable" width="100%">
                                <thead>
                                <tr>
                                    <th>Centre Code</th>
                                    <th>Centre Name</th>
                                    <th>Visited On</th>
                                    <th>Total SNP Benefitiaries</th>
                                    <th>SNP Served</th>
                                    <th>Total Child</th>
                                    <th>Morning Snacks Served</th>
                                </tr>
                                </thead>
                                <tbody id="recentvistbody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<div id="dvjson"></div>
<script language="JavaScript" src="../js/dashboard.js"></script>
</body>
</html>
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
    <script src="../node_modules/excelexportjs.js"></script>
    <script src="../node_modules/jquery.table2excel.min.js"></script>
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
                        <?php
                            if($_SESSION['id'] == 1){
                                echo '
                                    <a class="navbar-item" style="color: #f0edee" href="cdpo_setting.php">
                                        Settings
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

<section class="hero" style="margin-top: 1%">
    <div class="hero-body">
        <div class="container" id="page01">
            <div class="columns">
                <div class="column is-two-fifths-desktop">
                    <div class="select is is-primary">
                        <select id="supervisorselect" class="supervisorselect">
                            <option value="">Select Reportee</option>
                        </select>
                    </div>
                </div>
                <div class="column is-one-fifth-desktop">
                    <input type="date" class="input is-primary" id="fromdatectrl"/>
                </div>
                <div class="column is-one-fifth-desktop">
                    <input type="date" class="input is-primary" id="todatectrl"/>
                </div>
                <div class="column is-one-fifth-desktop">
                    <a class="button is-link is-fullwidth" id="SupervisorEfficiencyCalculator">
                        Generate Report
                    </a>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-header" style="background-color: #5a9216;">
                            <div class="card-header-title" style="color: #e8f5e9;">
                                Efficiency Report
                            </div>
                        </div>
                        <div class="card-content">
                            <table class="table" id="synopsistable" width="100%">
                                <thead>
                                <tr>
                                    <th>Parameters</th>
                                    <th>Count</th>
                                    <th>%</th>
                                    <th>Generate detailed report (export to Excel)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Total Centres</td>
                                    <td><p id="totcentre">0000</p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Centres visited</td>
                                    <td><p id="viscentre">0000</p></td>
                                    <td><p id="percvisit">0%</p></td>
                                    <td>
                                        <div class="columns">
                                            <div class="column">
                                                <a class="button is-primary" id="btnrptcentvis">
                                                    <span class="icon">
                                                      <i class="fa fa-file-excel"></i>
                                                    </span>
                                                    &nbsp;List of Visited Centres
                                                </a>
                                            </div>
                                            <div class="column">
                                                <a class="button is-warning" id="btnnotvisited">
                                                    <span class="icon">
                                                      <i class="fa fa-file-excel"></i>
                                                    </span>
                                                    &nbsp;List of Not Visited Centres</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Centre Found Open out of visited centres</td>
                                    <td><p id="opencentre">0000</p></td>
                                    <td><p id="percopen">0%</p></td>
                                    <td>
                                        <div class="columns">
                                            <div class="column">
                                                <a class="button is-primary" id="btnrptcentopen">
                                                    <span class="icon">
                                                      <i class="fa fa-file-excel"></i>
                                                    </span>
                                                    &nbsp;List of Centres found open</a>
                                            </div>
                                            <div class="column">
                                                <a class="button is-warning" id="btnrptcentclose">
                                                    <span class="icon">
                                                      <i class="fa fa-file-excel"></i>
                                                    </span>
                                                    &nbsp;List of Centres found closed</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total SNP Beneficiaries</td>
                                    <td><p id="snpben">0000</p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Beneficiaries Served with SNP</td>
                                    <td><p id="snpserv">0000</p></td>
                                    <td><p id="percsnpsrv">0%</p></td>
                                    <td>
                                        <div class="columns">
                                            <div class="column">
                                                <a class="button is-primary" id="btnsnpreport">
                                                    <span class="icon">
                                                      <i class="fa fa-file-excel"></i>
                                                    </span>
                                                    &nbsp;Detailed Report</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Children (6 month to 6 years)</td>
                                    <td><p id="chld6m">0000</p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Children served with Morning Snacks</td>
                                    <td><p id="msserve">0000</p></td>
                                    <td><p id="percmssrv">0%</p></td>
                                    <td>
                                        <div class="columns">
                                            <div class="column">
                                                <a class="button is-primary" id="btnsnacks">
                                                    <span class="icon">
                                                      <i class="fa fa-file-excel"></i>
                                                    </span>
                                                    &nbsp;Detailed Report</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Children (3 year to 6 years)</td>
                                    <td><p id="chld3y">0000</p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Children present in PSE</td>
                                    <td><p id="chldpse">0000</p></td>
                                    <td><p id="percpse">0%</p></td>
                                    <td>
                                        <div class="columns">
                                            <div class="column">
                                                <a class="button is-primary" id="btnpse">
                                                    <span class="icon">
                                                      <i class="fa fa-file-excel"></i>
                                                    </span>
                                                    &nbsp;Detailed Report</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Children below 5 years</td>
                                    <td><p id="chldblw5y">0000</p></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Children weighed</td>
                                    <td><p id="chldweighed">0000</p></td>
                                    <td><p id="percweight">0%</p></td>
                                    <td><a class="button is-primary" id="btnweighment">
                                                    <span class="icon">
                                                      <i class="fa fa-file-excel"></i>
                                                    </span>
                                            &nbsp;Detailed Report</a></td>
                                </tr>
                                <tr>
                                    <td>Malnourished Children (moderate)</td>
                                    <td><p id="malmod">0000</p></td>
                                    <td><p id="percmalmod">0%</p></td>
                                    <td rowspan="2">
                                        <div class="columns">
                                            <div class="column">
                                                <a class="button is-primary" style="margin-top: 3%" id="btnmalnur">
                                                    <span class="icon">
                                                      <i class="fa fa-file-excel"></i>
                                                    </span>
                                                        &nbsp;Detailed Report</a>

                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Malnourished Children (severe)</td>
                                    <td><p id="malseve">0000</p></td>
                                    <td><p id="percmalseve">0%</p></td>

                                </tr>
                                <tr>
                                    <td>Mother's meet during previous month</td>
                                    <td><p id="mom">0000</p></td>
                                    <td id="percmom">0%</td>
                                    <td>
<!--                                        <a class="button is-primary">-->
<!--                                                    <span class="icon">-->
<!--                                                      <i class="fa fa-file-excel"></i>-->
<!--                                                    </span>-->
<!--                                            &nbsp;Detailed Report</a></td>-->
                                </tr>
                                <tr>
                                    <td>Registers missing</td>
                                    <td><p id="regis">0000</p></td>
                                    <td></td>
                                    <td>
<!--                                        <a class="button is-primary">-->
<!--                                                    <span class="icon">-->
<!--                                                      <i class="fa fa-file-excel"></i>-->
<!--                                                    </span>-->
<!--                                            &nbsp;Detailed Report</a></td>-->
                                </tr>
                                <tr>
                                    <td>Centres following ECCE</td>
                                    <td><p id="ecce">0000</p></td>
                                    <td id="percecce">0%</td>
                                    <td>
<!--                                        <a class="button is-primary">-->
<!--                                                    <span class="icon">-->
<!--                                                      <i class="fa fa-file-excel"></i>-->
<!--                                                    </span>-->
<!--                                            &nbsp;Detailed Report</a>-->
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="visitmodal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Modal title</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body" id="tablebody">

                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success" id="exporttoexcel">Export to Excel</button>
                </footer>
            </div>
        </div>
    </div>


</section>

<script src="../js/cdpo_reports.js"></script>
</body>
</html>
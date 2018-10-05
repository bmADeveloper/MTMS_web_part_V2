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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>
<body>
<input type="hidden" name="usrid" id="usrid" value="<?php echo $_SESSION['id'] ?>"/>
<section class="hero">
    <div class="hero-head" style="background-color: #1766A6">
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
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <div class="select">
                        <select id="selectBlocks">
                            <option>Select Block...</option>
                        </select>
                    </div>
                </div>
                <div class="column">
                    <div class="select">
                        <select id="selectProjects">
                            <option>Select Project...</option>
                        </select>
                    </div>
                </div>
                <div class="column">
                    <a href="#" id="getTable" class="button is-primary">
                        Get Data
                    </a>
                </div>
            </div>
            <div class="columns">
                <div id="centreDetailTable">
                    <!--table data included here-->
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal" id="CentreModal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Edit Centre Details</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body" id="modalBody">
            <div class="container">
                <div class="columns">
                    <div class="column is-one-fifth">Centre Name</div>
                    <div class="column" id="centName">the brown fish jumps over the lazy dog</div>
                </div>
                <div class="columns">
                    <div class="column is-one-fifth">Centre Code</div>
                    <div class="column" id="centCode">19328000000</div>
                </div>
                <div class="columns">
                    <div class="column is-one-fifth">Block</div>
                    <div class="column">
                        <div class="select">
                            <select id="modalSelectBlock">
                                <option>Select Block</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--<div class="columns">
                    <div class="column is-one-fifth">GP / Ward</div>
                    <div class="column">
                        <div class="select">
                            <select id="modalSelectGP">
                                <option>Select Gram Panchayet/Ward</option>
                            </select>
                        </div>
                    </div>
                </div>-->
                <div class="columns">
                    <div class="column is-one-fifth">Project</div>
                    <div class="column">
                        <div class="select">
                            <select id="modalSelectproj">
                                <option>Select Project</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column is-one-fifth">Sector</div>
                    <div class="column">
                        <div class="select">
                            <select id="modalSelectsector">
                                <option>Select Sector</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column is-one-fifth">Supervisor</div>
                    <div class="column">
                        <div class="select">
                            <select id="modalselectsuper">
                                <option>Select Supervisor</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column is-one-fifth">CDPO</div>
                    <div class="column">
                        <div class="select">
                            <select id="modalselectcdpo">
                                <option>Select CDPO</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="modal-card-foot">
            <button class="button is-success" id="btnSubmit">Save changes</button>
        </footer>
    </div>
</div>

<script src="../js/cdpo_settings_page.js"></script>
</body>
</html>
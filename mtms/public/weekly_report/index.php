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
    <style type="text/css" media="screen">
        body {
            /*background-color: #e6eaff;*/
            line-height: 1.0;
        }
    </style>
</head>
<body>
<section class="hero">
    <div class="hero-head">
        <nav class="navbar ">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item" emboss;" href="cdpo_landing_page.php">
                    <img src="../images/icds_logo.png" class="is-128x128"/>
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
                        <a class="navbar-item is-active"  href="../pages/cdpo_landing_page.php">
                            Dashboard
                        </a>
                        <a class="navbar-item"  href="/ ">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="hero-body">
        <div class="container">
              <div class="box">
                        <div class="columns is-multiline is-centered">
                            <div class="column is-3">
                                <div class="card">
                                    <header class="card-header">
                                        <p class="card-header-title">Alert all Supervisors</p>
                                    </header>
                                    <div class="card-content">
                                        <div class="field">
                                            <div class="control">
                                               <a class="is-link">Weekly report send all supervisors email and mobile</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a class="card-footer-item"><button id="alert_super" class="button is-success is-small is-fullwidth" deactive>Alert Supervisors</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-3">
                                <div class="card">
                                    <header class="card-header">
                                        <p class="card-header-title">Alert all CDPO's</p>
                                    </header>
                                    <div class="card-content">
                                        <div class="field">
                                            <div class="control">
                                                <input class="input is-primary" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a class="card-footer-item"><button href="#" class="button is-info">Create</button></a>
                                        <a class="card-footer-item"><button href="#" class="button is-warning">Cancel</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-3">
                                <div class="card">
                                    <header class="card-header">
                                        <p class="card-header-title">Alert DPO</p>
                                    </header>
                                    <div class="card-content">
                                        <div class="field">
                                            <div class="control">
                                                <input class="input is-primary" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a class="card-footer-item"><button href="#" class="button is-info">Create</button></a>

                                    </div>
                                </div>
                            </div>
                            <div class="column is-3">
                                <div class="card">
                                    <header class="card-header">
                                        <p class="card-header-title">Alert DM</p>
                                    </header>
                                    <div class="card-content">
                                        <div class="field">
                                            <div class="control">
                                                <input class="input is-primary" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a class="card-footer-item"><button href="#" class="button is-info">Create</button></a>
                                        <a class="card-footer-item"><button href="#" class="button is-warning">Cancel</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <div class="box">
                <div class="columns is-multiline is-centered">
                    <div class="column is-3">
                        <div class="card">
                            <header class="card-header ">
                                <p class="card-header-title has-text-info">Mail Delivery report</p>
                            </header>
                            <div class="card-content">
                                <table class="table" id="scrolling">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Deliver</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2018-09-12</td>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-12</td>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-12</td>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-12</td>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-12</td>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-12</td>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-12</td>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-12</td>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-12</td>
                                            <td>Yes</td>
                                        </tr><tr>
                                            <td>2018-09-12</td>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-12</td>
                                            <td>No</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-12</td>
                                            <td>Yes</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">Alert all CDPO's</p>
                            </header>
                            <div class="card-content">
                                <div class="field">
                                    <div class="control">
                                        <input class="input is-primary" type="text" >
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a class="card-footer-item"><button href="#" class="button is-info">Create</button></a>
                                <a class="card-footer-item"><button href="#" class="button is-warning">Cancel</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">Alert DPO</p>
                            </header>
                            <div class="card-content">
                                <div class="field">
                                    <div class="control">
                                        <input class="input is-primary" type="text" >
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a class="card-footer-item"><button href="#" class="button is-info">Create</button></a>

                            </div>
                        </div>
                    </div>
                    <div class="column is-3">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">Alert DM</p>
                            </header>
                            <div class="card-content">
                                <div class="field">
                                    <div class="control">
                                        <input class="input is-primary" type="text" >
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a class="card-footer-item"><button href="#" class="button is-info">Create</button></a>
                                <a class="card-footer-item"><button href="#" class="button is-warning">Cancel</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>

<script src="../js/weekly_report.js"></script>
</body>
</html>

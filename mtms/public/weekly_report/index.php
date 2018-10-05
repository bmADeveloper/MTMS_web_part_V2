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

<?php
//$con=mysqli_connect("localhost","debasishjpg","jalpaiguri","mtmsdb");
//$sql="SELECT DATE_SUB(curdate(),INTERVAL 15 DAY) AS past_date,CURDATE() AS today,7 AS DAY,Count(visit_data.centre_open) AS centre_open,Count(visit_data.centreid) AS visit_centre,Sum(visit_data.benef_total) AS total_benfi_during_7_days,Sum(visit_data.benef_serve) AS tota_served_during_7_days,user_master.designation AS designation FROM user_master INNER JOIN visit_data ON user_master.userid=visit_data.userid WHERE visit_data.visit_date BETWEEN date_sub(CURDATE(),INTERVAL 15 DAY) AND CURDATE() AND user_master.designation='DPO'";
//$result=mysqli_query($con,$sql);
//
//// Fetch all
//$row=mysqli_fetch_array($result,MYSQLI_NUM);
//    $d1=$row[0];
//echo $d1;
//// Free result set
//mysqli_free_result($result);
//
//mysqli_close($con);
////$gmail_list=array("barun8m@gmail.com","barun49m@gmail.com","lava4boy@gmail.com","barun2018mca@gmail.com");
////print_r($gmail_list);
//
//
//$to1=array_column($row,'email');
//$to=implode(",",$to1 );
////print_r ($data);
//// subject
//$subject = 'ICDS Weekly Report Reminder (NIC)';
//
//// message
//$message = '
//<html>
//<head>
//  <title>MTMS Weekly Report</title>
//</head>
//<body>
//  <p align="center"><b>Weekly report Details</b></p>
//  <table align="center" cellspacing="15" frame="box">
//    <tr frame="below">
//      <th>Past_date</th><th>Today</th><th>Days</th><th>Centre Open</th><th>Visit Centre</th><th>Total Benfi..</th><th>Served</th><th>Designation</th>
//    </tr>
//    <tr>
//      <td align="center">2018-09-19</td><td align="center">2018-10-04</td><td align="center">7</td><td align="center">2</td><td align="center">2</td><td align="center">36</td><td align="center">33</td><td align="center">CDPO</td>
//    </tr>
//  </table>
//</body>
//</html>
//';
//// To send HTML mail, the Content-type header must be set
//$headers  = 'MIME-Version: 1.0' . "\r\n";
//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//
//// Additional headers
//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
//$headers .= 'From: ICDS Report Reminder <icds@example.com>' . "\r\n";
//$headers .= 'Cc: icdsachive@example.com' . "\r\n";
//$headers .= 'Bcc: icdscheck@example.com' . "\r\n";
//
//// Mail it
////mail($to, $subject, $message, $headers);
//?>
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
                                <div class="modal-background"></div>
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
            </div>
    </div>
</section>

<script src="../js/weekly_report.js"></script>
</body>
</html>

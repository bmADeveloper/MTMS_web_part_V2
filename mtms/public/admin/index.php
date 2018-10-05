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
        <div class="columns is-multiline">
          <div class="column is-3">
            <div class="card">
              <header class="card-header">
                <p class="card-header-title">Create New Project</p>
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
                <p class="card-header-title">Create New Sector</p>
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
                <p class="card-header-title">Create New GP</p>
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
                <p class="card-header-title">Create New block</p>
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
          <div class="column is-6">
            <div class="card">

              <div class="card-header">

                <p class="card-header-title">Create User</p>
                
              </div>

              <div class="card-content">
                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Fullname</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <p class="control">
                        <input class="input" type="text">
                      </p>
                    </div>
                  </div>
                </div>
                
                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Date of birth</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <p class="control">
                        <input class="input" type="date">
                      </p>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">E-Mail</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <p class="control">
                        <input class="input" type="email">
                      </p>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Mobile</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <p class="control">
                        <input class="input" type="text">
                      </p>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Address</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <p class="control">
                        <textarea class="input"></textarea>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Gender</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <label class="radio">
                          <input type="radio" name="gender">
                          Male
                        </label>
                        <label class="radio">
                          <input type="radio" name="gender">
                          Female
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Password</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <p class="control">
                        <input class="input" type="password">
                      </p>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Designation</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <label class="radio">
                          <input type="radio" name="desig">
                          District Level officers
                        </label>
                        <label class="radio">
                          <input type="radio" name="desig">
                          CDPO
                        </label>
                        <label class="radio">
                          <input type="radio" name="desig">
                          Supervisor
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-footer">
                <a class="card-footer-item"><button href="#" class="button is-info">Create</button></a>
                <a class="card-footer-item"><button href="#" class="button is-warning">Cancel</button></a>
              </div>              
            </div>
          </div>
          <div class="column is-6">
            <div class="card">

              <div class="card-header">

                <p class="card-header-title">Create Centre</p>
                
              </div>

              <div class="card-content">
                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Centre name</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <p class="control">
                        <input class="input" type="text">
                      </p>
                    </div>
                  </div>
                </div>
                
                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Address</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <p class="control">
                        <input class="input" type="text">
                      </p>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Latitude</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <p class="control">
                        <input class="input" type="number">
                      </p>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Longitude</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <p class="control">
                        <input class="input" type="number">
                      </p>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Worker Name</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <p class="control">
                        <input class="input" type="text">
                      </p>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Helper Name</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <p class="control">
                        <input class="input" type="text">
                      </p>
                    </div>
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

<script src="../js/admin.js"></script>
</body>
</html>

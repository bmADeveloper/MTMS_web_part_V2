<?php
/**
 * User: dgdev
 * Date: 07-07-2018
 * Time: 12:10 AM
 */
session_start();
session_unset();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MTMS(ICDS)v2.0</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>

    <style type="text/css" media="screen">
	    	body {
			    /*background-color: #e6eaff;*/
			    line-height: 1.0;
			}
		nav{
			background-color: #1766A6;
		}
		.box {
		  margin-top: 5rem;
		}
		.avatar {
		  margin-top: -70px;
		  padding-bottom: 20px;
		}
		.avatar img {
		  padding: 5px;
		  background: #fff;
		  border-radius: 50%;
		  -webkit-box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
		  box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
		  height: 64px;
		  width: 64px;
		}
    </style>
</head>
<body>
	<section class="hero is-fullheight">
		<div class="hero-head">
			<nav class="navbar">
		      <div class="container">
		        <div class="navbar-brand">
		          <a class="navbar-item">
		            <img src="images/icds_logo.png" alt="Logo">
		          </a>
		          <span class="navbar-burger burger" data-target="navbarMenuHeroA">
		            <span></span>
		            <span></span>
		            <span></span>
		          </span>
		        </div>
		        <div id="navbarMenuHeroA" class="navbar-menu">
		          <div class="navbar-end">
		            <a class="navbar-item is-active" href="guidlines.php">
		              Guidlines
		            </a>
		            <span class="navbar-item">
		              <a class="button is-primary is-inverted" href="downloads/mtms.apk">
		                <span class="icon">
		                  <i class="fab fa-android"></i>
		                </span>
		                <span>Download</span>
		              </a>                  
		            </span>
		          </div>
		        </div>
		      </div>
		    </nav>
		</div>
		<div class="hero-body" style="padding-top:0">
			<div class="container has-text-centered">
					<div class="level">
						<div class="level-item">
							<figure class="image is-64x64">
	                        	<img src="images/wb_logo.png"/>
	                    	</figure>
						</div>
					</div>
					<div class="level">
						<div class="level-item">
							<p class="is-size-3" style="color: #1766A6;">
								Mobile based Tracking & Monitoring System <br/>
								ICDS, Jalpaiguri<br/>
								<a href="" title="" class="is-size-6">Ver 2.0</a>
							</p>
						</div>
					</div>
                <div class="columns is-vcentered">
                	<div class="column is-1"></div>
                    <div class="column is-5">
                    		<figure class="image is-4by3 mySlides">
	                        	<img src="images/1.jpg"/>
	                    	</figure>
	                    	<figure class="image is-4by3 mySlides">
	                        	<img src="images/3.jpg"/>
	                    	</figure>
	                    	<figure class="image is-4by3 mySlides">
	                        	<img src="images/7.jpg"/>
	                    	</figure>
                    </div>
                    <div class="column is-1"></div>
                    <div class="column is-4">
                    	<p class="is-size-4" style="color: #1766A6;">Welcome to MTMS</p>
			            <div class="box">
			                <figure class="avatar">
			                    <img src="img/icds_logo.png">
			                </figure>
			                <form method="post" action="/api/login">
			                	<div class="field">
			                        <div class="control">
			                        	<input class="input" type="email" name="email" placeholder="Your Email" autofocus="">
			                        </div>
			                    </div>

			                    <div class="field">
			                        <div class="control">
			                        	<input class="input" type="password" name="psw" placeholder="Your Password">
			                        </div>
			                    </div>

			                    <button class="button is-block is-info is-large is-fullwidth">Login</button>
			                </form>
			            </div>
			            <p class="has-text-grey">
			                <a href="../pages/signup.php">Sign Up</a> &nbsp;·&nbsp;
			                <a href="../pages/forgot.php">Forgot Password</a>
						</p>
                    </div>
                </div>
			</div>
		</div>
		<div class="hero-foot"  style="padding-top:0">
			<div class="columns">
				<div class="column is-1 is-4-mobile is-offset-9">
					<img src="images/nic_logo.png" alt="Logo">
				</div>
			</div>
		</div>
	</section>



<script src="/js/start.js" type="text/javascript" charset="utf-8" async defer></script>
</body>

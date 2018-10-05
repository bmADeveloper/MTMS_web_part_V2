<?php
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
    	html,body {
  			font-family: 'Open Sans', serif;
		}
		.hero {
		  background: linear-gradient(
		      rgba(51, 151, 219, 0.5),
		      rgba(233, 240, 245, 0.5)
		    ), url('/images/cor-img-3.jpg') no-repeat center center fixed;
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}
		.hero .nav, .hero.is-success .nav {
		  -webkit-box-shadow: none;
		  box-shadow: none;
		}
		.hero .subtitle {
		  padding: 2rem 0;
		  line-height: 1.0;
		  color :rgba(238, 238, 225, 1.0);
		  text-shadow: 2px 2px #000000;
		}
		.title{
			color :rgba(238, 238, 225, 1.0);
			text-shadow: 2px 2px #000000;
		}
		.label{
			font-size: 1.0em;
			color :rgba(238, 238, 225, 1.0);
			text-shadow: 2px 2px #000000;
		}
    </style>
</head>
<body>
	<section class="hero is-fullheight">
		<div class="hero-body">
			<div class="container has-text-centered">
				<div class="columns">
					<div class="column is-8 is-offset-2 is-12-mobile" id="intialDisplay">
						<div class="level">
							<div class="level-item">
								<img src="images/wb_logo.png" style="height: 120px;"/>
							</div>
						</div>
						<br/>
						<p class="title"> Mobile based Tracking & Monitoring System </p>
						<p class="title"> ICDS, Jalpaiguri </p>
						<p class="subtitle">  Ver 2.0  </p>
						<a class="button is-success is-large" id="loginFormButton">Login</a>
						<a href = "/downloads/mtms.apk" class="button is-success is-warning is-large" id="loginFormButton">Download App</a>
						
					</div>		
					<div class="column is-4 is-offset-4 is-12-mobile has-text-justified" id="loginForm">
						<div class="level">
							<div class="level-item">
								<img src="images/wb_logo.png" style="height: 120px;"/>
							</div>
						</div>					
		                <form method="post" action="/api/login">
		                	<div class="field">
							  <label class="label">Email</label>
							  <div class="control has-icons-left">
							    <input name="email" class="input" type="email" placeholder="abc@example.com">
							    <span class="icon is-small is-left">
							      <i class="fas fa-envelope"></i>
							    </span>
							    <span class="icon is-small is-right">
							      <i class="fas fa-exclamation-triangle"></i>
							    </span>
							  </div>
							  <p class="help is-danger"></p>
							</div>

							<div class="field">
							  <label class="label">Password</label>
							  <div class="control has-icons-left">
							    <input name="psw" class="input is-success" type="password" placeholder="Enter Password">
							    <span class="icon is-small is-left">
							      <i class="fas fa-user"></i>
							    </span>
							    <span class="icon is-small is-right">
							      <i class="fas fa-lock"></i>
							    </span>
							  </div>
							  <p class="help is-success"></p>
							</div>

							<div class="field is-grouped">
							  <div class="control">
							    <button type="submit" class="button is-link is-large" id="formSubmitButton">Submit</button>
							  </div>							  
							</div>
		                </form>      
					</div>					
				</div>
				<nav class="level">
					<div class="level-left">
						<p class="level-item has-text-centered">
							<img src="images/icds_logo.png" style="height: 70px;" />
						</p>
					</div>
					
					<div class="level-right">
						<p class="level-item has-text-centered">							
							<img src="images/nic_logo.png" style="height: 50px;" />
						</p>
					</div>
				</nav>
			</div>
		</div>
		
	</section>





	<script src="/js/start.js" type="text/javascript" charset="utf-8" async defer></script>
</body>

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
    <title> MTMS(ICDS)v2.0 </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>

    <style type="text/css" media="screen">
	    body {
		    background-color: #e6eaff;
		    line-height: 1.0;
		}		
    </style>
</head>
<body>
	<section class="hero is-fullheight">
		<div class="hero-body">
			<div class="container">
				<div class="columns">
					<div class="column is-8 is-offset-2">
						<div class="level">
							<div class="level-item  has-text-centered">
								<a href="/"><img src="../images/log_failed.png" alt="" class="image is-96x96"></a>
							</div>					
						</div>
						<div class="level">
							<div class="level-item  has-text-centered">
								<p class="is-capitalized has-text-weight-bold is-size-3">
									login failed...
								</p>
							</div>					
						</div>
						<div class="level">
							<div class="level-item  has-text-centered">
								<a class="button is-warning is-large is-rounded" href="/">
									Try again
								</a>
							</div>					
						</div>
					</div>
				</div>
					
				</div>
				
			</div>
		</div>
	</section>

<script src="/js/401.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
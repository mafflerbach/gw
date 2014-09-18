<?php
require_once('global.php');

?>
<!DOCTYPE HTML>
<!--
	Prologue by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Prologue by HTML5 UP</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]>
    <script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/jquery.scrollzer.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
		<!--[if lte IE 9]>
    <link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
		<!--[if lte IE 8]>
    <link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
			<link rel="stylesheet" href="style.css" />
	</head>
	<body>

		<!-- Header -->
			<div id="header" class="skel-layers-fixed">

				<div class="top">

					<!-- Logo -->


					<!-- Nav -->
						<nav id="nav">
							<!--
							
								Prologue's nav expects links in one of two formats:
								
								1. Hash link (scrolls to a different section within the page)
								
								   <li><a href="#foobar" id="foobar-link" class="icon fa-whatever-icon-you-want skel-layers-ignoreHref"><span class="label">Foobar</span></a></li>

								2. Standard link (sends the user to another page/site)

								   <li><a href="http://foobar.tld" id="foobar-link" class="icon fa-whatever-icon-you-want"><span class="label">Foobar</span></a></li>
							
							-->
							<ul>
								<li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Über uns</span></a></li>
								<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Aktuelles</span></a></li>
								<li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Gallerie</span></a></li>
							</ul>
						</nav>
						
				</div>
				
				<div class="bottom">

					<!-- Social Icons -->
						<ul class="icons">
							<li><a href="ts3server://gw2ts.de?nickname=test" class="big-icon teamspeak"><span class="label">Mit einem Klick zu unserem TS</span></a></li>
						</ul>
				
				</div>
			
			</div>

		<!-- Main -->
			<div id="main">


        <!-- About Me -->
        <section id="about" class="three">
          <div class="container">

            <a href="http://forum.gw2community.de/BoardList/" class="image featured"><img src="https://forum.gw2community.de/wcf/images/gwc/logo.png" alt="" /></a>
            <?php
            print(getAboutUs());
            ?>
          </div>
        </section>
        <!-- Intro -->
        <section id="top" class="one dark cover">
          <div class="container">

            <header>
              <h2>Aktuelles</h2>
            </header>

            <?php
              print(getCalender('day'));
              print(getBoardlistPices("//aside/div/fieldset[1]"));
            ?>

            <footer>
              <a href="#portfolio" class="button scrolly">Gallerie</a>
            </footer>

          </div>
        </section>


        <!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">
					
							<header>
								<h2>Gallerie</h2>
							</header>
							
							<p>Hier findest Du die Flashmob Impressionen userer Community-Mitglieder</p>
						
							<div class="row">
							<?php
                print(getGallery());
              ?>
              </div>

						</div>
					</section>

			</div>

		<!-- Footer -->
			<div id="footer">
				
				<!-- Copyright -->
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				
			</div>

	</body>
</html>
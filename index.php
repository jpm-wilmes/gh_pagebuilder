<?php
/*
	pagebuilder framework application
	index.html
	creates new Pagebuilder
	echos page

	Add page:
	- add page to config.inc.php 
	- add menu to mainmenu.inc.php
	- add page to secure.inc.php (indicate front-end or back-end = after login)
	- add page with the content including a class for the page.
*/
	session_start(); //be sure there is no html output before session_start()
	error_reporting(E_ALL);
	ini_set("display_errors", "on");

	// standaard voor debugging, weghalen in productie want er mag geen html output zijn voor regel 19.
	//echo '<meta http-equiv="refresh" content="10" >';

	include_once("includes/pagebuilder.inc.php");

	$objPage = new Pagebuilder();
	// creates the page head - main - footer (in pagebuilder.inc.php)
	$webPage = $objPage->createPage();
    // This displays the entire page
	echo $webPage;
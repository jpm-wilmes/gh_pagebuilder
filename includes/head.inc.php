<?php
/*************************************************************
	Pagebuilder framework application
	Learning application for VISTA AO JL2 P5
	Created 2019 by e.steens
*************************************************************/
	// create and return the page header (in html)
	// called by pagebuilder.inc.php init method
	class Head {
		public function getHtml($p_sGoBack) {
			// build page header with information from config.inc.php
			// $p_sGoBack contains string to move upwards in path (ie: ../)
			// font-awesome contains hamburger icon
			$head = "<title>" . TITLE . "</title>
				<meta name='viewport' content='width=device-width, initial-scale=1.0'>
				<meta name='keywords' content='your, tags' />
				<meta name='description' content='many words' />
				<meta name='subject' content='your website\'s subject' />";
			$head .= '
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
				<link rel="stylesheet" type="text/css" href="' . $p_sGoBack.CSS_PATH.'styles.css">
				<script src="'.$p_sGoBack.JS_PATH.'functions.js\"></script>
				';
				
			

			return $head;
		}
	}
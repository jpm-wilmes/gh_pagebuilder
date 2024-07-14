<?php
/*************************************************************
	Pagebuilder framework application
	Learning application for VISTA AO JL2 P5
	Created 2019 by e.steens
*************************************************************/
	// create and return the page menu (in html)
	// called by pagebuilder.inc.php CheckPage method
	//
	// return depending from PAGE
	// returns if page is before (false) of after (true) login
	// returns if page is protected (true) or not (false)
	// 
	abstract class Secure {
		public static function checkPage() {
			switch(PAGE) {
				case "home"			:
				case "pagina1"		: return false; break;
				case "admin"		: return true; break;
				case "gebruikers"	: return true; break;
				case "pagina2" 		: return true; break;
				default				: return true;
			}
		}
	}
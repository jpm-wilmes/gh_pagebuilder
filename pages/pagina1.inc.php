<?php
/*************************************************************
	Pagebuilder framework application
	Learning application for VISTA AO JL2 P5
	Created 2019 by e.steens
*************************************************************/
/*
	Contains details of page information
	returns the built html
	Class Name convention: <pagename>Page
	Must contain iPage interface implementation ie getHtml()
	Called by content.inc.php
*/
class Pagina1Page extends Core implements iPage {
		public function getHtml() {
			return "Pagina1 content page geen login nodig";
		}
	}
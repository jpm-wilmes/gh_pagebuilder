<?php
/*************************************************************
	Pagebuilder framework application
	Learning application for VISTA AO JL2 P5
	Created 2019 by e.steens
*************************************************************/
/*
	Contains details of page information
	returns the built html
	Must contain iPage interface implementation ie getHtml()
	Called by content.inc.php
*/
class AdminPage extends Core implements iPage {
		public function getHtml() {
			$html = "Administratiepagina achter de login";
			return $html;
		}
	}
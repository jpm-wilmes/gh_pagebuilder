<?php
/*************************************************************
	Pagebuilder framework application
	Learning application for VISTA AO JL2 P5
	Created 2019 by e.steens
*************************************************************/
	// create and return the page menu (in html)
	// called by pagebuilder.inc.php init method
	class Mainmenu {
		public function getHtml() {
			$imgUsers = "<img src='".ICONS_PATH."noun_users_50px.png' />";
			$mainmenu = "";
			$mainmenu .= "<ul>";
				//  laat menu zien dat altijd zichtbaar is
				if(PAGE == 'home') { $class='active'; } else { $class=''; } // opmaak anders indien menu is gekozen
	            $mainmenu .= "<li><a href='".HOME_PATH."' class=$class>Home</a></li>";

	            if(PAGE == 'pagina1') { $class='active'; } else { $class=''; }
				$mainmenu .= "<li><a href='".PAGINA1_PATH."' class=$class>pagina1</a></li>";

				if(PAGE == 'admin') { $class='active'; } else { $class=''; }
				$mainmenu .= "<li><a href='".ADMIN_PATH."' class=$class>Admin</a></li>";

				// laat menu zien dat alleen na login zichtbaar is
				if(isset($_SESSION['user']['isloggedin'])) {
					
					if(PAGE == 'pagina2') { $class='active'; } else { $class=''; }
					$mainmenu .= "<li><a href='".PAGINA2_PATH."' class=$class>Pagina2</a></li>";

					if(PAGE == 'gebruikers') { $class='active'; } else { $class=''; }
					$mainmenu .= "<li><a href='".GEBRUIKERS_PATH."' class=$class>Gebruikers</a></li>";

					$mainmenu .= "<li><a href='".LOGOUT_PATH."'>Uitloggen</a></li>";

				}
		
			$mainmenu .= "</ul>";
			return $mainmenu;
		}
	}

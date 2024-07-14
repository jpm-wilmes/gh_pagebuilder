<?php
/*************************************************************
	Pagebuilder framework application
	Learning application for VISTA AO JL2 P5
	Created 2019 by e.steens & jeroen.wilmes
*************************************************************/
//	Create global constants for file locations
	define("TITLE", "Een handig Framework");

//  rootfolder contains the LOCAL root path of the index.php file
//  createdto avoid sticking url arguments (repeated arguments)

    $rootfolder = "/pagebuilder/";

    // url:  /PAGE/ACTION/PARAM

    define("ROOT"			    , "");

    //Menuitems paths
    define("HOME_PATH"          , $rootfolder . ROOT . "home");
    define("PAGINA1_PATH"       , $rootfolder . ROOT . "pagina1");
    define("GEBRUIKERS_PATH"    , $rootfolder . ROOT . "gebruikers");
    define("PAGINA2_PATH"       , $rootfolder . ROOT . "pagina2");
    define("LOGOUT_PATH"        , $rootfolder . ROOT . "logout");
    define("ADMIN_PATH"         , $rootfolder . ROOT . "admin");

    //Rootfolder paths
	define("CSS_PATH"		    , ROOT 			. "css/");
	define("IMAGES_PATH"	    , ROOT 			. "images/");
	define("ICONS_PATH"		    , IMAGES_PATH 	. "icons/");
	define("USERS_PATH"		    , IMAGES_PATH 	. "users/");
	define("INCLUDES_PATH"	    , ROOT 			. "includes/");
	define("JS_PATH"		    , ROOT 			. "js/");
	define("PAGES_PATH"			, ROOT			. "pages/");
	define("INTERFACES_PATH"	, ROOT			. "interfaces/");


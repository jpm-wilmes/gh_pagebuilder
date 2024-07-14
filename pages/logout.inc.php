<?php

class LogoutPage extends Core implements iPage {
	public function getHtml() {
		session_destroy();
		session_reset();
		header("Location:".HOME_PATH);		
		// return "Hoofdpagina";
	}
}



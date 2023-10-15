<?php
	
	namespace Core\Controllers;
	
	use Core\baseController;
	use Core\User;
	
	class logoutController extends baseController {
		
		protected function loadSomeData() {
			$user = new User();
			$user->logout();
			
			header("Location: /");
			die();
		}
	}
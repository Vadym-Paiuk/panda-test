<?php
	namespace Core;
	
	abstract class baseController {
		public function __construct($slug) {
			$this->checkPermissions();
			$data = $this->loadSomeData();
			$this->loadView($slug, $data);
		}
		
		protected function loadView($viewName, $data = []) {
			ob_start();
			include('views/' . $viewName . '.php');
			echo ob_get_clean();
		}
		
		public function checkPermissions(){
			$ar_login = [
				'/',
				'/logout',
				'/account'
			];
			$ar_logout = [
				'/',
				'/login',
				'/registration'
			];
			$url = $_SERVER['REQUEST_URI'];
			$user = new User();
			
			if ( $user->check_auth() ){
				if ( !in_array( $url, $ar_login ) ){
					header("Location: /");
					die();
				}
				
				return true;
			}
			
			if ( !in_array( $url, $ar_logout ) ){
				header("Location: /");
				die();
			}
			
			return true;
		}
		
		abstract protected function loadSomeData();
	}
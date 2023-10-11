<?php
	namespace Core\Controllers;
	
	use Core\baseController;
	
	class homeController extends baseController {
		protected function loadSomeData() {
			$data = [
				'title' => 'Home Page',
				'content' => 'Welcome to our website!'
			];
			
			return $data;
		}
	}